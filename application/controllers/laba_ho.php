<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laba_Ho extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('Pdf');

		}
	public function index()
	{
		$this->load->view('laba_ho_v');
	}
	public function cari()
	{
		$this->load->view('laba_ho_cari_v');
	}
	public function cetak_ho()
	{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setFontSubsetting(true);
		$pdf->AddPage("A4");
		
		$unitb=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9005 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$unitb1=mysql_fetch_assoc($unitb);
		$unitt=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9005 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$unitt1=mysql_fetch_assoc($unitt);
		$bengkelb=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9006 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$bengkelb1=mysql_fetch_assoc($bengkelb);
		$bengkelt=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9006 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$bengkelt1=mysql_fetch_assoc($bengkelt);
		$cpb=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9007 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$cpb1=mysql_fetch_assoc($cpb);
		$cpt=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9007 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$cpt1=mysql_fetch_assoc($cpt);
		$ob=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9008 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$ob1=mysql_fetch_assoc($ob);
		$ot=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9008 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$ot1=mysql_fetch_assoc($ot);
		$tpb=$unitb1["data"]+$bengkelb1["data"]+$cpb1["data"]+$ob1["data"];
		$tpt=$unitt1["data"]+$bengkelt1["data"]+$cpt1["data"]+$ot1["data"];
		
		$gajibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8000 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$gajibulan1=mysql_fetch_assoc($gajibulan);
		$gajitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8000 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$gajitahun1=mysql_fetch_assoc($gajitahun);
		$insentivebulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$insentivebulan1=mysql_fetch_assoc($insentivebulan);
		$insentivetahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8001 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$insentivetahun1=mysql_fetch_assoc($insentivetahun);
		$makanbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8002 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$makanbulan1=mysql_fetch_assoc($makanbulan);
		$makantahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8002 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$makantahun1=mysql_fetch_assoc($makantahun);
		$atkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$atkbulan1=mysql_fetch_assoc($atkbulan);
		$atktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8003 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$atktahun1=mysql_fetch_assoc($atktahun);
		$tolbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8006 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tolbulan1=mysql_fetch_assoc($tolbulan);
		$toltahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8006 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$toltahun1=mysql_fetch_assoc($toltahun);
		$tlpbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8007 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tlpbulan1=mysql_fetch_assoc($tlpbulan);
		$tlptahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8007 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$tlptahun1=mysql_fetch_assoc($tlptahun);
		$listrikbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8008 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$listrikbulan1=mysql_fetch_assoc($listrikbulan);
		$listriktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8008 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$listriktahun1=mysql_fetch_assoc($listriktahun);
		$peliharabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8009 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$peliharabulan1=mysql_fetch_assoc($peliharabulan);
		$peliharatahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8009 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$peliharatahun1=mysql_fetch_assoc($peliharatahun);
		$entertainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8010 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$entertainbulan1=mysql_fetch_assoc($entertainbulan);
		$entertaintahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8010 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$entertaintahun1=mysql_fetch_assoc($entertaintahun);
		$sumbanganbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8011 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sumbanganbulan1=mysql_fetch_assoc($sumbanganbulan);
		$sumbangantahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8011 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$sumbangantahun1=mysql_fetch_assoc($sumbangantahun);
		$lainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8017 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$lainbulan1=mysql_fetch_assoc($lainbulan);
		$laintahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8017 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$laintahun1=mysql_fetch_assoc($laintahun);
		$rtbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8019 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$rtbulan1=mysql_fetch_assoc($rtbulan);
		$rttahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8019 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$rttahun1=mysql_fetch_assoc($rttahun);
		$pbkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8021 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$pbkbulan1=mysql_fetch_assoc($pbkbulan);
		$pbktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8021 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$pbktahun1=mysql_fetch_assoc($pbktahun);
		$subsidibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8022 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$subsidibulan1=mysql_fetch_assoc($subsidibulan);
		$subsiditahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8022 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$subsiditahun1=mysql_fetch_assoc($subsiditahun);
		$materaibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8023 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$materaibulan1=mysql_fetch_assoc($materaibulan);
		$materaitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8023 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$materaitahun1=mysql_fetch_assoc($materaitahun);
		
		$aksesorisbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8020 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$aksesorisbulan1=mysql_fetch_assoc($aksesorisbulan);
		$aksesoristahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=8020 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$aksesoristahun1=mysql_fetch_assoc($aksesoristahun);
		
		$lrob=$aksesorisbulan1["data"]+$materaibulan1["data"]+$sumbanganbulan1["data"]+$insentivebulan1["data"]+$pbkbulan1["data"]+$subsidibulan1["data"]+$gajibulan1["data"]+$makanbulan1["data"]+$atkbulan1["data"]+$tolbulan1["data"]+$tlpbulan1["data"]+$listrikbulan1["data"]+$peliharabulan1["data"]+$entertainbulan1["data"]+$lainbulan1["data"]+$rtbulan1["data"];
		$lrot=$aksesoristahun1["data"]+$materaitahun1["data"]+$sumbangantahun1["data"]+$insentivetahun1["data"]+$pbktahun1["data"]+$subsiditahun1["data"]+$gajitahun1["data"]+$makantahun1["data"]+$atktahun1["data"]+$toltahun1["data"]+$tlptahun1["data"]+$listriktahun1["data"]+$peliharatahun1["data"]+$entertaintahun1["data"]+$laintahun1["data"]+$rttahun1["data"];
		
		$html = '
		<h4>HEAD OFFICE SENTRAL</h4><br>
		<h4 align="center">LAPORAN LABA RUGI</h4><br>
		<h4 align="center">( dalam Rp. )</h4><br>
		<table width="100%">
			<tr>
				<td width="50%"></td>
				<td width="25%">Bulan Ini</td>
				<td width="25%">Tahun Ini</td>
			</tr>
			<tr>
				<td>Pendapatan</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Unit</td>
				<td align="right">'.number_format($unitb1["data"]).'</td>
				<td align="right">'.number_format($unitt1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bengkel</td>
				<td align="right">'.number_format($bengkelb1["data"]).'</td>
				<td align="right">'.number_format($bengkelt1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cat dan Poles</td>
				<td align="right">'.number_format($cpb1["data"]).'</td>
				<td align="right">'.number_format($cpt1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Others</td>
				<td align="right">'.number_format($ob1["data"]).'</td>
				<td align="right">'.number_format($ot1["data"]).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>Total Pendapatan</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($tpb).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($tpt).'</b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Biaya Operasional</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Gaji</td>
				<td align="right">'.number_format($gajibulan1["data"]).'</td>
				<td align="right">'.number_format($gajitahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Insentive</td>
				<td align="right">'.number_format($insentivebulan1["data"]).'</td>
				<td align="right">'.number_format($insentivetahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Makan</td>
				<td align="right">'.number_format($makanbulan1["data"]).'</td>
				<td align="right">'.number_format($makantahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ATK, Cetakan, Pos & Kurir</td>
				<td align="right">'.number_format($atkbulan1["data"]).'</td>
				<td align="right">'.number_format($atktahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Tol, Bensin, Parkir & Transport</td>
				<td align="right">'.number_format($tolbulan1["data"]).'</td>
				<td align="right">'.number_format($toltahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Telepon, Fax & Internet</td>
				<td align="right">'.number_format($tlpbulan1["data"]).'</td>
				<td align="right">'.number_format($tlptahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Listrik</td>
				<td align="right">'.number_format($listrikbulan1["data"]).'</td>
				<td align="right">'.number_format($listriktahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Pemeliharaan</td>
				<td align="right">'.number_format($peliharabulan1["data"]).'</td>
				<td align="right">'.number_format($peliharatahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Entertainment</td>
				<td align="right">'.number_format($entertainbulan1["data"]).'</td>
				<td align="right">'.number_format($entertaintahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sumbangan</td>
				<td align="right">'.number_format($sumbanganbulan1["data"]).'</td>
				<td align="right">'.number_format($sumbangantahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Lain-Lain</td>
				<td align="right">'.number_format($lainbulan1["data"]).'</td>
				<td align="right">'.number_format($laintahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Keperluan RT Kantor</td>
				<td align="right">'.number_format($rtbulan1["data"]).'</td>
				<td align="right">'.number_format($rttahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pajak & BBN Kendaraan</td>
				<td align="right">'.number_format($pbkbulan1["data"]).'</td>
				<td align="right">'.number_format($pbktahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Subsidi</td>
				<td align="right">'.number_format($subsidibulan1["data"]).'</td>
				<td align="right">'.number_format($subsiditahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Materai</td>
				<td align="right">'.number_format($materaibulan1["data"]).'</td>
				<td align="right">'.number_format($materaitahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Aksesoris</td>
				<td align="right">'.number_format($aksesorisbulan1["data"]).'</td>
				<td align="right">'.number_format($aksesoristahun1["data"]).'</td>
			</tr>
			<tr>
				<td></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($lrob).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($lrot).'</b></td>
			</tr>
			<tr>
				<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Laba ( Rugi ) Operasi</b></td>
				<td align="right"><b>'.number_format($tpb-$lrob).'</b></td>
				<td align="right"><b>'.number_format($tpt-$lrot).'</b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Total Pendapatan ( Biaya ) Lain</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Profit/Loss Bulan Ini</b></td>
				<td align="right"><b>'.number_format($tpb-$lrob).'</b></td>
				<td align="right"><b>'.number_format($tpt-$lrot).'</b></td>
			</tr>
		</table>
		<br>
		';
		
   
		$pdf->writeHTML($html, true, false, false, false, '');
		$pdf->Output('output_1.pdf', 'I');
	}
	
}