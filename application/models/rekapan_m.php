<?php
class Rekapan_M extends CI_Model
{
	function get_all(){
		if($this->session->userdata('sm_username')){
			date_default_timezone_set ("Asia/Jakarta");
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',15),array('C',15),array('D',15),array('E',15),array('F',15),array('G',15),array('H',15),
				array('I',15),array('J',15),array('K',15),array('L',15),array('M',15),array('N',15),array('O',15),array('P',15),array('Q',15),array('R',15)
				,array('S',15),array('T',15),array('U',15),array('V',15),array('W',15),array('X',15),array('Y',15),array('Z',15),array('AA',15),array('AB',15)
				,array('AC',15),array('AD',15),array('AE',15),array('AF',15),array('AG',15),array('AH',15),array('AI',15),array('AJ',15),array('AK',15),array('AL',15)
				,array('AM',15),array('AN',15),array('AO',15),array('AP',15),array('AQ',15),array('AR',15),array('AS',15),array('AT',15),array('AU',15)
				,array('AV',15),array('AW',15),array('AX',15),array('AY',15),array('AZ',15),array('BA',15),array('BB',15)));
				
					$no=1;	
					$rec=4;
					$bom=3;
					$nop=1;
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A2','Detail Semua Proses Sampai Tanggal '.date("d M Y"));
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':BC'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					
					$this->newphpexcel->setActiveSheetIndex(0)
					->setCellValue('A'.$bom, 'No')
					->setCellValue('B'.$bom, 'Cabang')
					->setCellValue('C'.$bom, 'Konsumen') 
					->setCellValue('D'.$bom, 'Leasing/Cash')
					->setCellValue('E'.$bom, 'Tgl SPK')
					->setCellValue('F'.$bom, 'Tgl PO')
					->setCellValue('G'.$bom, 'Usia SPK')
					->setCellValue('H'.$bom, 'Keterangan')
					->setCellValue('I'.$bom, 'Telepon')  
					->setCellValue('J'.$bom, 'Tipe Bayar')
					->setCellValue('K'.$bom, 'Jenis Kendaraan')
					->setCellValue('L'.$bom, 'No. Polisi')
					->setCellValue('M'.$bom, 'Jenis')
					->setCellValue('N'.$bom, 'Tipe')
					->setCellValue('O'.$bom, 'Tahun')
					->setCellValue('P'.$bom, 'Warna')
					->setCellValue('Q'.$bom, 'Tgl Mati Pajak')
					->setCellValue('R'.$bom, 'Ket')
					->setCellValue('S'.$bom, 'Domisili')
					->setCellValue('T'.$bom, 'Catatan')
					->setCellValue('U'.$bom, 'Harga Modal')
					->setCellValue('V'.$bom, 'Harga Jual')
					->setCellValue('W'.$bom, 'Discount')
					->setCellValue('W'.$bom, 'Harga Setelah Discount')
					->setCellValue('Y'.$bom, 'Selisih Jual')
					->setCellValue('Z'.$bom, 'Profit OTR')
					->setCellValue('AA'.$bom, 'Persentase')
					->setCellValue('AB'.$bom, 'DP Min')
					->setCellValue('AC'.$bom, 'Tenor')
					->setCellValue('AD'.$bom, 'Angsuran')
					->setCellValue('AE'.$bom, 'Biaya Adm')
					->setCellValue('AF'.$bom, 'Asuransi')
					->setCellValue('AG'.$bom, 'Biaya Polis Asuransi')
					->setCellValue('AH'.$bom, 'Profisi')
					->setCellValue('AI'.$bom, 'Total DP')
					->setCellValue('AJ'.$bom, 'Tanda Jadi')
					->setCellValue('AK'.$bom, 'Pelunasan 1')
					->setCellValue('AL'.$bom, 'Pelunasan 2')
					->setCellValue('AM'.$bom, 'Pelunasan 3')
					->setCellValue('AN'.$bom, 'Pelunasan 4')
					->setCellValue('AO'.$bom, 'Pelunasan 5')
					->setCellValue('AP'.$bom, 'Total Tanda Jadi')
					->setCellValue('AQ'.$bom, 'AR DP')
					->setCellValue('AR'.$bom, 'AR Leasing')
					->setCellValue('AS'.$bom, 'Nominal Reff Profisi')
					->setCellValue('AT'.$bom, 'Nominal Reff Bunga')
					->setCellValue('AU'.$bom, 'Nominal Reff Asuransi')
					->setCellValue('AV'.$bom, 'Pelunasan')
					->setCellValue('AW'.$bom, 'Profit Unit')
					->setCellValue('AX'.$bom, 'Nomor PO')
					->setCellValue('AY'.$bom, 'Tgl Reff Profisi')
					->setCellValue('AZ'.$bom, 'Tgl Reff Bunga')
					->setCellValue('BA'.$bom, 'Tgl Reff Asuransi')
					->setCellValue('BB'.$bom, 'Tgl Pelunasan');
					
