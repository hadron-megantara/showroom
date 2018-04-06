<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laba_Cabang extends CI_Controller {

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
		$this->load->view('laba_cabang_v');
	}
	public function cari()
	{
		$this->load->view('laba_cabang_cari_v');
	}
	public function detail()
	{
		$this->load->view('laba_cabang_detail_v');
	}
	public function cetak_group()
	{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setFontSubsetting(true);
		$pdf->AddPage("A4");
		$tpquerry=mysql_query("SELECT * FROM _cabang WHERE _deleted=0 AND code not like 1");
		$tpquerry1=mysql_query("SELECT * FROM _cabang WHERE _deleted=0 AND code not like 1");
		$header = '
		SENTRAL GROUP
		<br>
		<font align="center">LAPORAN LABA RUGI</font> <br>
		<font align="center">( dalam Rp. )</font> <br><br>
		<table width="100%">
			<tr>
				<td width="34%"></td>
				<td width="33%" align="center">Bulan Ini</td>
				<td width="33%" align="center">Tahun Ini</td>
			</tr>
			<tr>
				<td>Pendapatan/Penjualan</td>
				<td></td>
				<td></td>
			</tr>
			';
			
		$tp1 = '';
		$ttpp1b=0;$ttpp1t=0;
		while($row = mysql_fetch_array($tpquerry))
		{
		
										$otrbulan="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']." 
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']."
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
														}	
													} 
													else if ($hbulan->tipebayar == 'Kredit') 
													{
														if ($hbulan->totaldp == $uang1["data"] && $hbulan->tgl_pelunasan != '0000-00-00') 
														{
															$otrbulan+=$hbulan->hsdiscount;
														}
													}
											}
										}
										
										$otrtahun="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']."
														AND tgl_pelunasan LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $htahun)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$htahun->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($htahun->tipebayar == 'Cash') 
													{
														if ($htahun->hsdiscount == $uang1["data"]) 
														{
															$otrtahun+=$htahun->hsdiscount;
														}	
													} 
													else if ($htahun->tipebayar == 'Kredit') 
													{
														if ($htahun->totaldp == $uang1["data"] && $htahun->tgl_pelunasan != '0000-00-00') 
														{
															$otrtahun+=$htahun->hsdiscount;
														}
													}
											}
										}
										
		$tp1 .= 
			'
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['data'].'</td>
					<td align="right">'.number_format($otrbulan).'</td>
					<td align="right">'.number_format($otrtahun).'</td>
				</tr>
			';
	    $ttpp1b+=$otrbulan;
	    $ttpp1t+=$otrtahun;
		}
		$tp1footer = '
			<tr>
				<td><b>Total Pendapatan</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($ttpp1b).'</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($ttpp1t).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Harga Pokok Penjualan</td>
				<td></td>
				<td></td>
			</tr>
		';
		
		
		$tp2 = '';
		$hppp1b=0;$hppp1t=0;
		while($row = mysql_fetch_array($tpquerry1))
		{
										$modalbulan="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']." 
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']."
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
															$modalbulan+=$hbulan->hargamodal;
														}	
													} 
													else if ($hbulan->tipebayar == 'Kredit') 
													{
														if ($hbulan->totaldp == $uang1["data"] && $hbulan->tgl_pelunasan != '0000-00-00') 
														{
															$modalbulan+=$hbulan->hargamodal;
														}
													}
											}
										}
										
										$modaltahun="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row['code']."
														AND tgl_pelunasan LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $htahun)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$htahun->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($htahun->tipebayar == 'Cash') 
													{
														if ($htahun->hsdiscount == $uang1["data"]) 
														{
															$modaltahun+=$htahun->hargamodal;
														}	
													} 
													else if ($htahun->tipebayar == 'Kredit') 
													{
														if ($htahun->totaldp == $uang1["data"] && $htahun->tgl_pelunasan != '0000-00-00') 
														{
															$modaltahun+=$htahun->hargamodal;
														}
													}
											}
										}
		$tp2 .= 
			'
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['data'].'</td>
					<td align="right">'.number_format($modalbulan).'</td>
					<td align="right">'.number_format($modaltahun).'</td>
				</tr>
			';
	    $hppp1b+=$modalbulan;
	    $hppp1t+=$modaltahun;
		}
		$tp2footer = '
			<tr>
				<td><b>Total HPP</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($hppp1b).'</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($hppp1t).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		';
		$jgirob=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=9004 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$jgirob1=mysql_fetch_assoc($jgirob);
		$jgirot=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=9004 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$jgirot1=mysql_fetch_assoc($jgirot);
		$pelainbulan=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _jenis=9003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$pelainbulan1=mysql_fetch_assoc($pelainbulan);
		$pelaintahun=mysql_query("SELECT sum(kredit) as data from laba_rugi WHERE _jenis=9003 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$pelaintahun1=mysql_fetch_assoc($pelaintahun);
		
		
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
										
										$otrtahun="0";$modaltahun="0";$bungatahun="0";$asuransitahun="0";$provisitahun="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset'
														AND tgl_pelunasan LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $htahun)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$htahun->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($htahun->tipebayar == 'Cash') 
													{
														if ($htahun->hsdiscount == $uang1["data"]) 
														{
															$otrtahun+=$htahun->hsdiscount;
															$modaltahun+=$htahun->hargamodal;
															$bungatahun+=$htahun->p_refund;
															$asuransitahun+=$htahun->p_asuransi;
															$provisitahun+=$htahun->p_profisi;
														}	
													} 
													else if ($htahun->tipebayar == 'Kredit') 
													{
														if ($htahun->totaldp == $uang1["data"] && $htahun->tgl_pelunasan != '0000-00-00') 
														{
															$otrtahun+=$htahun->hsdiscount;
															$modaltahun+=$htahun->hargamodal;
															$bungatahun+=$htahun->p_refund;
															$asuransitahun+=$htahun->p_asuransi;
															$provisitahun+=$htahun->p_profisi;
														}
													}
											}
										}
										
		$tpbl1b=$jgirob1["data"]+$bungabulan+$asuransibulan+$provisibulan+$pelainbulan1["data"];
		$tpbl1t=$jgirot1["data"]+$bungatahun+$asuransitahun+$provisitahun+$pelaintahun1["data"];
		$no3='
			<tr>
				<td>Pendapatan ( Biaya ) Lain</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jasa Giro</td>
				<td align="right">'.number_format($jgirob1["data"]).'</td>
				<td align="right">'.number_format($jgirot1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Refund Bunga</td>
				<td align="right">'.number_format($bungabulan).'</td>
				<td align="right">'.number_format($bungatahun).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Refund Asuransi</td>
				<td align="right">'.number_format($asuransibulan).'</td>
				<td align="right">'.number_format($asuransitahun).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Provisi</td>
				<td align="right">'.number_format($provisibulan).'</td>
				<td align="right">'.number_format($provisitahun).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pendapatan Lain</td>
				<td align="right">'.number_format($pelainbulan1["data"]).'</td>
				<td align="right">'.number_format($pelaintahun1["data"]).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>Total Pendapatan ( Biaya ) Lain</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($tpbl1b).'</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($tpbl1t).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		';
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
		$no4='
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
		';
		
		$gajibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8000 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$gajibulan1=mysql_fetch_assoc($gajibulan);
		$gajitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8000 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$gajitahun1=mysql_fetch_assoc($gajitahun);
		$insentivebulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$insentivebulan1=mysql_fetch_assoc($insentivebulan);
		$insentivetahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8001 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$insentivetahun1=mysql_fetch_assoc($insentivetahun);
		$makanbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8002 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$makanbulan1=mysql_fetch_assoc($makanbulan);
		$makantahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8002 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$makantahun1=mysql_fetch_assoc($makantahun);
		$atkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$atkbulan1=mysql_fetch_assoc($atkbulan);
		$atktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8003 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$atktahun1=mysql_fetch_assoc($atktahun);
		$sewabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8004 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sewabulan1=mysql_fetch_assoc($sewabulan);
		$sewatahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8004 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$sewatahun1=mysql_fetch_assoc($sewatahun);
		$tolbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8006 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tolbulan1=mysql_fetch_assoc($tolbulan);
		$toltahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8006 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$toltahun1=mysql_fetch_assoc($toltahun);
		$tlpbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8007 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tlpbulan1=mysql_fetch_assoc($tlpbulan);
		$tlptahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8007 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$tlptahun1=mysql_fetch_assoc($tlptahun);
		$listrikbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8008 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$listrikbulan1=mysql_fetch_assoc($listrikbulan);
		$listriktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8008 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$listriktahun1=mysql_fetch_assoc($listriktahun);
		$peliharabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8009 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$peliharabulan1=mysql_fetch_assoc($peliharabulan);
		$peliharatahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8009 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$peliharatahun1=mysql_fetch_assoc($peliharatahun);
		$entertainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8010 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$entertainbulan1=mysql_fetch_assoc($entertainbulan);
		$entertaintahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8010 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$entertaintahun1=mysql_fetch_assoc($entertaintahun);
		$sumbanganbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8011 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sumbanganbulan1=mysql_fetch_assoc($sumbanganbulan);
		$sumbangantahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8011 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$sumbangantahun1=mysql_fetch_assoc($sumbangantahun);
		$surveybulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8015 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$surveybulan1=mysql_fetch_assoc($surveybulan);
		$surveytahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8015 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$surveytahun1=mysql_fetch_assoc($surveytahun);
		$lainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8017 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$lainbulan1=mysql_fetch_assoc($lainbulan);
		$laintahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8017 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$laintahun1=mysql_fetch_assoc($laintahun);
		$komisibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8018 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$komisibulan1=mysql_fetch_assoc($komisibulan);
		$komisitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8018 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$komisitahun1=mysql_fetch_assoc($komisitahun);
		$rtbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8019 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$rtbulan1=mysql_fetch_assoc($rtbulan);
		$rttahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8019 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$rttahun1=mysql_fetch_assoc($rttahun);
		$accbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8020 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$accbulan1=mysql_fetch_assoc($accbulan);
		$acctahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8020 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$acctahun1=mysql_fetch_assoc($acctahun);
		$pbkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8021 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$pbkbulan1=mysql_fetch_assoc($pbkbulan);
		$pbktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8021 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$pbktahun1=mysql_fetch_assoc($pbktahun);
		$kacabbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8016 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$kacabbulan1=mysql_fetch_assoc($kacabbulan);
		$kacabtahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8016 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$kacabtahun1=mysql_fetch_assoc($kacabtahun);
		$subsidibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8022 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$subsidibulan1=mysql_fetch_assoc($subsidibulan);
		$subsiditahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8022 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$subsiditahun1=mysql_fetch_assoc($subsiditahun);
		$materaibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8023 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$materaibulan1=mysql_fetch_assoc($materaibulan);
		$materaitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _jenis=8023 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$materaitahun1=mysql_fetch_assoc($materaitahun);
		
		$t1bln=$materaibulan1["data"]+$subsidibulan1["data"]+$pbkbulan1["data"]+$kacabbulan1["data"]+$gajibulan1["data"]+$insentivebulan1["data"]+$makanbulan1["data"]+$atkbulan1["data"]+$sewabulan1["data"]+$tolbulan1["data"]+$tlpbulan1["data"]+$listrikbulan1["data"]+$peliharabulan1["data"]+$entertainbulan1["data"]+$sumbanganbulan1["data"]+$surveybulan1["data"]+$lainbulan1["data"]+$komisibulan1["data"]+$rtbulan1["data"]+$accbulan1["data"];
		$t1thn=$materaitahun1["data"]+$subsiditahun1["data"]+$pbktahun1["data"]+$kacabtahun1["data"]+$gajitahun1["data"]+$insentivetahun1["data"]+$makantahun1["data"]+$atktahun1["data"]+$sewatahun1["data"]+$toltahun1["data"]+$tlptahun1["data"]+$listriktahun1["data"]+$peliharatahun1["data"]+$entertaintahun1["data"]+$sumbangantahun1["data"]+$surveytahun1["data"]+$laintahun1["data"]+$komisitahun1["data"]+$rttahun1["data"]+$acctahun1["data"];
		
		$no5='
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Biaya Operasional :</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1 Biaya Gaji</td>
				<td align="right">'.number_format($gajibulan1["data"]).'</td>
				<td align="right">'.number_format($gajitahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2 Biaya Insentive</td>
				<td align="right">'.number_format($insentivebulan1["data"]).'</td>
				<td align="right">'.number_format($insentivetahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3 Biaya Makan</td>
				<td align="right">'.number_format($makanbulan1["data"]).'</td>
				<td align="right">'.number_format($makantahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4 ATK, Cetakan, Pos & Kurir</td>
				<td align="right">'.number_format($atkbulan1["data"]).'</td>
				<td align="right">'.number_format($atktahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5 Biaya Sewa</td>
				<td align="right">'.number_format($sewabulan1["data"]).'</td>
				<td align="right">'.number_format($sewatahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6 Biaya Tol, Bensin, Parkir</td>
				<td align="right">'.number_format($tolbulan1["data"]).'</td>
				<td align="right">'.number_format($toltahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7 Biaya Tol, Bensin, KACAB</td>
				<td align="right">'.number_format($kacabbulan1["data"]).'</td>
				<td align="right">'.number_format($kacabtahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8 Biaya Telepon, Fax</td>
				<td align="right">'.number_format($tlpbulan1["data"]).'</td>
				<td align="right">'.number_format($tlptahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9 Biaya Listrik</td>
				<td align="right">'.number_format($listrikbulan1["data"]).'</td>
				<td align="right">'.number_format($listriktahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10 Biaya Pemeliharaan</td>
				<td align="right">'.number_format($peliharabulan1["data"]).'</td>
				<td align="right">'.number_format($peliharatahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;11 Entertainment</td>
				<td align="right">'.number_format($entertainbulan1["data"]).'</td>
				<td align="right">'.number_format($entertaintahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;12 Sumbangan</td>
				<td align="right">'.number_format($sumbanganbulan1["data"]).'</td>
				<td align="right">'.number_format($sumbangantahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13 Biaya Survey</td>
				<td align="right">'.number_format($surveybulan1["data"]).'</td>
				<td align="right">'.number_format($surveytahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;14 Biaya Lain-Lain</td>
				<td align="right">'.number_format($lainbulan1["data"]).'</td>
				<td align="right">'.number_format($laintahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;15 Biaya Komisi</td>
				<td align="right">'.number_format($komisibulan1["data"]).'</td>
				<td align="right">'.number_format($komisitahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;16 Biaya Keperluan Kantor</td>
				<td align="right">'.number_format($rtbulan1["data"]).'</td>
				<td align="right">'.number_format($rttahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;17 Biaya Aksesoris</td>
				<td align="right">'.number_format($accbulan1["data"]).'</td>
				<td align="right">'.number_format($acctahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;18 Pajak & BBN Kendaraan</td>
				<td align="right">'.number_format($pbkbulan1["data"]).'</td>
				<td align="right">'.number_format($pbktahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;19 Subsidi</td>
				<td align="right">'.number_format($subsidibulan1["data"]).'</td>
				<td align="right">'.number_format($subsiditahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;20 Materai</td>
				<td align="right">'.number_format($materaibulan1["data"]).'</td>
				<td align="right">'.number_format($materaitahun1["data"]).'</td>
			</tr>
			<tr>
				<td><b>Total Biaya Operasional</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($t1bln).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($t1thn).'</b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		';
		$haskhirb=$ttpp1b-$hppp1b+$tpbl1b+$tpb-$t1bln;
		$haskhirt=$ttpp1t-$hppp1t+$tpbl1t+$tpt-$t1thn;
		
		$hasilakhir='
			<tr>
				<td style="border-bottom:1px;border-top:1px"><b>Profit/Loss Bulan Ini</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($haskhirb).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($haskhirt).'</b></td>
			</tr>
		';
		
		
		$footer = '
		</table>
		';
		
   
		$pdf->writeHTML($header.$tp1.$tp1footer.$tp2.$tp2footer.$no3.$no4.$no5.$hasilakhir.$footer, true, false, false, false, '');
		$pdf->Output('output_1.pdf', 'I');
	}
	public function cetak_cabang()
	{
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setFontSubsetting(true);
		$pdf->AddPage("A4");
		$ncab=mysql_query("SELECT data as data from _cabang WHERE code=".$this->input->post("iddata")." ");
		$ncab1=mysql_fetch_assoc($ncab);
		
										$otrbulan="0";$modalbulan="0";$bungabulan="0";$asuransibulan="0";$provisibulan="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$this->input->post("iddata")."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$this->input->post("iddata")."
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
										
										$otrtahun="0";$modaltahun="0";$bungatahun="0";$asuransitahun="0";$provisitahun="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$this->input->post("iddata")."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$this->input->post("iddata")."
														AND tgl_pelunasan LIKE '%".substr($this->input->post("tglawal"),0,4)."%'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $htahun)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$htahun->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($htahun->tipebayar == 'Cash') 
													{
														if ($htahun->hsdiscount == $uang1["data"]) 
														{
															$otrtahun+=$htahun->hsdiscount;
															$modaltahun+=$htahun->hargamodal;
															$bungatahun+=$htahun->p_refund;
															$asuransitahun+=$htahun->p_asuransi;
															$provisitahun+=$htahun->p_profisi;
														}	
													} 
													else if ($htahun->tipebayar == 'Kredit') 
													{
														if ($htahun->totaldp == $uang1["data"] && $htahun->tgl_pelunasan != '0000-00-00') 
														{
															$otrtahun+=$htahun->hsdiscount;
															$modaltahun+=$htahun->hargamodal;
															$bungatahun+=$htahun->p_refund;
															$asuransitahun+=$htahun->p_asuransi;
															$provisitahun+=$htahun->p_profisi;
														}
													}
											}
										}
		$pbkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8021 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$pbkbulan1=mysql_fetch_assoc($pbkbulan);
		$pbktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8021 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$pbktahun1=mysql_fetch_assoc($pbktahun);
		$kacabbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8016 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$kacabbulan1=mysql_fetch_assoc($kacabbulan);
		$kacabtahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8016 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$kacabtahun1=mysql_fetch_assoc($kacabtahun);
		
		$subsidibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8022 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$subsidibulan1=mysql_fetch_assoc($subsidibulan);
		$subsiditahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8022 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$subsiditahun1=mysql_fetch_assoc($subsiditahun);
		$materaibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8023 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$materaibulan1=mysql_fetch_assoc($materaibulan);
		$materaitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8023 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$materaitahun1=mysql_fetch_assoc($materaitahun);
		
		$gajibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8000 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$gajibulan1=mysql_fetch_assoc($gajibulan);
		$gajitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8000 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$gajitahun1=mysql_fetch_assoc($gajitahun);
		$insentivebulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8001 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$insentivebulan1=mysql_fetch_assoc($insentivebulan);
		$insentivetahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8001 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$insentivetahun1=mysql_fetch_assoc($insentivetahun);
		$makanbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8002 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$makanbulan1=mysql_fetch_assoc($makanbulan);
		$makantahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8002 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$makantahun1=mysql_fetch_assoc($makantahun);
		$atkbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$atkbulan1=mysql_fetch_assoc($atkbulan);
		$atktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8003 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$atktahun1=mysql_fetch_assoc($atktahun);
		$sewabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8004 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sewabulan1=mysql_fetch_assoc($sewabulan);
		$sewatahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8004 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$sewatahun1=mysql_fetch_assoc($sewatahun);
		$tolbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8006 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tolbulan1=mysql_fetch_assoc($tolbulan);
		$toltahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8006 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$toltahun1=mysql_fetch_assoc($toltahun);
		
		
		$tlpbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8007 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$tlpbulan1=mysql_fetch_assoc($tlpbulan);
		$tlptahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8007 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$tlptahun1=mysql_fetch_assoc($tlptahun);
		$listrikbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8008 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$listrikbulan1=mysql_fetch_assoc($listrikbulan);
		$listriktahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8008 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$listriktahun1=mysql_fetch_assoc($listriktahun);
		$peliharabulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8009 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$peliharabulan1=mysql_fetch_assoc($peliharabulan);
		$peliharatahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8009 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$peliharatahun1=mysql_fetch_assoc($peliharatahun);
		$entertainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8010 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$entertainbulan1=mysql_fetch_assoc($entertainbulan);
		$entertaintahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8010 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$entertaintahun1=mysql_fetch_assoc($entertaintahun);
		
		$sumbanganbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8011 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$sumbanganbulan1=mysql_fetch_assoc($sumbanganbulan);
		$sumbangantahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8011 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$sumbangantahun1=mysql_fetch_assoc($sumbangantahun);
		
		$surveybulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8015 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$surveybulan1=mysql_fetch_assoc($surveybulan);
		$surveytahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8015 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$surveytahun1=mysql_fetch_assoc($surveytahun);
		$lainbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8017 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$lainbulan1=mysql_fetch_assoc($lainbulan);
		$laintahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8017 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$laintahun1=mysql_fetch_assoc($laintahun);
		$komisibulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8018 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$komisibulan1=mysql_fetch_assoc($komisibulan);
		$komisitahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8018 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$komisitahun1=mysql_fetch_assoc($komisitahun);
		$rtbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8019 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$rtbulan1=mysql_fetch_assoc($rtbulan);
		$rttahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8019 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$rttahun1=mysql_fetch_assoc($rttahun);
		$accbulan=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8020 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$accbulan1=mysql_fetch_assoc($accbulan);
		$acctahun=mysql_query("SELECT sum(debit-kredit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=8020 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$acctahun1=mysql_fetch_assoc($acctahun);
		
		$pelainbulan=mysql_query("SELECT sum(kredit-debit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=9003 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
		$pelainbulan1=mysql_fetch_assoc($pelainbulan);
		$pelaintahun=mysql_query("SELECT sum(kredit-debit) as data from laba_rugi WHERE _cabang=".$this->input->post("iddata")." AND _jenis=9003 AND tgl LIKE '%".substr($this->input->post("tglawal"),0,4)."%'");
		$pelaintahun1=mysql_fetch_assoc($pelaintahun);
		
		$t1bln=$materaibulan1["data"]+$subsidibulan1["data"]+$kacabbulan1["data"]+$pbkbulan1["data"]+$gajibulan1["data"]+$insentivebulan1["data"]+$makanbulan1["data"]+$atkbulan1["data"]+$sewabulan1["data"]+$tolbulan1["data"]+$tlpbulan1["data"]+$listrikbulan1["data"]+$peliharabulan1["data"]+$entertainbulan1["data"]+$sumbanganbulan1["data"]+$surveybulan1["data"]+$lainbulan1["data"]+$komisibulan1["data"]+$rtbulan1["data"]+$accbulan1["data"];
		$t1thn=$materaitahun1["data"]+$subsiditahun1["data"]+$kacabtahun1["data"]+$pbktahun1["data"]+$gajitahun1["data"]+$insentivetahun1["data"]+$makantahun1["data"]+$atktahun1["data"]+$sewatahun1["data"]+$toltahun1["data"]+$tlptahun1["data"]+$listriktahun1["data"]+$peliharatahun1["data"]+$entertaintahun1["data"]+$sumbangantahun1["data"]+$surveytahun1["data"]+$laintahun1["data"]+$komisitahun1["data"]+$rttahun1["data"]+$acctahun1["data"];
		$t2bln=$bungabulan+$asuransibulan+$pelainbulan1["data"]+$provisibulan;
		$t2thn=$bungatahun+$asuransitahun+$pelaintahun1["data"]+$provisitahun;
		
		$html = '
		<br>
		<br>
		<font align="center">LAPORAN LABA RUGI</font> <br><br>
		<b>'.$ncab1["data"].'</b><br>
		Untuk periode <b>'.date("d M Y", strtotime($this->input->post("tglawal"))).'</b> sampai <b>'.date("d M Y", strtotime($this->input->post("tglakhir"))).'</b> <br>
		( dalam Rp. ) <br>
		<table width="100%">
			<tr>
				<td width="50%"></td>
				<td width="25%" align="center">Bulan Ini</td>
				<td width="25%" align="center">Tahun Ini</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Penjualan</td>
				<td align="right">'.number_format($otrbulan).'</td>
				<td align="right">'.number_format($otrtahun).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Penjualan</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($otrbulan).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($otrtahun).'</b></td>
			</tr>
			<tr>
				<td>Harga Pokok Penjualan :</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Harga Modal</b></td>
				<td align="right"><b>'.number_format($modalbulan).'</b></td>
				<td align="right"><b>'.number_format($modaltahun).'</b></td>
			</tr>
			<tr>
				<td>Total Harga Modal :</td>
				<td align="right">'.number_format($modalbulan).'</td>
				<td align="right">'.number_format($modaltahun).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Laba ( Rugi ) Kotor</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($otrbulan-$modalbulan).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($otrtahun-$modaltahun).'</b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Biaya Operasional :</td>
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
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Sewa</td>
				<td align="right">'.number_format($sewabulan1["data"]).'</td>
				<td align="right">'.number_format($sewatahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Tol, Bensin, Parkir & Transport</td>
				<td align="right">'.number_format($tolbulan1["data"]).'</td>
				<td align="right">'.number_format($toltahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Tol, Bensin, KACAB</td>
				<td align="right">'.number_format($kacabbulan1["data"]).'</td>
				<td align="right">'.number_format($kacabtahun1["data"]).'</td>
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
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Survey</td>
				<td align="right">'.number_format($surveybulan1["data"]).'</td>
				<td align="right">'.number_format($surveytahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Lain-Lain</td>
				<td align="right">'.number_format($lainbulan1["data"]).'</td>
				<td align="right">'.number_format($laintahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Komisi</td>
				<td align="right">'.number_format($komisibulan1["data"]).'</td>
				<td align="right">'.number_format($komisitahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Keperluan RT Kantor</td>
				<td align="right">'.number_format($rtbulan1["data"]).'</td>
				<td align="right">'.number_format($rttahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Biaya Acesories Kendaraan</td>
				<td align="right">'.number_format($accbulan1["data"]).'</td>
				<td align="right">'.number_format($acctahun1["data"]).'</td>
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
				<td></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($t1bln).'</b></td>
				<td align="right" style="border-bottom:1px;border-top:1px"><b>'.number_format($t1thn).'</b></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Laba ( Rugi ) Operasi </b></td>
				<td align="right">'.number_format($otrbulan-$modalbulan-$t1bln).'</td>
				<td align="right">'.number_format($otrtahun-$modaltahun-$t1thn).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Pendapatan ( Biaya ) Lain :</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Refund Bunga</td>
				<td align="right">'.number_format($bungabulan).'</td>
				<td align="right">'.number_format($bungatahun).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Refund Asuransi</td>
				<td align="right">'.number_format($asuransibulan).'</td>
				<td align="right">'.number_format($asuransitahun).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pendapatan Lain</td>
				<td align="right">'.number_format($pelainbulan1["data"]).'</td>
				<td align="right">'.number_format($pelaintahun1["data"]).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provisi</td>
				<td align="right">'.number_format($provisibulan).'</td>
				<td align="right">'.number_format($provisitahun).'</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Total Pendapatan ( Biaya ) Lain</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($t2bln).'</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format($t2thn).'</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Profit Bersih Bulan Ini</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format(($otrbulan-$modalbulan-$t1bln)+$t2bln).'</td>
				<td align="right" style="border-bottom:1px;border-top:1px">'.number_format(($otrtahun-$modaltahun-$t1thn)+$t2thn).'</td>
			</tr>
		</table>
		
		';
		
   
		$pdf->writeHTML($html, true, false, false, false, '');
		$pdf->Output('output_1.pdf', 'I');
	}
}