<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laba_Jurnal extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('Pdf');
			$this->load->library('newphpexcel');

		}
	public function index()
	{
		$this->load->view('laba_jurnal_v');
	}
	public function tambah_jurnal()
	{
		$this->load->view('laba_jurnal_banyak_v');
	}
	public function pilih()
	{	
		$data["banyakdebit"]=$this->input->post('banyakdebit');
		$data["banyakkredit"]=$this->input->post('banyakkredit');
		$this->load->view('laba_jurnal_tambah_v',$data);
	}
	public function cari()
	{
		$this->load->view('laba_jurnal_cari_v');
	}
	public function edit($iddata)
	{
		$data["iddata"] = $iddata;
		$this->load->view('laba_jurnal_edit_v',$data);
	}
	
	public function edit_data_kredit(){
		$nominal = str_replace(",", "", $this->input->post('nominal'));
		
		$data = array(
          '_jenis'=>$this->input->post('jenis'),
          'keterangan'=>$this->input->post('keterangan'),
          'tgl'=>$this->input->post('tgl'),
          'kredit'=>$nominal,
        );
		$this->db->where('idlr',$this->input->post('iddata'));
		$this->db->update('laba_rugi',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Jurnal dengan Kode Voucher - ".$this->input->post("voucher")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
		
		redirect("laba_jurnal","refresh");
	}
	public function edit_data_debit(){
		$nominal = str_replace(",", "", $this->input->post('nominal'));
		
		$data = array(
          '_jenis'=>$this->input->post('jenis'),
          'keterangan'=>$this->input->post('keterangan'),
          'tgl'=>$this->input->post('tgl'),
          'debit'=>$nominal,
        );
		$this->db->where('idlr',$this->input->post('iddata'));
		$this->db->update('laba_rugi',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Jurnal dengan Kode Voucher - ".$this->input->post("voucher")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
		
		redirect("laba_jurnal","refresh");
	}
	
	public function insert_datas(){
		$d=1;
		$k=1;
		for($k;$k<=$this->input->post('banyakkredit');$k++)
		{
			$hk=$k;
			$hk = str_replace(",", "", $this->input->post('nkredit'.$k));
			
			$this->db->set('voucher', $this->input->post("voucher"));
			$this->db->set('tgl', $this->input->post("tgl"));
			$this->db->set('_jenis', $this->input->post("jkredit".$k));
			$this->db->set('_cabang', $this->input->post("cabang"));
			$this->db->set('keterangan', $this->input->post("kkredit".$k));
			$this->db->set('kredit', $hk);
			$this->db->set('debit', '0');
			$this->db->set('entry', $this->input->post("entry"));
			$this->db->set('updated', $this->input->post("iduser"));
			$this->db->insert('laba_rugi'); 
		}
		for($d;$d<=$this->input->post('banyakdebit');$d++)
		{
			$hd=$d;
			$hd = str_replace(",", "", $this->input->post('ndebit'.$d));
			
			$this->db->set('voucher', $this->input->post("voucher"));
			$this->db->set('tgl', $this->input->post("tgl"));
			$this->db->set('_jenis', $this->input->post("jdebit".$d));
			$this->db->set('_cabang', $this->input->post("cabang"));
			$this->db->set('keterangan', $this->input->post("kdebit".$d));
			$this->db->set('kredit', '0');
			$this->db->set('debit', $hd);
			$this->db->set('entry', $this->input->post("entry"));
			$this->db->set('updated', $this->input->post("iduser"));
			$this->db->insert('laba_rugi'); 
		}
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Jurnal dengan Kode Voucher - ".$this->input->post("voucher")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
		
		redirect("laba_jurnal","refresh");
	}
	
	public function insert_data(){
		$nkredit = str_replace(",", "", $this->input->post('nkredit'));
		$ndebit = str_replace(",", "", $this->input->post('ndebit'));
		
		$this->db->set('voucher', $this->input->post("voucher"));
		$this->db->set('tgl', $this->input->post("tgl"));
		$this->db->set('_jenis', $this->input->post("jkredit"));
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('keterangan', $this->input->post("keterangan"));
		$this->db->set('kredit', $nkredit);
		$this->db->set('debit', '0');
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('laba_rugi'); 
		
		$this->db->set('voucher', $this->input->post("voucher"));
		$this->db->set('tgl', $this->input->post("tgl"));
		$this->db->set('_jenis', $this->input->post("jdebit"));
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('keterangan', $this->input->post("keterangan"));
		$this->db->set('debit', $ndebit);
		$this->db->set('kredit', '0');
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('laba_rugi'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Jurnal dengan Kode Voucher - ".$this->input->post("voucher")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
		
		redirect("laba_jurnal","refresh");
	}
	
	function cetak_excel_all(){
		$arrdata = $this->admin_m->cetak_excel_all($this->input->post("tglawal"),$this->input->post("tglakhir"));
		echo $arrdata;
	}
	function cetak_excel_cabang(){
		$arrdata = $this->admin_m->cetak_excel_cabang($this->input->post("tglawal"),$this->input->post("tglakhir"));
		echo $arrdata;
	}

	public function cetak_neraca(){
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setFontSubsetting(true);
		$pdf->AddPage("A4");
		$kasbesar=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=1000");
		$kasbesar1=mysql_fetch_assoc($kasbesar);
		$kaskecil=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=1001");
		$kaskecil1=mysql_fetch_assoc($kaskecil);
		$bank=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=1200");
		$bank1=mysql_fetch_assoc($bank);
		$pid=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=2000");
		$pid1=mysql_fetch_assoc($pid);
		$pil=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=2001");
		$pil1=mysql_fetch_assoc($pil);
		$pila=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=2003");
		$pila1=mysql_fetch_assoc($pila);
		$pib=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=3100");
		$pib1=mysql_fetch_assoc($pib);
		$bdd=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=3200");
		$bdd1=mysql_fetch_assoc($bdd);
		$tal=$kasbesar1["data"]+$kaskecil1["data"]+$bank1["data"]+$pid1["data"]+$pil1["data"]+$pila1["data"]+$pib1["data"]+$bdd1["data"];
		$hle=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=4001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$hle1=mysql_fetch_assoc($hle);
		$hla=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=4002 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$hla1=mysql_fetch_assoc($hla);
		$tkl=$hle1["data"]+$hla1["data"];
		$md=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=5000 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$md1=mysql_fetch_assoc($md);
		
		
		$kat1=mysql_query("SELECT sum(hsdiscount) as data from penjualan WHERE _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$kat1a=mysql_fetch_assoc($kat1);
		$kat2=mysql_query("SELECT sum(hargamodal) as data from penjualan WHERE _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$kat2a=mysql_fetch_assoc($kat2);
		
		$a=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=9004 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$a1=mysql_fetch_assoc($a);
		$b=mysql_query("SELECT sum(p_refund) as data from penjualan WHERE _deleted=0 AND tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$b1=mysql_fetch_assoc($b);
		$c=mysql_query("SELECT sum(p_asuransi) as data from penjualan WHERE _deleted=0 AND tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$c1=mysql_fetch_assoc($c);
		$d=mysql_query("SELECT sum(p_profisi) as data from penjualan WHERE _deleted=0 AND tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$d1=mysql_fetch_assoc($d);
		$e=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _jenis=9003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$e1=mysql_fetch_assoc($e);
		$kat3a=$a1["data"]+$b1["data"]+$c1["data"]+$d1["data"]+$e1["data"];
		
		$f=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9005 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$f1=mysql_fetch_assoc($f);
		$g=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9006 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$g1=mysql_fetch_assoc($g);
		$h=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9007 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$h1=mysql_fetch_assoc($h);
		$i=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=1 AND _jenis=9008 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$i1=mysql_fetch_assoc($i);
		$kat4a=$f1["data"]+$g1["data"]+$h1["data"]+$i1["data"];
		
		$kat5=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _jenis=8000 OR _jenis=8001 OR _jenis=8002 OR _jenis=8003 OR _jenis=8004 OR _jenis=8006 OR _jenis=8007 OR _jenis=8008 OR _jenis=8009 OR _jenis=8010 OR _jenis=8015 OR _jenis=8017 OR _jenis=8018 OR _jenis=8019 OR _jenis=8020 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$kat5a=mysql_fetch_assoc($kat5);
		
		$opbel=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=5001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$opbel1=mysql_fetch_assoc($opbel);
		
		$haskhirb=$kat1a["data"]-$kat2a["data"]+$kat3a+$kat4a-$kat5a["data"];
		$te=$md1["data"]+$haskhirb;
		$html = '
		<h3 align="center">SENTRAL MOTOR GROUP</h3><br>
		<h3 align="center">NERACA</h3>
		<h3 align="center">( dalam Rp. )</h3><br>
		<table width="100%">
			<tr>
				<td width="18%"><b>AKTIVA</b></td>
				<td width="32%"></td>
				<td width="3%"></td>
				<td width="24%"></td>
				<td width="23%"></td>
			</tr>
			<tr>
				<td>Aktiva Lancar</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>1 Kas besar</td>
				<td>Rp</td>
				<td align="right">'.number_format($kasbesar1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>2 Kas Kecil</td>
				<td>Rp</td>
				<td align="right">'.number_format($kaskecil1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>3 Bank</td>
				<td>Rp</td>
				<td align="right">'.number_format($bank1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>4 Piutang Dagang</td>
				<td>Rp</td>
				<td align="right">'.number_format($pid1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>5 Piutang Leasing</td>
				<td>Rp</td>
				<td align="right">'.number_format($pil1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>6 Piutang Lain - Lain / Loan</td>
				<td>Rp</td>
				<td align="right">'.number_format($pila1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>7 Persediaan Barang Dagang</td>
				<td>Rp</td>
				<td align="right">'.number_format($pib1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>8 Biaya Dibayar Dimuka</td>
				<td>Rp</td>
				<td align="right">'.number_format($bdd1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Total Aktiva Lancar</td>
				<td align="right">'.number_format($tal).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><b>Total Aktiva</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($tal).'</b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>PASSIVA</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Kewajiban Lancar</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>1 Hutang Leasing</td>
				<td>Rp</td>
				<td align="right">'.number_format($hle1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>2 Hutang Lain - Lain</td>
				<td>Rp</td>
				<td align="right">'.number_format($hla1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Total Kewajiban Lancar</td>
				<td align="right">'.number_format($tkl).'</td>
			</tr>
			<tr>
				<td>Ekuitas</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>1 Modal Disetor</td>
				<td>Rp</td>
				<td align="right">'.number_format($md1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>2 Profit Bulan Ini</td>
				<td>Rp</td>
				<td align="right">'.number_format($haskhirb).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>3 Opening Balance</td>
				<td>Rp</td>
				<td align="right">'.number_format($opbel1["data"]).'</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td>Total Ekuitas</td>
				<td align="right">'.number_format($te).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><b>Total Aktiva</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($tkl+$te+$opbel1["data"]).'</b></td>
			</tr>
		</table>
		<br>
		';
		
   
		$pdf->writeHTML($html, true, false, false, false, '');
		$pdf->Output('output_1.pdf', 'I');
	}
}