					$isi2 = $this->db->query("
										SELECT a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,a.ket as ketmob,e.d_merk as tipe,e.d_tipemobil as jenis,f.tahun,
										f.warna,f.tglmp,f.ket,f.domisili,datediff(current_date(),a.tanggalspk) as selisihbeli,f.hawal
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_penjualan e ON a.idpenjualan=e.d_idpenjualan
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										WHERE a._deleted=0
										ORDER BY c.data ASC,pembeli
											 ")->result_array();
					foreach($isi2 as $row){
					
						$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$uang1=mysql_fetch_assoc($uang);
						$dp1=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp1a=mysql_fetch_assoc($dp1);
						$dp2=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp2a=mysql_fetch_assoc($dp2);
						$dp3=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp3a=mysql_fetch_assoc($dp3);
						$dp4=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp4a=mysql_fetch_assoc($dp4);
						$dp5=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp5a=mysql_fetch_assoc($dp5);
					
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$ttd=$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"];
						
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AE'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AL'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AM'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AN'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AO'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AP'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AQ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AR'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AS'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AT'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AU'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AV'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AW'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							
						if ($row["tipebayar"] == 'Cash') 
						{
							if ($uang1["data"] != $row["hsdiscount"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,"Cash")
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,$row["hawal"])
										  ->setCellValue('V'.$rec,$row["hargajual"])
										  ->setCellValue('W'.$rec,$row["discount"])
										  ->setCellValue('X'.$rec,$row["hsdiscount"])
										  ->setCellValue('Y'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,$row["dp"])
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,$row["angsuran"])
										  ->setCellValue('AE'.$rec,$row["biayaadm"])
										  ->setCellValue('AF'.$rec,$row["asuransi"])
										  ->setCellValue('AG'.$rec,$row["biayaasuransi"])
										  ->setCellValue('AH'.$rec,$row["profisi"])
										  ->setCellValue('AI'.$rec,$row["totaldp"])
										  ->setCellValue('AJ'.$rec,$row["tandajadi"])
										  ->setCellValue('AK'.$rec,$dp1a["data"])
										  ->setCellValue('AL'.$rec,$dp2a["data"])
										  ->setCellValue('AM'.$rec,$dp3a["data"])
										  ->setCellValue('AN'.$rec,$dp4a["data"])
										  ->setCellValue('AO'.$rec,$dp5a["data"])
										  ->setCellValue('AP'.$rec,$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"])
										  ->setCellValue('AQ'.$rec,$row["hsdiscount"]-$ttd)
										  ->setCellValue('AR'.$rec,"-")
										  ->setCellValue('AS'.$rec,$row["p_profisi"])
										  ->setCellValue('AT'.$rec,$row["p_refund"]) 
										  ->setCellValue('AU'.$rec,$row["p_asuransi"])
										  ->setCellValue('AV'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AW'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
						if ($row["tipebayar"] == 'Kredit') 
						{
							if ($uang1["data"] != $row["totaldp"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,$row["hawal"])
										  ->setCellValue('V'.$rec,$row["hargajual"])
										  ->setCellValue('W'.$rec,$row["discount"])
										  ->setCellValue('X'.$rec,$row["hsdiscount"])
										  ->setCellValue('Y'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,$row["dp"])
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,$row["angsuran"])
										  ->setCellValue('AE'.$rec,$row["biayaadm"])
										  ->setCellValue('AF'.$rec,$row["asuransi"])
										  ->setCellValue('AG'.$rec,$row["biayaasuransi"])
										  ->setCellValue('AH'.$rec,$row["profisi"])
										  ->setCellValue('AI'.$rec,$row["totaldp"])
										  ->setCellValue('AJ'.$rec,$row["tandajadi"])
										  ->setCellValue('AK'.$rec,$dp1a["data"])
										  ->setCellValue('AL'.$rec,$dp2a["data"])
										  ->setCellValue('AM'.$rec,$dp3a["data"])
										  ->setCellValue('AN'.$rec,$dp4a["data"])
										  ->setCellValue('AO'.$rec,$dp5a["data"])
										  ->setCellValue('AP'.$rec,$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"])
										  ->setCellValue('AQ'.$rec,$row["hsdiscount"]-$ttd)
										  ->setCellValue('AR'.$rec,$row["hsdiscount"]-$row["totaldp"])
										  ->setCellValue('AS'.$rec,$row["p_profisi"])
										  ->setCellValue('AT'.$rec,$row["p_refund"]) 
										  ->setCellValue('AU'.$rec,$row["p_asuransi"])
										  ->setCellValue('AV'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AW'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);	 
										$rec++;
										$no++;	
										$nop++;	
							}
							else if ($uang1["data"] == $row["totaldp"] && $row["tgl_pelunasan"] == '0000-00-00' ) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")	
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,$row["hawal"])
										  ->setCellValue('V'.$rec,$row["hargajual"])
										  ->setCellValue('W'.$rec,$row["discount"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"])
										  ->setCellValue('Y'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,$row["dp"])
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,$row["angsuran"])
										  ->setCellValue('AE'.$rec,$row["biayaadm"])
										  ->setCellValue('AF'.$rec,$row["asuransi"])
										  ->setCellValue('AG'.$rec,$row["biayaasuransi"])
										  ->setCellValue('AH'.$rec,$row["profisi"])
										  ->setCellValue('AI'.$rec,$row["totaldp"])
										  ->setCellValue('AJ'.$rec,$row["tandajadi"])
										  ->setCellValue('AK'.$rec,$dp1a["data"])
										  ->setCellValue('AL'.$rec,$dp2a["data"])
										  ->setCellValue('AM'.$rec,$dp3a["data"])
										  ->setCellValue('AN'.$rec,$dp4a["data"])
										  ->setCellValue('AO'.$rec,$dp5a["data"])
										  ->setCellValue('AP'.$rec,$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"])
										  ->setCellValue('AQ'.$rec,$row["hsdiscount"]-$ttd)
										  ->setCellValue('AR'.$rec,$row["hsdiscount"]-$row["totaldp"])
										  ->setCellValue('AS'.$rec,$row["p_profisi"])
										  ->setCellValue('AT'.$rec,$row["p_refund"]) 
										  ->setCellValue('AU'.$rec,$row["p_asuransi"])
										  ->setCellValue('AV'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AW'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
											
					}
					
				$file = "Rekapan Proses All - ".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
	function get_cash(){
		if($this->session->userdata('sm_username')){
			date_default_timezone_set ("Asia/Jakarta");
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',15),array('C',15),array('D',15),array('E',15),array('F',15),array('G',15),array('H',15),
				array('I',15),array('J',15),array('K',15),array('L',15),array('M',15),array('N',15),array('O',15),array('P',15),array('Q',15),array('R',15)
				,array('S',15),array('T',15),array('U',15),array('V',15),array('W',15),array('X',15),array('Y',15),array('Z',15),array('AA',15),array('AB',15)
				,array('AC',15),array('AD',15),array('AE',15),array('AF',15),array('AG',15),array('AH',15),array('AI',15),array('AJ',15),array('AK',15),array('AL',15)
				,array('AM',15),array('AN',15),array('AO',15),array('AP',15),array('AQ',15),array('AR',15),array('AS',15),array('AT',15),array('AU',15)
				,array('AV',15),array('AW',15),array('AX',15),array('AY',15),array('AZ',15),array('BA',15),array('BB',15)));
				
					$no=1;	
					$rec=4;
					$bom=3;
					$nop=1;
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A2','Detail Semua Proses Sampai Tanggal '.date("d M Y"));
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':BC'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					
					$this->newphpexcel->setActiveSheetIndex(0)
					->setCellValue('A'.$bom, 'No')
					->setCellValue('B'.$bom, 'Cabang')
					->setCellValue('C'.$bom, 'Konsumen') 
					->setCellValue('D'.$bom, 'Leasing/Cash')
					->setCellValue('E'.$bom, 'Tgl SPK')
					->setCellValue('F'.$bom, 'Tgl PO')
					->setCellValue('G'.$bom, 'Usia SPK')
					->setCellValue('H'.$bom, 'Keterangan')
					->setCellValue('I'.$bom, 'Telepon')  
					->setCellValue('J'.$bom, 'Tipe Bayar')
					->setCellValue('K'.$bom, 'Jenis Kendaraan')
					->setCellValue('L'.$bom, 'No. Polisi')
					->setCellValue('M'.$bom, 'Jenis')
					->setCellValue('N'.$bom, 'Tipe')
					->setCellValue('O'.$bom, 'Tahun')
					->setCellValue('P'.$bom, 'Warna')
					->setCellValue('Q'.$bom, 'Tgl Mati Pajak')
					->setCellValue('R'.$bom, 'Ket')
					->setCellValue('S'.$bom, 'Domisili')
					->setCellValue('T'.$bom, 'Catatan')
					->setCellValue('U'.$bom, 'Harga Modal')
					->setCellValue('V'.$bom, 'Harga Jual')
					->setCellValue('W'.$bom, 'Discount')
					->setCellValue('W'.$bom, 'Harga Setelah Discount')
					->setCellValue('Y'.$bom, 'Selisih Jual')
					->setCellValue('Z'.$bom, 'Profit OTR')
					->setCellValue('AA'.$bom, 'Persentase')
					->setCellValue('AB'.$bom, 'DP Min')
					->setCellValue('AC'.$bom, 'Tenor')
					->setCellValue('AD'.$bom, 'Angsuran')
					->setCellValue('AE'.$bom, 'Biaya Adm')
					->setCellValue('AF'.$bom, 'Asuransi')
					->setCellValue('AG'.$bom, 'Biaya Polis Asuransi')
					->setCellValue('AH'.$bom, 'Profisi')
					->setCellValue('AI'.$bom, 'Total DP')
					->setCellValue('AJ'.$bom, 'Tanda Jadi')
					->setCellValue('AK'.$bom, 'Pelunasan 1')
					->setCellValue('AL'.$bom, 'Pelunasan 2')
					->setCellValue('AM'.$bom, 'Pelunasan 3')
					->setCellValue('AN'.$bom, 'Pelunasan 4')
					->setCellValue('AO'.$bom, 'Pelunasan 5')
					->setCellValue('AP'.$bom, 'Total Tanda Jadi')
					->setCellValue('AQ'.$bom, 'AR DP')
					->setCellValue('AR'.$bom, 'AR Leasing')
					->setCellValue('AS'.$bom, 'Nominal Reff Profisi')
					->setCellValue('AT'.$bom, 'Nominal Reff Bunga')
					->setCellValue('AU'.$bom, 'Nominal Reff Asuransi')
					->setCellValue('AV'.$bom, 'Pelunasan')
					->setCellValue('AW'.$bom, 'Profit Unit')
					->setCellValue('AX'.$bom, 'Nomor PO')
					->setCellValue('AY'.$bom, 'Tgl Reff Profisi')
					->setCellValue('AZ'.$bom, 'Tgl Reff Bunga')
					->setCellValue('BA'.$bom, 'Tgl Reff Asuransi')
					->setCellValue('BB'.$bom, 'Tgl Pelunasan');
					
					$isi2 = $this->db->query("
										SELECT a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,a.ket as ketmob,e.d_merk as tipe,e.d_tipemobil as jenis,f.tahun,
										f.warna,f.tglmp,f.ket,f.domisili,datediff(current_date(),a.tanggalspk) as selisihbeli,f.hawal
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_penjualan e ON a.idpenjualan=e.d_idpenjualan
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										WHERE a._deleted=0 AND a.tipebayar='Cash'
										ORDER BY c.data ASC,pembeli
											 ")->result_array();
					foreach($isi2 as $row){
					
						$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$uang1=mysql_fetch_assoc($uang);
						$dp1=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp1a=mysql_fetch_assoc($dp1);
						$dp2=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp2a=mysql_fetch_assoc($dp2);
						$dp3=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp3a=mysql_fetch_assoc($dp3);
						$dp4=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp4a=mysql_fetch_assoc($dp4);
						$dp5=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp5a=mysql_fetch_assoc($dp5);
					
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$ttd=$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"];
						
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AE'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AL'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AM'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AN'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AO'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AP'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AQ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AR'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AS'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AT'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AU'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AV'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AW'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							
						if ($row["tipebayar"] == 'Cash') 
						{
							if ($uang1["data"] != $row["hsdiscount"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,"Cash")
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,$row["hawal"])
										  ->setCellValue('V'.$rec,$row["hargajual"])
										  ->setCellValue('W'.$rec,$row["discount"])
										  ->setCellValue('X'.$rec,$row["hsdiscount"])
										  ->setCellValue('Y'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,$row["dp"])
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,$row["angsuran"])
										  ->setCellValue('AE'.$rec,$row["biayaadm"])
										  ->setCellValue('AF'.$rec,$row["asuransi"])
										  ->setCellValue('AG'.$rec,$row["biayaasuransi"])
										  ->setCellValue('AH'.$rec,$row["profisi"])
										  ->setCellValue('AI'.$rec,$row["totaldp"])
										  ->setCellValue('AJ'.$rec,$row["tandajadi"])
										  ->setCellValue('AK'.$rec,$dp1a["data"])
										  ->setCellValue('AL'.$rec,$dp2a["data"])
										  ->setCellValue('AM'.$rec,$dp3a["data"])
										  ->setCellValue('AN'.$rec,$dp4a["data"])
										  ->setCellValue('AO'.$rec,$dp5a["data"])
										  ->setCellValue('AP'.$rec,$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"])
										  ->setCellValue('AQ'.$rec,$row["hsdiscount"]-$ttd)
										  ->setCellValue('AR'.$rec,"-")
										  ->setCellValue('AS'.$rec,$row["p_profisi"])
										  ->setCellValue('AT'.$rec,$row["p_refund"]) 
										  ->setCellValue('AU'.$rec,$row["p_asuransi"])
										  ->setCellValue('AV'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AW'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
						if ($row["tipebayar"] == 'Kredit') 
						{
							if ($uang1["data"] != $row["totaldp"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,$row["hawal"])
										  ->setCellValue('V'.$rec,$row["hargajual"])
										  ->setCellValue('W'.$rec,$row["discount"])
										  ->setCellValue('X'.$rec,$row["hsdiscount"])
										  ->setCellValue('Y'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,$row["dp"])
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,$row["angsuran"])
										  ->setCellValue('AE'.$rec,$row["biayaadm"])
										  ->setCellValue('AF'.$rec,$row["asuransi"])
										  ->setCellValue('AG'.$rec,$row["biayaasuransi"])
										  ->setCellValue('AH'.$rec,$row["profisi"])
										  ->setCellValue('AI'.$rec,$row["totaldp"])
										  ->setCellValue('AJ'.$rec,$row["tandajadi"])
										  ->setCellValue('AK'.$rec,$dp1a["data"])
										  ->setCellValue('AL'.$rec,$dp2a["data"])
										  ->setCellValue('AM'.$rec,$dp3a["data"])
										  ->setCellValue('AN'.$rec,$dp4a["data"])
										  ->setCellValue('AO'.$rec,$dp5a["data"])
										  ->setCellValue('AP'.$rec,$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"])
										  ->setCellValue('AQ'.$rec,$row["hsdiscount"]-$ttd)
										  ->setCellValue('AR'.$rec,$row["hsdiscount"]-$row["totaldp"])
										  ->setCellValue('AS'.$rec,$row["p_profisi"])
										  ->setCellValue('AT'.$rec,$row["p_refund"]) 
										  ->setCellValue('AU'.$rec,$row["p_asuransi"])
										  ->setCellValue('AV'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AW'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);	 
										$rec++;
										$no++;	
										$nop++;	
							}
							else if ($uang1["data"] == $row["totaldp"] && $row["tgl_pelunasan"] == '0000-00-00' ) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")	
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,$row["hawal"])
										  ->setCellValue('V'.$rec,$row["hargajual"])
										  ->setCellValue('W'.$rec,$row["discount"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"])
										  ->setCellValue('Y'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Z'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,$row["dp"])
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,$row["angsuran"])
										  ->setCellValue('AE'.$rec,$row["biayaadm"])
										  ->setCellValue('AF'.$rec,$row["asuransi"])
										  ->setCellValue('AG'.$rec,$row["biayaasuransi"])
										  ->setCellValue('AH'.$rec,$row["profisi"])
										  ->setCellValue('AI'.$rec,$row["totaldp"])
										  ->setCellValue('AJ'.$rec,$row["tandajadi"])
										  ->setCellValue('AK'.$rec,$dp1a["data"])
										  ->setCellValue('AL'.$rec,$dp2a["data"])
										  ->setCellValue('AM'.$rec,$dp3a["data"])
										  ->setCellValue('AN'.$rec,$dp4a["data"])
										  ->setCellValue('AO'.$rec,$dp5a["data"])
										  ->setCellValue('AP'.$rec,$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"])
										  ->setCellValue('AQ'.$rec,$row["hsdiscount"]-$ttd)
										  ->setCellValue('AR'.$rec,$row["hsdiscount"]-$row["totaldp"])
										  ->setCellValue('AS'.$rec,$row["p_profisi"])
										  ->setCellValue('AT'.$rec,$row["p_refund"]) 
										  ->setCellValue('AU'.$rec,$row["p_asuransi"])
										  ->setCellValue('AV'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AW'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
											
					}
					
				$file = "Rekapan Proses Cash - ".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
	function get_spo(){
		if($this->session->userdata('sm_username')){
			date_default_timezone_set ("Asia/Jakarta");
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',15),array('C',15),array('D',15),array('E',15),array('F',15),array('G',15),array('H',15),
				array('I',15),array('J',15),array('K',15),array('L',15),array('M',15),array('N',15),array('O',15),array('P',15),array('Q',15),array('R',15)
				,array('S',15),array('T',15),array('U',15),array('V',15),array('W',15),array('X',15),array('Y',15),array('Z',15),array('AA',15),array('AB',15)
				,array('AC',15),array('AD',15),array('AE',15),array('AF',15),array('AG',15),array('AH',15),array('AI',15),array('AJ',15),array('AK',15),array('AL',15)
				,array('AM',15),array('AN',15),array('AO',15),array('AP',15),array('AQ',15),array('AR',15),array('AS',15),array('AT',15),array('AU',15)
				,array('AV',15),array('AW',15),array('AX',15),array('AY',15),array('AZ',15),array('BA',15),array('BB',15)));
				
					$no=1;	
					$rec=4;
					$bom=3;
					$nop=1;
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A2','Detail Semua Proses Sampai Tanggal '.date("d M Y"));
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':BC'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					
					$this->newphpexcel->setActiveSheetIndex(0)
					->setCellValue('A'.$bom, 'No')
					->setCellValue('B'.$bom, 'Cabang')
					->setCellValue('C'.$bom, 'Konsumen') 
					->setCellValue('D'.$bom, 'Leasing/Cash')
					->setCellValue('E'.$bom, 'Tgl SPK')
					->setCellValue('F'.$bom, 'Tgl PO')
					->setCellValue('G'.$bom, 'Usia SPK')
					->setCellValue('H'.$bom, 'Keterangan')
					->setCellValue('I'.$bom, 'Telepon')  
					->setCellValue('J'.$bom, 'Tipe Bayar')
					->setCellValue('K'.$bom, 'Jenis Kendaraan')
					->setCellValue('L'.$bom, 'No. Polisi')
					->setCellValue('M'.$bom, 'Jenis')
					->setCellValue('N'.$bom, 'Tipe')
					->setCellValue('O'.$bom, 'Tahun')
					->setCellValue('P'.$bom, 'Warna')
					->setCellValue('Q'.$bom, 'Tgl Mati Pajak')
					->setCellValue('R'.$bom, 'Ket')
					->setCellValue('S'.$bom, 'Domisili')
					->setCellValue('T'.$bom, 'Catatan')
					->setCellValue('U'.$bom, 'Harga Modal')
					->setCellValue('V'.$bom, 'Harga Jual')
					->setCellValue('W'.$bom, 'Discount')
					->setCellValue('W'.$bom, 'Harga Setelah Discount')
					->setCellValue('Y'.$bom, 'Selisih Jual')
					->setCellValue('Z'.$bom, 'Profit OTR')
					->setCellValue('AA'.$bom, 'Persentase')
					->setCellValue('AB'.$bom, 'DP Min')
					->setCellValue('AC'.$bom, 'Tenor')
					->setCellValue('AD'.$bom, 'Angsuran')
					->setCellValue('AE'.$bom, 'Biaya Adm')
					->setCellValue('AF'.$bom, 'Asuransi')
					->setCellValue('AG'.$bom, 'Biaya Polis Asuransi')
					->setCellValue('AH'.$bom, 'Profisi')
					->setCellValue('AI'.$bom, 'Total DP')
					->setCellValue('AJ'.$bom, 'Tanda Jadi')
					->setCellValue('AK'.$bom, 'Pelunasan 1')
					->setCellValue('AL'.$bom, 'Pelunasan 2')
					->setCellValue('AM'.$bom, 'Pelunasan 3')
					->setCellValue('AN'.$bom, 'Pelunasan 4')
					->setCellValue('AO'.$bom, 'Pelunasan 5')
					->setCellValue('AP'.$bom, 'Total Tanda Jadi')
					->setCellValue('AQ'.$bom, 'AR DP')
					->setCellValue('AR'.$bom, 'AR Leasing')
					->setCellValue('AS'.$bom, 'Nominal Reff Profisi')
					->setCellValue('AT'.$bom, 'Nominal Reff Bunga')
					->setCellValue('AU'.$bom, 'Nominal Reff Asuransi')
					->setCellValue('AV'.$bom, 'Pelunasan')
					->setCellValue('AW'.$bom, 'Profit Unit')
					->setCellValue('AX'.$bom, 'Nomor PO')
					->setCellValue('AY'.$bom, 'Tgl Reff Profisi')
					->setCellValue('AZ'.$bom, 'Tgl Reff Bunga')
					->setCellValue('BA'.$bom, 'Tgl Reff Asuransi')
					->setCellValue('BB'.$bom, 'Tgl Pelunasan');
					
					$isi2 = $this->db->query("
										SELECT a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,a.ket as ketmob,e.d_merk as tipe,e.d_tipemobil as jenis,f.tahun,
										f.warna,f.tglmp,f.ket,f.domisili,datediff(current_date(),a.tanggalspk) as selisihbeli,f.hawal
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_penjualan e ON a.idpenjualan=e.d_idpenjualan
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										WHERE a._deleted=0 AND a.tipebayar='Kredit' AND a.tglpo NOT LIKE '0000-00-00'
										ORDER BY c.data ASC,pembeli
											 ")->result_array();
					foreach($isi2 as $row){
					
						$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$uang1=mysql_fetch_assoc($uang);
						$dp1=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp1a=mysql_fetch_assoc($dp1);
						$dp2=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp2a=mysql_fetch_assoc($dp2);
						$dp3=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp3a=mysql_fetch_assoc($dp3);
						$dp4=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp4a=mysql_fetch_assoc($dp4);
						$dp5=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp5a=mysql_fetch_assoc($dp5);
					
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$ttd=$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"];
						
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AE'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AL'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AM'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AN'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AO'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AP'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AQ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AR'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AS'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AT'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AU'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AV'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AW'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							
						if ($row["tipebayar"] == 'Cash') 
						{
							if ($uang1["data"] != $row["hsdiscount"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,"Cash")
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,($row["hawal"]))
										  ->setCellValue('V'.$rec,($row["hargajual"]))
										  ->setCellValue('W'.$rec,($row["discount"]))
										  ->setCellValue('X'.$rec,($row["hsdiscount"]))
										  ->setCellValue('Y'.$rec,($row["hargajual"]-$row["hargamodal"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]-$row["hargamodal"]))
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,($row["dp"]))
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,($row["angsuran"]))
										  ->setCellValue('AE'.$rec,($row["biayaadm"]))
										  ->setCellValue('AF'.$rec,($row["asuransi"]))
										  ->setCellValue('AG'.$rec,($row["biayaasuransi"]))
										  ->setCellValue('AH'.$rec,($row["profisi"]))
										  ->setCellValue('AI'.$rec,($row["totaldp"]))
										  ->setCellValue('AJ'.$rec,($row["tandajadi"]))
										  ->setCellValue('AK'.$rec,($dp1a["data"]))
										  ->setCellValue('AL'.$rec,($dp2a["data"]))
										  ->setCellValue('AM'.$rec,($dp3a["data"]))
										  ->setCellValue('AN'.$rec,($dp4a["data"]))
										  ->setCellValue('AO'.$rec,($dp5a["data"]))
										  ->setCellValue('AP'.$rec,($row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"]))
										  ->setCellValue('AQ'.$rec,($row["hsdiscount"]-$ttd))
										  ->setCellValue('AR'.$rec,"-")
										  ->setCellValue('AS'.$rec,($row["p_profisi"]))
										  ->setCellValue('AT'.$rec,($row["p_refund"])) 
										  ->setCellValue('AU'.$rec,($row["p_asuransi"]))
										  ->setCellValue('AV'.$rec,($row["p_pelunasan"]))
										  ->setCellValue('AW'.$rec,($row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"]))
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
						if ($row["tipebayar"] == 'Kredit') 
						{
							if ($uang1["data"] != $row["totaldp"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,($row["hawal"]))
										  ->setCellValue('V'.$rec,($row["hargajual"]))
										  ->setCellValue('W'.$rec,($row["discount"]))
										  ->setCellValue('X'.$rec,($row["hsdiscount"]))
										  ->setCellValue('Y'.$rec,($row["hargajual"]-$row["hargamodal"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]-$row["hargamodal"]))
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,($row["dp"]))
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,($row["angsuran"]))
										  ->setCellValue('AE'.$rec,($row["biayaadm"]))
										  ->setCellValue('AF'.$rec,($row["asuransi"]))
										  ->setCellValue('AG'.$rec,($row["biayaasuransi"]))
										  ->setCellValue('AH'.$rec,($row["profisi"]))
										  ->setCellValue('AI'.$rec,($row["totaldp"]))
										  ->setCellValue('AJ'.$rec,($row["tandajadi"]))
										  ->setCellValue('AK'.$rec,($dp1a["data"]))
										  ->setCellValue('AL'.$rec,($dp2a["data"]))
										  ->setCellValue('AM'.$rec,($dp3a["data"]))
										  ->setCellValue('AN'.$rec,($dp4a["data"]))
										  ->setCellValue('AO'.$rec,($dp5a["data"]))
										  ->setCellValue('AP'.$rec,($row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"]))
										  ->setCellValue('AQ'.$rec,($row["hsdiscount"]-$ttd))
										  ->setCellValue('AR'.$rec,($row["hsdiscount"]-$row["totaldp"]))
										  ->setCellValue('AS'.$rec,($row["p_profisi"]))
										  ->setCellValue('AT'.$rec,($row["p_refund"])) 
										  ->setCellValue('AU'.$rec,($row["p_asuransi"]))
										  ->setCellValue('AV'.$rec,($row["p_pelunasan"]))
										  ->setCellValue('AW'.$rec,($row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"]))
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);	 
										$rec++;
										$no++;	
										$nop++;	
							}
							else if ($uang1["data"] == $row["totaldp"] && $row["tgl_pelunasan"] == '0000-00-00' ) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")	
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,($row["hawal"]))
										  ->setCellValue('V'.$rec,($row["hargajual"]))
										  ->setCellValue('W'.$rec,($row["discount"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]))
										  ->setCellValue('Y'.$rec,($row["hargajual"]-$row["hargamodal"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]-$row["hargamodal"]))
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,($row["dp"]))
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,($row["angsuran"]))
										  ->setCellValue('AE'.$rec,($row["biayaadm"]))
										  ->setCellValue('AF'.$rec,($row["asuransi"]))
										  ->setCellValue('AG'.$rec,($row["biayaasuransi"]))
										  ->setCellValue('AH'.$rec,($row["profisi"]))
										  ->setCellValue('AI'.$rec,($row["totaldp"]))
										  ->setCellValue('AJ'.$rec,($row["tandajadi"]))
										  ->setCellValue('AK'.$rec,($dp1a["data"]))
										  ->setCellValue('AL'.$rec,($dp2a["data"]))
										  ->setCellValue('AM'.$rec,($dp3a["data"]))
										  ->setCellValue('AN'.$rec,($dp4a["data"]))
										  ->setCellValue('AO'.$rec,($dp5a["data"]))
										  ->setCellValue('AP'.$rec,($row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"]))
										  ->setCellValue('AQ'.$rec,($row["hsdiscount"]-$ttd))
										  ->setCellValue('AR'.$rec,($row["hsdiscount"]-$row["totaldp"]))
										  ->setCellValue('AS'.$rec,($row["p_profisi"]))
										  ->setCellValue('AT'.$rec,($row["p_refund"])) 
										  ->setCellValue('AU'.$rec,($row["p_asuransi"]))
										  ->setCellValue('AV'.$rec,($row["p_pelunasan"]))
										  ->setCellValue('AW'.$rec,($row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"]))
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
											
					}
					
				$file = "Rekapan Proses Sudah PO - ".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
	function get_bpo(){
		if($this->session->userdata('sm_username')){
			date_default_timezone_set ("Asia/Jakarta");
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',15),array('C',15),array('D',15),array('E',15),array('F',15),array('G',15),array('H',15),
				array('I',15),array('J',15),array('K',15),array('L',15),array('M',15),array('N',15),array('O',15),array('P',15),array('Q',15),array('R',15)
				,array('S',15),array('T',15),array('U',15),array('V',15),array('W',15),array('X',15),array('Y',15),array('Z',15),array('AA',15),array('AB',15)
				,array('AC',15),array('AD',15),array('AE',15),array('AF',15),array('AG',15),array('AH',15),array('AI',15),array('AJ',15),array('AK',15),array('AL',15)
				,array('AM',15),array('AN',15),array('AO',15),array('AP',15),array('AQ',15),array('AR',15),array('AS',15),array('AT',15),array('AU',15)
				,array('AV',15),array('AW',15),array('AX',15),array('AY',15),array('AZ',15),array('BA',15),array('BB',15)));
				
					$no=1;	
					$rec=4;
					$bom=3;
					$nop=1;
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A2','Detail Semua Proses Sampai Tanggal '.date("d M Y"));
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':BC'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,
					'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom
					,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom
					,'AQ'.$bom,'AR'.$bom,'AS'.$bom,'AT'.$bom,'AU'.$bom,'AV'.$bom,'AW'.$bom,'AX'.$bom,'AY'.$bom,'AZ'.$bom,'BA'.$bom,'BB'.$bom));
					
					$this->newphpexcel->setActiveSheetIndex(0)
					->setCellValue('A'.$bom, 'No')
					->setCellValue('B'.$bom, 'Cabang')
					->setCellValue('C'.$bom, 'Konsumen') 
					->setCellValue('D'.$bom, 'Leasing/Cash')
					->setCellValue('E'.$bom, 'Tgl SPK')
					->setCellValue('F'.$bom, 'Tgl PO')
					->setCellValue('G'.$bom, 'Usia SPK')
					->setCellValue('H'.$bom, 'Keterangan')
					->setCellValue('I'.$bom, 'Telepon')  
					->setCellValue('J'.$bom, 'Tipe Bayar')
					->setCellValue('K'.$bom, 'Jenis Kendaraan')
					->setCellValue('L'.$bom, 'No. Polisi')
					->setCellValue('M'.$bom, 'Jenis')
					->setCellValue('N'.$bom, 'Tipe')
					->setCellValue('O'.$bom, 'Tahun')
					->setCellValue('P'.$bom, 'Warna')
					->setCellValue('Q'.$bom, 'Tgl Mati Pajak')
					->setCellValue('R'.$bom, 'Ket')
					->setCellValue('S'.$bom, 'Domisili')
					->setCellValue('T'.$bom, 'Catatan')
					->setCellValue('U'.$bom, 'Harga Modal')
					->setCellValue('V'.$bom, 'Harga Jual')
					->setCellValue('W'.$bom, 'Discount')
					->setCellValue('W'.$bom, 'Harga Setelah Discount')
					->setCellValue('Y'.$bom, 'Selisih Jual')
					->setCellValue('Z'.$bom, 'Profit OTR')
					->setCellValue('AA'.$bom, 'Persentase')
					->setCellValue('AB'.$bom, 'DP Min')
					->setCellValue('AC'.$bom, 'Tenor')
					->setCellValue('AD'.$bom, 'Angsuran')
					->setCellValue('AE'.$bom, 'Biaya Adm')
					->setCellValue('AF'.$bom, 'Asuransi')
					->setCellValue('AG'.$bom, 'Biaya Polis Asuransi')
					->setCellValue('AH'.$bom, 'Profisi')
					->setCellValue('AI'.$bom, 'Total DP')
					->setCellValue('AJ'.$bom, 'Tanda Jadi')
					->setCellValue('AK'.$bom, 'Pelunasan 1')
					->setCellValue('AL'.$bom, 'Pelunasan 2')
					->setCellValue('AM'.$bom, 'Pelunasan 3')
					->setCellValue('AN'.$bom, 'Pelunasan 4')
					->setCellValue('AO'.$bom, 'Pelunasan 5')
					->setCellValue('AP'.$bom, 'Total Tanda Jadi')
					->setCellValue('AQ'.$bom, 'AR DP')
					->setCellValue('AR'.$bom, 'AR Leasing')
					->setCellValue('AS'.$bom, 'Nominal Reff Profisi')
					->setCellValue('AT'.$bom, 'Nominal Reff Bunga')
					->setCellValue('AU'.$bom, 'Nominal Reff Asuransi')
					->setCellValue('AV'.$bom, 'Pelunasan')
					->setCellValue('AW'.$bom, 'Profit Unit')
					->setCellValue('AX'.$bom, 'Nomor PO')
					->setCellValue('AY'.$bom, 'Tgl Reff Profisi')
					->setCellValue('AZ'.$bom, 'Tgl Reff Bunga')
					->setCellValue('BA'.$bom, 'Tgl Reff Asuransi')
					->setCellValue('BB'.$bom, 'Tgl Pelunasan');
					
					$isi2 = $this->db->query("
										SELECT a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,a.ket as ketmob,e.d_merk as tipe,e.d_tipemobil as jenis,f.tahun,
										f.warna,f.tglmp,f.ket,f.domisili,datediff(current_date(),a.tanggalspk) as selisihbeli,f.hawal
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_penjualan e ON a.idpenjualan=e.d_idpenjualan
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										WHERE a._deleted=0 AND a.tipebayar='Kredit' AND a.tglpo='0000-00-00'
										ORDER BY c.data ASC,pembeli
											 ")->result_array();
					foreach($isi2 as $row){
					
						$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$uang1=mysql_fetch_assoc($uang);
						$dp1=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp1a=mysql_fetch_assoc($dp1);
						$dp2=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp2a=mysql_fetch_assoc($dp2);
						$dp3=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp3a=mysql_fetch_assoc($dp3);
						$dp4=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp4a=mysql_fetch_assoc($dp4);
						$dp5=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp5a=mysql_fetch_assoc($dp5);
					
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$ttd=$row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"];
						
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AE'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AL'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AM'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AN'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AO'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AP'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AQ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AR'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AS'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AT'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AU'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AV'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
							$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AW'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						if ($row["tipebayar"] == 'Cash') 
						{
							if ($uang1["data"] != $row["hsdiscount"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,"Cash")
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,($row["hawal"]))
										  ->setCellValue('V'.$rec,($row["hargajual"]))
										  ->setCellValue('W'.$rec,($row["discount"]))
										  ->setCellValue('X'.$rec,($row["hsdiscount"]))
										  ->setCellValue('Y'.$rec,($row["hargajual"]-$row["hargamodal"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]-$row["hargamodal"]))
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,($row["dp"]))
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,($row["angsuran"]))
										  ->setCellValue('AE'.$rec,($row["biayaadm"]))
										  ->setCellValue('AF'.$rec,($row["asuransi"]))
										  ->setCellValue('AG'.$rec,($row["biayaasuransi"]))
										  ->setCellValue('AH'.$rec,($row["profisi"]))
										  ->setCellValue('AI'.$rec,($row["totaldp"]))
										  ->setCellValue('AJ'.$rec,($row["tandajadi"]))
										  ->setCellValue('AK'.$rec,($dp1a["data"]))
										  ->setCellValue('AL'.$rec,($dp2a["data"]))
										  ->setCellValue('AM'.$rec,($dp3a["data"]))
										  ->setCellValue('AN'.$rec,($dp4a["data"]))
										  ->setCellValue('AO'.$rec,($dp5a["data"]))
										  ->setCellValue('AP'.$rec,($row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"]))
										  ->setCellValue('AQ'.$rec,($row["hsdiscount"]-$ttd))
										  ->setCellValue('AR'.$rec,"-")
										  ->setCellValue('AS'.$rec,($row["p_profisi"]))
										  ->setCellValue('AT'.$rec,($row["p_refund"])) 
										  ->setCellValue('AU'.$rec,($row["p_asuransi"]))
										  ->setCellValue('AV'.$rec,($row["p_pelunasan"]))
										  ->setCellValue('AW'.$rec,($row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"]))
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
						if ($row["tipebayar"] == 'Kredit') 
						{
							if ($uang1["data"] != $row["totaldp"]) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,($row["hawal"]))
										  ->setCellValue('V'.$rec,($row["hargajual"]))
										  ->setCellValue('W'.$rec,($row["discount"]))
										  ->setCellValue('X'.$rec,($row["hsdiscount"]))
										  ->setCellValue('Y'.$rec,($row["hargajual"]-$row["hargamodal"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]-$row["hargamodal"]))
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,($row["dp"]))
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,($row["angsuran"]))
										  ->setCellValue('AE'.$rec,($row["biayaadm"]))
										  ->setCellValue('AF'.$rec,($row["asuransi"]))
										  ->setCellValue('AG'.$rec,($row["biayaasuransi"]))
										  ->setCellValue('AH'.$rec,($row["profisi"]))
										  ->setCellValue('AI'.$rec,($row["totaldp"]))
										  ->setCellValue('AJ'.$rec,($row["tandajadi"]))
										  ->setCellValue('AK'.$rec,($dp1a["data"]))
										  ->setCellValue('AL'.$rec,($dp2a["data"]))
										  ->setCellValue('AM'.$rec,($dp3a["data"]))
										  ->setCellValue('AN'.$rec,($dp4a["data"]))
										  ->setCellValue('AO'.$rec,($dp5a["data"]))
										  ->setCellValue('AP'.$rec,($row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"]))
										  ->setCellValue('AQ'.$rec,($row["hsdiscount"]-$ttd))
										  ->setCellValue('AR'.$rec,($row["hsdiscount"]-$row["totaldp"]))
										  ->setCellValue('AS'.$rec,($row["p_profisi"]))
										  ->setCellValue('AT'.$rec,($row["p_refund"])) 
										  ->setCellValue('AU'.$rec,($row["p_asuransi"]))
										  ->setCellValue('AV'.$rec,($row["p_pelunasan"]))
										  ->setCellValue('AW'.$rec,($row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"]))
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);	 
										$rec++;
										$no++;	
										$nop++;	
							}
							else if ($uang1["data"] == $row["totaldp"] && $row["tgl_pelunasan"] == '0000-00-00' ) 
							{
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["kredit"])
										  ->setCellValue('E'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('F'.$rec,$tanggal_po)
										  ->setCellValue('G'.$rec,$row["selisihbeli"]." Hari")	
										  ->setCellValue('H'.$rec,$row["ketmob"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["tipebarang"])
										  ->setCellValue('L'.$rec,$row["nopol"])
										  ->setCellValue('M'.$rec,$row["tipe"])
										  ->setCellValue('N'.$rec,$row["jenis"])
										  ->setCellValue('O'.$rec,$row["tahun"])
										  ->setCellValue('P'.$rec,$row["warna"])
										  ->setCellValue('Q'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["domisili"])
										  ->setCellValue('T'.$rec,$row["catatan"])
										  ->setCellValue('U'.$rec,($row["hawal"]))
										  ->setCellValue('V'.$rec,($row["hargajual"]))
										  ->setCellValue('W'.$rec,($row["discount"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]))
										  ->setCellValue('Y'.$rec,($row["hargajual"]-$row["hargamodal"]))
										  ->setCellValue('Z'.$rec,($row["hsdiscount"]-$row["hargamodal"]))
										  ->setCellValue('AA'.$rec,ceil($a4)."%")
										  ->setCellValue('AB'.$rec,($row["dp"]))
										  ->setCellValue('AC'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('AD'.$rec,($row["angsuran"]))
										  ->setCellValue('AE'.$rec,($row["biayaadm"]))
										  ->setCellValue('AF'.$rec,($row["asuransi"]))
										  ->setCellValue('AG'.$rec,($row["biayaasuransi"]))
										  ->setCellValue('AH'.$rec,($row["profisi"]))
										  ->setCellValue('AI'.$rec,($row["totaldp"]))
										  ->setCellValue('AJ'.$rec,($row["tandajadi"]))
										  ->setCellValue('AK'.$rec,($dp1a["data"]))
										  ->setCellValue('AL'.$rec,($dp2a["data"]))
										  ->setCellValue('AM'.$rec,($dp3a["data"]))
										  ->setCellValue('AN'.$rec,($dp4a["data"]))
										  ->setCellValue('AO'.$rec,($dp5a["data"]))
										  ->setCellValue('AP'.$rec,($row["tandajadi"]+$dp1a["data"]+$dp2a["data"]+$dp3a["data"]+$dp4a["data"]+$dp5a["data"]))
										  ->setCellValue('AQ'.$rec,($row["hsdiscount"]-$ttd))
										  ->setCellValue('AR'.$rec,($row["hsdiscount"]-$row["totaldp"]))
										  ->setCellValue('AS'.$rec,($row["p_profisi"]))
										  ->setCellValue('AT'.$rec,($row["p_refund"])) 
										  ->setCellValue('AU'.$rec,($row["p_asuransi"]))
										  ->setCellValue('AV'.$rec,($row["p_pelunasan"]))
										  ->setCellValue('AW'.$rec,($row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"]))
										  ->setCellValue('AX'.$rec,$row["nopo"]) 
										  ->setCellValue('AY'.$rec,$tanggal_profisi)
										  ->setCellValue('AZ'.$rec,$tanggal_bunga)
										  ->setCellValue('BA'.$rec,$tanggal_asuransi)
										  ->setCellValue('BB'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;	
							}
						} 
											
					}
					
				$file = "Rekapan Proses Belum PO - ".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
	function get_omset(){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',15),array('C',15),array('D',15),array('E',15),array('F',15),array('G',15),array('H',15),
				array('I',15),array('J',15),array('K',15),array('L',15),array('M',15),array('N',15),array('O',15),array('P',15),array('Q',15),array('R',15)
				,array('S',15),array('T',15),array('U',15),array('V',15),array('W',15),array('X',15),array('Y',15),array('Z',15),array('AA',15),array('AB',15)
				,array('AC',15),array('AD',15),array('AE',15),array('AF',15),array('AG',15),array('AH',15),array('AI',15),array('AJ',15),array('AK',15),array('AL',15)
				,array('AM',15),array('AN',15),array('AO',15),array('AP',15)));
				
					$no=1;	
					$rec=4;
					$bom=3;
					$nop=1;
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A2','Detail Omset Dari Tanggal '.date("d M Y", strtotime($this->input->post("tglawal"))).' Sampai Tanggal '.date("d M Y", strtotime($this->input->post("tglakhir"))));
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':AP'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom,'AQ'.$bom,'AR'.$bom));
					
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom,'AQ'.$bom,'AR'.$bom));
				
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$bom, 'No')->setCellValue('B'.$bom, 'Cabang')->setCellValue('C'.$bom, 'Konsumen')->setCellValue('D'.$bom, 'Merk')->setCellValue('E'.$bom, 'Tipe')->setCellValue('F'.$bom, 'No. Polisi')->setCellValue('G'.$bom, 'Leasing/Cash')->setCellValue('H'.$bom, 'Jenis Kendaraan')->setCellValue('I'.$bom, 'Telepon')->setCellValue('J'.$bom, 'Tipe Bayar')->setCellValue('K'.$bom, 'Catatan')->setCellValue('L'.$bom, 'Harga Modal')->setCellValue('M'.$bom, 'Harga Jual')->setCellValue('N'.$bom, 'Discount')->setCellValue('O'.$bom, 'Harga Setelah Discount')->setCellValue('P'.$bom, 'Selisih Jual')->setCellValue('Q'.$bom, 'Profit OTR')->setCellValue('R'.$bom, 'Persentase')->setCellValue('S'.$bom, 'DP Min')->setCellValue('T'.$bom, 'Tenor')->setCellValue('U'.$bom, 'Angsuran')->setCellValue('V'.$bom, 'Biaya Adm')->setCellValue('W'.$bom, 'Asuransi')->setCellValue('X'.$bom, 'Biaya Polis Asuransi')->setCellValue('Y'.$bom, 'Profisi')->setCellValue('Z'.$bom, 'Total DP')->setCellValue('AA'.$bom, 'Tanda Jadi')->setCellValue('AB'.$bom, 'Pelunasan 1')->setCellValue('AC'.$bom, 'Pelunasan 2')->setCellValue('AD'.$bom, 'Pelunasan 3')->setCellValue('AE'.$bom, 'Pelunasan 4')->setCellValue('AF'.$bom, 'Pelunasan 5')->setCellValue('AG'.$bom, 'Nominal Reff Profisi')->setCellValue('AH'.$bom, 'Nominal Reff Bunga')->setCellValue('AI'.$bom, 'Nominal Reff Asuransi')->setCellValue('AJ'.$bom, 'Pelunasan')->setCellValue('AK'.$bom, 'Total Profit Unit')->setCellValue('AL'.$bom, 'Tgl PO')->setCellValue('AM'.$bom, 'Nomor PO')->setCellValue('AN'.$bom, 'Tgl SPK')->setCellValue('AO'.$bom, 'Tgl Reff Profisi')->setCellValue('AP'.$bom, 'Tgl Reff Bunga')->setCellValue('AQ'.$bom, 'Tgl Reff Asuransi')->setCellValue('AR'.$bom, 'Tgl Pelunasan');
					
					$isi2 = $this->db->query("
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
					UNION
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
					UNION
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset'
										AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
					UNION
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset'
										AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY pembeli ASC
											 ")->result_array();
					foreach($isi2 as $row){
					
					$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$uang1=mysql_fetch_assoc($uang);
					$dp1=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp1a=mysql_fetch_assoc($dp1);
					$dp2=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp2a=mysql_fetch_assoc($dp2);
					$dp3=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp3a=mysql_fetch_assoc($dp3);
					$dp4=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp4a=mysql_fetch_assoc($dp4);
					$dp5=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp5a=mysql_fetch_assoc($dp5);
					if ($row["tipebayar"] == 'Cash') {
						if ($row["hsdiscount"] == $uang1["data"]) {
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";$tipe_kredit = $row["kredit"];
						if ($row["kredit"] == "") { $tipe_kredit = "Cash";} else { $tipe_kredit = "Cash"; }
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('L'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('M'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('N'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('O'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('P'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Q'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('S'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AA'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AC'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["merk"])
										  ->setCellValue('E'.$rec,$row["tipemobil"])
										  ->setCellValue('F'.$rec,$row["nopol"])
										  ->setCellValue('G'.$rec,$tipe_kredit)
										  ->setCellValue('H'.$rec,$row["tipebarang"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["catatan"])
										  ->setCellValue('L'.$rec,$row["hargamodal"])
										  ->setCellValue('M'.$rec,$row["hargajual"])
										  ->setCellValue('N'.$rec,$row["discount"])
										  ->setCellValue('O'.$rec,$row["hsdiscount"])
										  ->setCellValue('P'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Q'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('R'.$rec,ceil($a4)."%")
										  ->setCellValue('S'.$rec,$row["dp"])
										  ->setCellValue('T'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('U'.$rec,$row["angsuran"])
										  ->setCellValue('V'.$rec,$row["biayaadm"])
										  ->setCellValue('W'.$rec,$row["asuransi"])
										  ->setCellValue('X'.$rec,$row["biayaasuransi"])
										  ->setCellValue('Y'.$rec,$row["profisi"])
										  ->setCellValue('Z'.$rec,$row["totaldp"])
										  ->setCellValue('AA'.$rec,$row["tandajadi"])
										  ->setCellValue('AB'.$rec,$dp1a["data"])
										  ->setCellValue('AC'.$rec,$dp2a["data"])
										  ->setCellValue('AD'.$rec,$dp3a["data"])
										  ->setCellValue('AE'.$rec,$dp4a["data"])
										  ->setCellValue('AF'.$rec,$dp5a["data"])
										  ->setCellValue('AG'.$rec,$row["p_profisi"])
										  ->setCellValue('AH'.$rec,$row["p_refund"]) 
										  ->setCellValue('AI'.$rec,$row["p_asuransi"])
										  ->setCellValue('AJ'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AK'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AL'.$rec,$tanggal_po)
										  ->setCellValue('AM'.$rec,$row["nopo"]) 
										  ->setCellValue('AN'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('AO'.$rec,$tanggal_profisi)
										  ->setCellValue('AP'.$rec,$tanggal_bunga)
										  ->setCellValue('AQ'.$rec,$tanggal_asuransi)
										  ->setCellValue('AR'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;		
									}
									} else if ($row["tipebayar"] == 'Kredit') {
										if ($row["totaldp"] == $uang1["data"] && $row["tgl_pelunasan"] != '0000-00-00') {		
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('L'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('M'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('N'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('O'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('P'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Q'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('S'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AA'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AC'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["cabang"])
										  ->setCellValue('C'.$rec,$row["pembeli"])
										  ->setCellValue('D'.$rec,$row["merk"])
										  ->setCellValue('E'.$rec,$row["tipemobil"])
										  ->setCellValue('F'.$rec,$row["nopol"])
										  ->setCellValue('g'.$rec,$row["kredit"])
										  ->setCellValue('H'.$rec,$row["tipebarang"])
										  ->setCellValue('I'.$rec,$row["telepon"])
										  ->setCellValue('J'.$rec,$row["tipebayar"])
										  ->setCellValue('K'.$rec,$row["catatan"])
										  ->setCellValue('L'.$rec,$row["hargamodal"])
										  ->setCellValue('M'.$rec,$row["hargajual"])
										  ->setCellValue('N'.$rec,$row["discount"])
										  ->setCellValue('O'.$rec,$row["hsdiscount"])
										  ->setCellValue('P'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Q'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('R'.$rec,ceil($a4)."%")
										  ->setCellValue('S'.$rec,$row["dp"])
										  ->setCellValue('T'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('U'.$rec,$row["angsuran"])
										  ->setCellValue('V'.$rec,$row["biayaadm"])
										  ->setCellValue('W'.$rec,$row["asuransi"])
										  ->setCellValue('X'.$rec,$row["biayaasuransi"])
										  ->setCellValue('Y'.$rec,$row["profisi"])
										  ->setCellValue('Z'.$rec,$row["totaldp"])
										  ->setCellValue('AA'.$rec,$row["tandajadi"])
										  ->setCellValue('AB'.$rec,$dp1a["data"])
										  ->setCellValue('AC'.$rec,$dp2a["data"])
										  ->setCellValue('AD'.$rec,$dp3a["data"])
										  ->setCellValue('AE'.$rec,$dp4a["data"])
										  ->setCellValue('AF'.$rec,$dp5a["data"])
										  ->setCellValue('AG'.$rec,$row["p_profisi"])
										  ->setCellValue('AH'.$rec,$row["p_refund"]) 
										  ->setCellValue('AI'.$rec,$row["p_asuransi"])
										  ->setCellValue('AJ'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AK'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AL'.$rec,$tanggal_po)
										  ->setCellValue('AM'.$rec,$row["nopo"]) 
										  ->setCellValue('AN'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('AO'.$rec,$tanggal_profisi)
										  ->setCellValue('AP'.$rec,$tanggal_bunga)
										  ->setCellValue('AQ'.$rec,$tanggal_asuransi)
										  ->setCellValue('AR'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;		
									}
								}										
					}
					
				$file = "Rekapan Omset - ".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
	
	function get_omset_cabang(){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',15),array('C',15),array('D',15),array('E',15),array('F',15),array('G',15),array('H',15),
				array('I',15),array('J',15),array('K',15),array('L',15),array('M',15),array('N',15),array('O',15),array('P',15),array('Q',15),array('R',15)
				,array('S',15),array('T',15),array('U',15),array('V',15),array('W',15),array('X',15),array('Y',15),array('Z',15),array('AA',15),array('AB',15)
				,array('AC',15),array('AD',15),array('AE',15),array('AF',15),array('AG',15),array('AH',15),array('AI',15),array('AJ',15),array('AK',15),array('AL',15)
				,array('AM',15),array('AN',15),array('AO',15),array('AP',15)));
				
					$no=1;	
					$rec=4;
					$bom=3;
					$nop=1;
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A2','Detail Omset Dari Tanggal '.date("d M Y", strtotime($this->input->post("tglawal"))).' Sampai Tanggal '.date("d M Y", strtotime($this->input->post("tglakhir"))));
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':AP'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom,'AQ'.$bom,'AR'.$bom));
					
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom,'T'.$bom,'U'.$bom,'V'.$bom,'W'.$bom,'X'.$bom,'Y'.$bom,'Z'.$bom,'AA'.$bom,'AB'.$bom,'AC'.$bom,'AD'.$bom,'AE'.$bom,'AF'.$bom,'AG'.$bom,'AH'.$bom,'AI'.$bom,'AJ'.$bom,'AK'.$bom,'AL'.$bom,'AM'.$bom,'AN'.$bom,'AO'.$bom,'AP'.$bom,'AQ'.$bom,'AR'.$bom));
				
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$bom, 'No')->setCellValue('B'.$bom, 'Konsumen')->setCellValue('C'.$bom, 'Telepon')->setCellValue('D'.$bom, 'Tipe Bayar')->setCellValue('E'.$bom, 'Jenis Kendaraan')->setCellValue('F'.$bom, 'Cabang')->setCellValue('G'.$bom, 'Merk')->setCellValue('H'.$bom, 'Tipe')->setCellValue('I'.$bom, 'No. Polisi')->setCellValue('J'.$bom, 'Leasing/Cash')->setCellValue('K'.$bom, 'Catatan')->setCellValue('L'.$bom, 'Harga Modal')->setCellValue('M'.$bom, 'Harga Jual')->setCellValue('N'.$bom, 'Discount')->setCellValue('O'.$bom, 'Harga Setelah Discount')->setCellValue('P'.$bom, 'Selisih Jual')->setCellValue('Q'.$bom, 'Profit OTR')->setCellValue('R'.$bom, 'Persentase')->setCellValue('S'.$bom, 'DP Min')->setCellValue('T'.$bom, 'Tenor')->setCellValue('U'.$bom, 'Angsuran')->setCellValue('V'.$bom, 'Biaya Adm')->setCellValue('W'.$bom, 'Asuransi')->setCellValue('X'.$bom, 'Biaya Polis Asuransi')->setCellValue('Y'.$bom, 'Profisi')->setCellValue('Z'.$bom, 'Total DP')->setCellValue('AA'.$bom, 'Tanda Jadi')->setCellValue('AB'.$bom, 'Pelunasan 1')->setCellValue('AC'.$bom, 'Pelunasan 2')->setCellValue('AD'.$bom, 'Pelunasan 3')->setCellValue('AE'.$bom, 'Pelunasan 4')->setCellValue('AF'.$bom, 'Pelunasan 5')->setCellValue('AG'.$bom, 'Nominal Reff Profisi')->setCellValue('AH'.$bom, 'Nominal Reff Bunga')->setCellValue('AI'.$bom, 'Nominal Reff Asuransi')->setCellValue('AJ'.$bom, 'Pelunasan')->setCellValue('AK'.$bom, 'Total Profit Unit')->setCellValue('AL'.$bom, 'Tgl PO')->setCellValue('AM'.$bom, 'Nomor PO')->setCellValue('AN'.$bom, 'Tgl SPK')->setCellValue('AO'.$bom, 'Tgl Reff Profisi')->setCellValue('AP'.$bom, 'Tgl Reff Bunga')->setCellValue('AQ'.$bom, 'Tgl Reff Asuransi')->setCellValue('AR'.$bom, 'Tgl Pelunasan');
					$isi2 = $this->db->query("
					
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$this->input->post("cabang")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
					UNION
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$this->input->post("cabang")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
					UNION
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$this->input->post("cabang")."'
										AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
					UNION
					SELECT DISTINCT GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.idpenjualan,a.tanggalspk,a.pembeli,a.telepon,a.tipebayar,a.tipebarang,
										a.hargamodal,a.hargajual,a.discount,a.hsdiscount,b.nopol as nopol,c.data as cabang,
										d.data as kredit,a.dp,a.jangkawaktubunga,a.angsuran,a.biayaadm,a.asuransi,
										a.biayaasuransi,a.profisi,a.totaldp,a.tandajadi,a.catatan,a.tglpo,
										a.nopo,a.p_profisi,a.tgl_profisi,a.tgl_refund,a.p_refund,a.tgl_asuransi,a.p_asuransi,
										a.tgl_pelunasan,a.p_pelunasan,f.tipemobil,g.data as merk
										FROM penjualan a INNER JOIN mobil b ON a.idpenjualan=b.idpenjualan
										INNER JOIN _cabang c ON a._cabang=c.code
										INNER JOIN _kredit d ON a._kredit=d.code
										INNER JOIN detail_tunai e ON a.idpenjualan=e.iddtunai
										INNER JOIN mobil f ON a.idpenjualan=f.idpenjualan
										INNER JOIN _jenismobil g ON g.code=f._jenismobil
										WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$this->input->post("cabang")."'
										AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
										AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY pembeli ASC
											 ")->result_array();
					foreach($isi2 as $row){
					
					$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$uang1=mysql_fetch_assoc($uang);
					$dp1=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp1a=mysql_fetch_assoc($dp1);
					$dp2=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp2a=mysql_fetch_assoc($dp2);
					$dp3=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp3a=mysql_fetch_assoc($dp3);
					$dp4=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp4a=mysql_fetch_assoc($dp4);
					$dp5=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$row["idpenjualan"]."'");$dp5a=mysql_fetch_assoc($dp5);
					if ($row["tipebayar"] == 'Cash') {
						if ($row["hsdiscount"] == $uang1["data"]) {
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";$tipe_kredit = $row["kredit"];
						if ($row["kredit"] == "") { $tipe_kredit = "Cash";} else { $tipe_kredit = "Cash"; }
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('L'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('M'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('N'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('O'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('P'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Q'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('S'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AA'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AC'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["pembeli"])
										  ->setCellValue('C'.$rec,$row["telepon"])
										  ->setCellValue('D'.$rec,$row["tipebayar"])
										  ->setCellValue('E'.$rec,$row["tipebarang"])
										  ->setCellValue('F'.$rec,$row["cabang"])
										  ->setCellValue('G'.$rec,$row["merk"])
										  ->setCellValue('H'.$rec,$row["tipemobil"])
										  ->setCellValue('I'.$rec,$row["nopol"])
										  ->setCellValue('J'.$rec,$tipe_kredit)
										  ->setCellValue('K'.$rec,$row["catatan"])
										  ->setCellValue('L'.$rec,$row["hargamodal"])
										  ->setCellValue('M'.$rec,$row["hargajual"])
										  ->setCellValue('N'.$rec,$row["discount"])
										  ->setCellValue('O'.$rec,$row["hsdiscount"])
										  ->setCellValue('P'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Q'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('R'.$rec,ceil($a4)."%")
										  ->setCellValue('S'.$rec,$row["dp"])
										  ->setCellValue('T'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('U'.$rec,$row["angsuran"])
										  ->setCellValue('V'.$rec,$row["biayaadm"])
										  ->setCellValue('W'.$rec,$row["asuransi"])
										  ->setCellValue('X'.$rec,$row["biayaasuransi"])
										  ->setCellValue('Y'.$rec,$row["profisi"])
										  ->setCellValue('Z'.$rec,$row["totaldp"])
										  ->setCellValue('AA'.$rec,$row["tandajadi"])
										  ->setCellValue('AB'.$rec,$dp1a["data"])
										  ->setCellValue('AC'.$rec,$dp2a["data"])
										  ->setCellValue('AD'.$rec,$dp3a["data"])
										  ->setCellValue('AE'.$rec,$dp4a["data"])
										  ->setCellValue('AF'.$rec,$dp5a["data"])
										  ->setCellValue('AG'.$rec,$row["p_profisi"])
										  ->setCellValue('AH'.$rec,$row["p_refund"]) 
										  ->setCellValue('AI'.$rec,$row["p_asuransi"])
										  ->setCellValue('AJ'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AK'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AL'.$rec,$tanggal_po)
										  ->setCellValue('AM'.$rec,$row["nopo"]) 
										  ->setCellValue('AN'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('AO'.$rec,$tanggal_profisi)
										  ->setCellValue('AP'.$rec,$tanggal_bunga)
										  ->setCellValue('AQ'.$rec,$tanggal_asuransi)
										  ->setCellValue('AR'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;		
									}
									} else if ($row["tipebayar"] == 'Kredit') {
										if ($row["totaldp"] == $uang1["data"]) {		
						$tanggal_po = "";$tanggal_profisi = "";$tanggal_bunga = "";$tanggal_asuransi = "";$tanggal_pelunasan = "";
						if ($row["tglpo"] == "0000-00-00") { $tanggal_po = "";} else { $tanggal_po =date("d M Y", strtotime($row["tglpo"])); }
						if ($row["tgl_profisi"] == "0000-00-00") { $tanggal_profisi = "";} else { $tanggal_profisi =date("d M Y", strtotime($row["tgl_profisi"])); }
						if ($row["tgl_refund"] == "0000-00-00") { $tanggal_bunga = "";} else { $tanggal_bunga =date("d M Y", strtotime($row["tgl_refund"])); }
						if ($row["tgl_asuransi"] == "0000-00-00") { $tanggal_asuransi = "";} else { $tanggal_asuransi =date("d M Y", strtotime($row["tgl_asuransi"])); }
						if ($row["tgl_pelunasan"] == "0000-00-00") { $tanggal_pelunasan = "";} else { $tanggal_pelunasan =date("d M Y", strtotime($row["tgl_pelunasan"])); }
						$a1=$row["hargajual"]-$row["hargamodal"];
						$a2=$a1-$row["discount"];
						$a3=$row["hargajual"]+$row["discount"];
						$a4=($a2/$a3*100); 
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('L'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('M'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('N'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('O'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('P'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Q'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('S'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('U'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('V'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('W'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('X'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Y'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('Z'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AA'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AB'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AC'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AD'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AF'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AG'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AH'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AI'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AJ'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('AK'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["pembeli"])
										  ->setCellValue('C'.$rec,$row["telepon"])
										  ->setCellValue('D'.$rec,$row["tipebayar"])
										  ->setCellValue('E'.$rec,$row["tipebarang"])
										  ->setCellValue('F'.$rec,$row["cabang"])
										  ->setCellValue('G'.$rec,$row["merk"])
										  ->setCellValue('H'.$rec,$row["tipemobil"])
										  ->setCellValue('I'.$rec,$row["nopol"])
										  ->setCellValue('J'.$rec,$row["kredit"])
										  ->setCellValue('K'.$rec,$row["catatan"])
										  ->setCellValue('L'.$rec,$row["hargamodal"])
										  ->setCellValue('M'.$rec,$row["hargajual"])
										  ->setCellValue('N'.$rec,$row["discount"])
										  ->setCellValue('O'.$rec,$row["hsdiscount"])
										  ->setCellValue('P'.$rec,$row["hargajual"]-$row["hargamodal"])
										  ->setCellValue('Q'.$rec,$row["hsdiscount"]-$row["hargamodal"])
										  ->setCellValue('R'.$rec,ceil($a4)."%")
										  ->setCellValue('S'.$rec,$row["dp"])
										  ->setCellValue('T'.$rec,$row["jangkawaktubunga"])
										  ->setCellValue('U'.$rec,$row["angsuran"])
										  ->setCellValue('V'.$rec,$row["biayaadm"])
										  ->setCellValue('W'.$rec,$row["asuransi"])
										  ->setCellValue('X'.$rec,$row["biayaasuransi"])
										  ->setCellValue('Y'.$rec,$row["profisi"])
										  ->setCellValue('Z'.$rec,$row["totaldp"])
										  ->setCellValue('AA'.$rec,$row["tandajadi"])
										  ->setCellValue('AB'.$rec,$dp1a["data"])
										  ->setCellValue('AC'.$rec,$dp2a["data"])
										  ->setCellValue('AD'.$rec,$dp3a["data"])
										  ->setCellValue('AE'.$rec,$dp4a["data"])
										  ->setCellValue('AF'.$rec,$dp5a["data"])
										  ->setCellValue('AG'.$rec,$row["p_profisi"])
										  ->setCellValue('AH'.$rec,$row["p_refund"]) 
										  ->setCellValue('AI'.$rec,$row["p_asuransi"])
										  ->setCellValue('AJ'.$rec,$row["p_pelunasan"])
										  ->setCellValue('AK'.$rec,$row["hsdiscount"]-$row["hargamodal"]+$row["p_profisi"]+$row["p_refund"]+$row["p_asuransi"])
										  ->setCellValue('AL'.$rec,$tanggal_po)
										  ->setCellValue('AM'.$rec,$row["nopo"]) 
										  ->setCellValue('AN'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('AO'.$rec,$tanggal_profisi)
										  ->setCellValue('AP'.$rec,$tanggal_bunga)
										  ->setCellValue('AQ'.$rec,$tanggal_asuransi)
										  ->setCellValue('AR'.$rec,$tanggal_pelunasan);			  
										$rec++;
										$no++;	
										$nop++;		
									}
								}										
					}
					
				$file = "Rekapan Omset - ".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
	
	function get_ho(){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',5),array('C',10),array('D',20),array('E',10),array('F',7),array('G',15),array('H',10),array('I',10),array('J',15),array('K',5),array('L',20),array('M',10),array('N',10),array('O',10),array('P',10),array('Q',10),array('R',10),array('S',20)));
				$no=1;				
				$nop=1;
				$rec = 4;
				$bom = 3;
					
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$bom.':S'.$bom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->newphpexcel->set_bold(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom));
					$this->newphpexcel->headings(array('A'.$bom,'B'.$bom,'C'.$bom,'D'.$bom,'E'.$bom,'F'.$bom,'G'.$bom,'H'.$bom,'I'.$bom,'J'.$bom,'K'.$bom,'L'.$bom,'M'.$bom,'N'.$bom,'O'.$bom,'P'.$bom,'Q'.$bom,'R'.$bom,'S'.$bom));
					$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$bom, 'No')->setCellValue('B'.$bom, 'Tgl')->setCellValue('C'.$bom, 'Jenis Mobil')->setCellValue('D'.$bom, 'Type')->setCellValue('E'.$bom, 'No. Pol')->setCellValue('F'.$bom, 'Thn')->setCellValue('G'.$bom, 'Warna')->setCellValue('H'.$bom, 'Pajak')->setCellValue('I'.$bom, 'Ket')->setCellValue('J'.$bom, 'Domisili')->setCellValue('K'.$bom, 'Tgn')->setCellValue('L'.$bom, 'Harga Modal')->setCellValue('M'.$bom, 'Wait')->setCellValue('N'.$bom, 'Bengkel')->setCellValue('O'.$bom, 'Cat & Poles')->setCellValue('P'.$bom, 'Variasi')->setCellValue('Q'.$bom, 'Salon')->setCellValue('R'.$bom, 'Ket')->setCellValue('S'.$bom, 'Perkiraan Penyelesaian');
					
					$isi2 = $this->db->query("SELECT idmobil,_jenismobil.data as jenismobil,tipemobil,nopol,tahun,warna,tglmp,keterangan,domisili,bbn,hawal,tglbeli,
											  datediff(current_date(),tglbeli) as selisih,_cabang.singkatan as cabang,status,tglspk,_cabang.data as nacab,
											  wait,bengkel,catpoles,variasi,salon,ket,perkiraan
										      FROM mobil,_jenismobil,_cabang
										      WHERE mobil._jenismobil=_jenismobil.code AND mobil._cabang=_cabang.code AND _cabang.data='HO' AND mobil.status='Tersedia'
											  ORDER BY jenismobil ASC, tipemobil
										")->result_array();
					foreach($isi2 as $row){
						$this->newphpexcel->getActiveSheet()->getStyle('M'.$rec.':Q'.$rec)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$wait='';$bengkel='';$catpoles='';$variasi='';$salon='';
						if($row["wait"] == 1) {  $wait='√'; } else { $wait=''; }
						if($row["bengkel"] == 1) {  $bengkel='√'; } else { $bengkel=''; }
						if($row["catpoles"] == 1) {  $catpoles='√'; } else { $catpoles=''; }
						if($row["variasi"] == 1) {  $variasi='√'; } else { $variasi=''; }
						if($row["salon"] == 1) {  $salon='√'; } else { $salon=''; }
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$nop)
										  ->setCellValue('B'.$rec,date("M-d", strtotime($row["tglbeli"])))
										  ->setCellValue('C'.$rec,$row["jenismobil"])
										  ->setCellValue('D'.$rec,$row["tipemobil"])
										  ->setCellValue('E'.$rec,$row["nopol"])
										  ->setCellValue('F'.$rec,$row["tahun"])
										  ->setCellValue('G'.$rec,$row["warna"])
										  ->setCellValue('H'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('I'.$rec,$row["keterangan"])
										  ->setCellValue('J'.$rec,$row["domisili"])
										  ->setCellValue('K'.$rec,$row["bbn"])
										  ->setCellValue('L'.$rec,substr($row["hawal"],0,-6)." Juta")
										  ->setCellValue('M'.$rec,$wait)
										  ->setCellValue('N'.$rec,$bengkel)
										  ->setCellValue('O'.$rec,$catpoles)
										  ->setCellValue('P'.$rec,$variasi)
										  ->setCellValue('Q'.$rec,$salon) 
										  ->setCellValue('R'.$rec,$row["ket"])
										  ->setCellValue('S'.$rec,$row["perkiraan"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec,'Q'.$rec,'R'.$rec,'S'.$rec));				  
						$rec++;
						$no++;	
						$nop++;					
					}
					
				$file = "DAFTAR_HARGA_SENTRAL_".date("YmdHis").".xls";
				header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment;filename=$file");
				header("Cache-Control: max-age=0");
				header("Pragma: no-cache");
				header("Expires: 0");
				$objWriter = PHPExcel_IOFactory::createWriter($this->newphpexcel, 'Excel5');
				$objWriter->save('php://output');
				exit();
		}
	}
}
?>