<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laba_Neraca extends CI_Controller {

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
		$this->load->view('laba_neraca_v');
	}
	public function cetak()
	{
		if($this->input->post("cabang") == "0")
		{
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setFontSubsetting(true);
			$pdf->AddPage("A4");
			$kasbesar=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=1000");
			$kasbesar1=mysql_fetch_assoc($kasbesar);
			$kaskecil=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=1001 AND _cabang=5");
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
			
			$kat5=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8000 OR _jenis=8001 OR _jenis=8002 OR _jenis=8003 OR _jenis=8004 OR _jenis=8006 OR _jenis=8016 OR _jenis=8007 OR _jenis=8008 OR _jenis=8009 OR _jenis=8010 OR _jenis=8011 OR _jenis=8015 OR _jenis=8017 OR _jenis=8018 OR _jenis=8019 OR _jenis=8020 OR _jenis=8021 OR _jenis=8022 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
			$kat5a=mysql_fetch_assoc($kat5);
			
		//--Start Profit Bulan Ini
										$otrbulan="0";$modalbulan="0";$bungabulan="0";$asuransibulan="0";$provisibulan="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset'
														AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $hbulan)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$hbulan->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($hbulan->tipebayar == 'Cash') 
													{
														if ($hbulan->hsdiscount == $uang1["data"]) 
														{
															$otrbulan+=$hbulan->hsdiscount;
															$modalbulan+=$hbulan->hargamodal;
															$bungabulan+=$hbulan->p_refund;
															$asuransibulan+=$hbulan->p_asuransi;
															$provisibulan+=$hbulan->p_profisi;
														}	
													} 
													else if ($hbulan->tipebayar == 'Kredit') 
													{
														if ($hbulan->totaldp == $uang1["data"] && $hbulan->tgl_pelunasan != '0000-00-00') 
														{
															$otrbulan+=$hbulan->hsdiscount;
															$modalbulan+=$hbulan->hargamodal;
															$bungabulan+=$hbulan->p_refund;
															$asuransibulan+=$hbulan->p_asuransi;
															$provisibulan+=$hbulan->p_profisi;
														}
													}
											}
										}
										
		$gajibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8000 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$gajibulan1=mysql_fetch_assoc($gajibulan);
		$insentivebulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$insentivebulan1=mysql_fetch_assoc($insentivebulan);
		$makanbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8002 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$makanbulan1=mysql_fetch_assoc($makanbulan);
		$atkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$atkbulan1=mysql_fetch_assoc($atkbulan);
		$sewabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8004 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sewabulan1=mysql_fetch_assoc($sewabulan);
		$tolbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8006 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tolbulan1=mysql_fetch_assoc($tolbulan);
		$tlpbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8007 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tlpbulan1=mysql_fetch_assoc($tlpbulan);
		$listrikbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8008 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$listrikbulan1=mysql_fetch_assoc($listrikbulan);
		$peliharabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8009 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$peliharabulan1=mysql_fetch_assoc($peliharabulan);
		$entertainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8010 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$entertainbulan1=mysql_fetch_assoc($entertainbulan);
		$sumbanganbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8011 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sumbanganbulan1=mysql_fetch_assoc($sumbanganbulan);
		$surveybulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8015 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$surveybulan1=mysql_fetch_assoc($surveybulan);
		$lainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8017 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$lainbulan1=mysql_fetch_assoc($lainbulan);
		$komisibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8018 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$komisibulan1=mysql_fetch_assoc($komisibulan);
		$rtbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8019 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$rtbulan1=mysql_fetch_assoc($rtbulan);
		$accbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8020 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$accbulan1=mysql_fetch_assoc($accbulan);
		$pbkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8021 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$pbkbulan1=mysql_fetch_assoc($pbkbulan);
		$kacabbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8016 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$kacabbulan1=mysql_fetch_assoc($kacabbulan);
		$subsidibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8022 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$subsidibulan1=mysql_fetch_assoc($subsidibulan);
		$t1bln=$subsidibulan1["data"]+$pbkbulan1["data"]+$kacabbulan1["data"]+$gajibulan1["data"]+$insentivebulan1["data"]+$makanbulan1["data"]+$atkbulan1["data"]+$sewabulan1["data"]+$tolbulan1["data"]+$tlpbulan1["data"]+$listrikbulan1["data"]+$peliharabulan1["data"]+$entertainbulan1["data"]+$sumbanganbulan1["data"]+$surveybulan1["data"]+$lainbulan1["data"]+$komisibulan1["data"]+$rtbulan1["data"]+$accbulan1["data"];
		//--End Profit Loss Bulan Ini
		
			$opbel=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=5001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
			$opbel1=mysql_fetch_assoc($opbel);
			
			$haskhirb=$kat1a["data"]-$kat2a["data"]+$kat3a+$kat4a-$t1bln;
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
					<td align="right">'.number_format($modalbulan).'</td>
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
			$pdf->Output('Laba Neraca.pdf', 'I');
		}
		else
		{
		
		}
	}
	
}