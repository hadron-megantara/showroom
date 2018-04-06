<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekapan_Group extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('rekapan_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('Pdf');
			$this->load->library('newphpexcel');

		}
	public function index()
	{
		$this->load->view('rekapan_group_v');
	}
	public function cetak_group()
	{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setFontSubsetting(true);
		$pdf->AddPage("A4");
		$nama_cabang=mysql_query("SELECT * FROM _cabang WHERE _deleted=0 AND code not like 1");
		$header = '
		<table width="100%">
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="70%">Nama Cabang</td>
				<td width="10%" align="center">Omset</td>
				<td width="10%" align="center">Proses</td>
				<td width="10%" align="center">Total</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			';
		$middle="";
		$total_omset=0;
		$total_proses=0;
		while($row = mysql_fetch_array($nama_cabang))
		{
			$omset=mysql_query("
				SELECT count(*) as data 
				FROM penjualan
				WHERE _cabang=".$row['code']." AND _deleted=0 AND statjual='Omset' AND tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
				");
			$omset1=mysql_fetch_assoc($omset);
			
			$proses=mysql_query("
				SELECT count(*) as data 
				FROM penjualan
				WHERE _cabang=".$row['code']." AND _deleted=0 AND statjual='Proses' AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
				");
			$proses1=mysql_fetch_assoc($proses);
			$total=$proses1["data"]+$omset1["data"];
		$middle .= 
			'
				<tr>
					<td>'.$row['data'].'</td>
					<td align="center">'.$omset1["data"].'</td>
					<td align="center">'.$proses1["data"].'</td>
					<td align="center">'.$total.'</td>
				</tr>
			';
			$total_omset+=$omset1["data"];
			$total_proses+=$proses1["data"];
		}
		$total=$total_proses+$total_omset;
		$footer = '
				<tr>
					<td style="border-bottom:1px;border-top:1px"></td>
					<td align="center" style="border-bottom:1px;border-top:1px">'.$total_omset.'</td>
					<td align="center" style="border-bottom:1px;border-top:1px">'.$total_proses.'</td>
					<td align="center" style="border-bottom:1px;border-top:1px">'.$total.'</td>
				</tr>
		</table>
		';
		
   
		$pdf->writeHTML($header.$middle.$footer, true, false, false, false, '');
		$pdf->Output('output_1.pdf', 'I');
	}
}