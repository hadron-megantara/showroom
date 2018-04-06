<?php
class Admin_M extends CI_Model
{
	function validate_login()
	{
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('_deleted',0);
		$query = $this->db->get('user');
		return $query->result();
	}
	public function validate_user()
	{
		$username = $this->input->post('username');
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		return $query->result();
	}
	public function ubahstatus_cash()
	{
		$result1=mysql_query("select d_idmobil as data FROM detail_penjualan WHERE d_idpenjualan='".$this->input->post('iddata')."'");
		$data1=mysql_fetch_assoc($result1);
		$jum_awal = $data1['data'];
		$sql = "UPDATE
				mobil
				SET status='Sold Out'
				WHERE idmobil='".$jum_awal."'";
		
		$this->db->query($sql);
	}
	function cetak_excel_all($tglawal,$tglakhir){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',20),array('C',10),array('D',10),array('E',20),array('F',30),array('G',30),array('H',30),array('I',30)));
				$this->newphpexcel->set_bold(array('A3','B3','C3','D3','E3','F3','G3','H3','I3'));
				
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3'));
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A3', 'No.')->setCellValue('B3', 'Voucher')->setCellValue('C3', 'Kode')->setCellValue('D3', 'Tanggal')->setCellValue('E3', 'Cabang')->setCellValue('F3', 'Jenis')->setCellValue('G3', 'Keterangan')->setCellValue('H3', 'Debit')->setCellValue('I3', 'Kredit');
				$isi = $this->db->query("SELECT idlr,voucher,laba_rugi._jenis,tgl,_jenis.data as jenis,keterangan,debit,kredit,_cabang.data as cabang FROM laba_rugi,_jenis,_cabang WHERE laba_rugi._jenis=_jenis.code AND laba_rugi._cabang=_cabang.code and tgl BETWEEN '".$tglawal."' AND '".$tglakhir."' ORDER BY tgl DESC")->result_array();
				$no=1;
				$rec = 4;
				$total_debit=0;
				$total_kredit=0;
					foreach($isi as $row){
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["voucher"])
										  ->setCellValue('C'.$rec,$row["_jenis"])
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl"])))
										  ->setCellValue('E'.$rec,$row["cabang"])
										  ->setCellValue('F'.$rec,$row["jenis"])
										  ->setCellValue('G'.$rec,$row["keterangan"])
										  ->setCellValue('H'.$rec,$row["debit"])
										  ->setCellValue('I'.$rec,$row["kredit"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));				  
						$rec++;
						$no++;	
						$total_debit+=$row["debit"];
						$total_kredit+=$row["kredit"];					
					}
					//Harga Setelah Discount // Tanda Jadi
					$isi = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,tanggalspk,pembeli,nopol,mobil.tipemobil,tandajadi,_cabang.data
										     FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tanggalspk DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Tanda Jadi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["tandajadi"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Tanda Jadi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["tandajadi"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["hsdiscount"];
						$total_kredit+=$row["hsdiscount"];					
					}
					//Modal Mobil
					$isi = $this->db->query("SELECT idmobil,nopol,tipemobil,hawal,tglbeli,_cabang.data
											 FROM mobil,_cabang
											 WHERE mobil._cabang=_cabang.code AND mobil._deleted=0 AND tglbeli BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tglbeli DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tglbeli"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Pembelian")
										  ->setCellValue('G'.$rec,"Modal mobil, ".$row["idmobil"].", ".$row["nopol"].", ". $row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["hawal"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tglbeli"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Modal mobil, ".$row["idmobil"].", ".$row["nopol"].", ". $row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["hawal"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						$total_debit+=$row["hawal"];
						$total_kredit+=$row["hawal"];					
					}
					//Pelunasan 1
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl2,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp2,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl2 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp2 NOT LIKE 0 ORDER BY tgl2 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl2"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 1, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp2"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl2"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 1, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp2"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp2"];
						$total_kredit+=$row["dp2"];					
					}
					//Pelunasan 2
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl3,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp3,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl3 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp3 NOT LIKE 0 ORDER BY tgl3 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl3"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 2, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp3"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl3"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 2, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp3"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp3"];
						$total_kredit+=$row["dp3"];					
					}
					//Pelunasan 3
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl4,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp4,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl4 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp4 NOT LIKE 0 ORDER BY tgl4 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl4"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 3, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp4"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl4"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 3, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp4"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp4"];
						$total_kredit+=$row["dp4"];					
					}
					//Pelunasan 4
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl5,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp5,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl5 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp5 NOT LIKE 0 ORDER BY tgl5 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl5"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 4, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp5"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl5"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 4, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp5"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp5"];
						$total_kredit+=$row["dp5"];					
					}
					//Pelunasan 5
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl6,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp6,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl6 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp6 NOT LIKE 0 ORDER BY tgl6 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl6"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 5, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp6"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl6"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 5, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp6"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp6"];
						$total_kredit+=$row["dp6"];					
					}
					//Refund Asuransi
					$isi = $this->db->query("SELECT penjualan.idpenjualan,p_asuransi,tgl_asuransi,pembeli,nopol,mobil.tipemobil,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_asuransi NOT LIKE '0000-00-00' ORDER BY tgl_asuransi DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_asuransi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Refund Asuransi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["p_asuransi"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7301")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_asuransi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Refund Asuransi")
										  ->setCellValue('G'.$rec,"Refund Asuransi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["p_asuransi"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["p_asuransi"]);
						$total_kredit+=($row["p_asuransi"]);					
					}
					//Refund Bunga
					$isi = $this->db->query("SELECT penjualan.idpenjualan,p_refund,tgl_refund,pembeli,nopol,mobil.tipemobil,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_refund NOT LIKE '0000-00-00' ORDER BY tgl_refund DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_refund"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Refund Bunga, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["p_refund"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7300")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_refund"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Refund Bunga")
										  ->setCellValue('G'.$rec,"Refund Bunga, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["p_refund"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["p_refund"]);
						$total_kredit+=($row["p_refund"]);					
					}
					//Refund Provisi
					$isi = $this->db->query("SELECT penjualan.idpenjualan,p_profisi,tgl_profisi,pembeli,nopol,mobil.tipemobil,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_profisi NOT LIKE '0000-00-00' ORDER BY tgl_profisi DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_profisi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Provisi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["p_profisi"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7302")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_profisi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Refund Provisi")
										  ->setCellValue('G'.$rec,"Provisi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["p_profisi"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["p_profisi"]);
						$total_kredit+=($row["p_profisi"]);					
					}
					//Pencairan Leasing
					$isi = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,totaldp,tgl_pelunasan,pembeli,nopol,mobil.tipemobil,tandajadi,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_pelunasan NOT LIKE '0000-00-00' ORDER BY tgl_pelunasan DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_pelunasan"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pencairan Leasing, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["hsdiscount"]-$row["totaldp"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2001")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_pelunasan"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Piutang")
										  ->setCellValue('G'.$rec,"Pencairan Leasing, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["hsdiscount"]-$row["totaldp"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["hsdiscount"]-$row["totaldp"]);
						$total_kredit+=($row["hsdiscount"]-$row["totaldp"]);					
					}
					
				$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec.':I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('H'.$rec,$total_debit)->setCellValue('I'.$rec,$total_kredit);
					
				$file = "SENTRAL_".date("YmdHis").".xls";
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
	function cetak_excel_cabang($tglawal,$tglakhir){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',20),array('C',10),array('D',10),array('E',20),array('F',30),array('G',30),array('H',30),array('I',30)));
				$this->newphpexcel->set_bold(array('A3','B3','C3','D3','E3','F3','G3','H3','I3'));
				
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3'));
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A3', 'No.')->setCellValue('B3', 'Voucher')->setCellValue('C3', 'Kode')->setCellValue('D3', 'Tanggal')->setCellValue('E3', 'Cabang')->setCellValue('F3', 'Jenis')->setCellValue('G3', 'Keterangan')->setCellValue('H3', 'Debit')->setCellValue('I3', 'Kredit');
				$isi = $this->db->query("SELECT idlr,voucher,laba_rugi._jenis,tgl,_jenis.data as jenis,keterangan,debit,kredit,_cabang.data as cabang FROM laba_rugi,_jenis,_cabang WHERE laba_rugi._jenis=_jenis.code AND laba_rugi._cabang=_cabang.code and tgl BETWEEN '".$tglawal."' AND '".$tglakhir."' AND laba_rugi._cabang='".$this->input->post('cabang')."' ORDER BY tgl DESC")->result_array();
				$no=1;
				$rec = 4;
				$total_debit=0;
				$total_kredit=0;
					foreach($isi as $row){
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$row["voucher"])
										  ->setCellValue('C'.$rec,$row["_jenis"])
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl"])))
										  ->setCellValue('E'.$rec,$row["cabang"])
										  ->setCellValue('F'.$rec,$row["jenis"])
										  ->setCellValue('G'.$rec,$row["keterangan"])
										  ->setCellValue('H'.$rec,$row["debit"])
										  ->setCellValue('I'.$rec,$row["kredit"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));				  
						$rec++;
						$no++;	
						$total_debit+=$row["debit"];
						$total_kredit+=$row["kredit"];					
					}
					// Tanda Jadi
					$isi = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,tanggalspk,pembeli,nopol,mobil.tipemobil,tandajadi,_cabang.data
										     FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tanggalspk DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Tanda Jadi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["tandajadi"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tanggalspk"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Tanda Jadi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["tandajadi"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["tandajadi"];
						$total_kredit+=$row["tandajadi"];					
					}
					//Modal Mobil
					$isi = $this->db->query("SELECT idmobil,nopol,tipemobil,hawal,tglbeli,_cabang.data
											 FROM mobil,_cabang
											 WHERE mobil._cabang='".$this->input->post('cabang')."' AND mobil._cabang=_cabang.code AND mobil._deleted=0 AND tglbeli BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tglbeli DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tglbeli"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Pembelian")
										  ->setCellValue('G'.$rec,"Modal mobil, ".$row["idmobil"].", ".$row["nopol"].", ". $row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["hawal"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tglbeli"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Modal mobil, ".$row["idmobil"].", ".$row["nopol"].", ". $row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["hawal"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						$total_debit+=$row["hawal"];
						$total_kredit+=$row["hawal"];					
					}
					//Pelunasan 1
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl2,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp2,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl2 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp2 NOT LIKE 0 ORDER BY tgl2 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl2"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 1, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp2"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl2"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 1, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp2"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp2"];
						$total_kredit+=$row["dp2"];					
					}
					//Pelunasan 2
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl3,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp3,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl3 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp3 NOT LIKE 0 ORDER BY tgl3 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl3"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 2, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp3"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl3"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 2, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp3"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp3"];
						$total_kredit+=$row["dp3"];					
					}
					//Pelunasan 3
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl4,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp4,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl4 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp4 NOT LIKE 0 ORDER BY tgl4 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl4"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 3, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp4"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl4"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 3, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp4"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp4"];
						$total_kredit+=$row["dp4"];					
					}
					//Pelunasan 4
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl5,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp5,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl5 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp5 NOT LIKE 0 ORDER BY tgl5 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl5"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 4, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp5"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl5"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 4, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp5"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp5"];
						$total_kredit+=$row["dp5"];					
					}
					//Pelunasan 5
					$isi = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl6,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp6,_cabang.data
											 FROM penjualan,mobil,detail_tunai,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl6 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp6 NOT LIKE 0 ORDER BY tgl6 DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl6"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pelunasan DP 5, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["dp6"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2002")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl6"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Cicilan DP / Tanda Jadi")
										  ->setCellValue('G'.$rec,"Pelunasan DP 5, ".$row["iddtunai"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["dp6"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=$row["dp6"];
						$total_kredit+=$row["dp6"];					
					}
					//Refund Asuransi
					$isi = $this->db->query("SELECT penjualan.idpenjualan,p_asuransi,tgl_asuransi,pembeli,nopol,mobil.tipemobil,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_asuransi NOT LIKE '0000-00-00' ORDER BY tgl_asuransi DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_asuransi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Refund Asuransi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["p_asuransi"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7301")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_asuransi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Refund Asuransi")
										  ->setCellValue('G'.$rec,"Refund Asuransi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["p_asuransi"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["p_asuransi"]);
						$total_kredit+=($row["p_asuransi"]);					
					}
					//Refund Bunga
					$isi = $this->db->query("SELECT penjualan.idpenjualan,p_refund,tgl_refund,pembeli,nopol,mobil.tipemobil,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_refund NOT LIKE '0000-00-00' ORDER BY tgl_refund DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_refund"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Refund Bunga, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["p_refund"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7300")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_refund"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Refund Bunga")
										  ->setCellValue('G'.$rec,"Refund Bunga, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["p_refund"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["p_refund"]);
						$total_kredit+=($row["p_refund"]);					
					}
					//Refund Provisi
					$isi = $this->db->query("SELECT penjualan.idpenjualan,p_profisi,tgl_profisi,pembeli,nopol,mobil.tipemobil,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_profisi NOT LIKE '0000-00-00' ORDER BY tgl_profisi DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_profisi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Provisi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["p_profisi"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"7302")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_profisi"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Refund Provisi")
										  ->setCellValue('G'.$rec,"Provisi, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["p_profisi"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["p_profisi"]);
						$total_kredit+=($row["p_profisi"]);					
					}
					//Pencairan Leasing
					$isi = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,totaldp,tgl_pelunasan,pembeli,nopol,mobil.tipemobil,tandajadi,_cabang.data
											 FROM penjualan,mobil,_cabang
											 WHERE penjualan._cabang='".$this->input->post('cabang')."' AND penjualan._cabang=_cabang.code AND penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_pelunasan NOT LIKE '0000-00-00' ORDER BY tgl_pelunasan DESC")->result_array();
					foreach($isi as $row)
					{
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"1200")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_pelunasan"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Bank")
										  ->setCellValue('G'.$rec,"Pencairan Leasing, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,$row["hsdiscount"]-$row["totaldp"])
										  ->setCellValue('I'.$rec,0);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));			  
						$rec++;
						$no++;	
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,"-")
										  ->setCellValue('C'.$rec,"2001")
										  ->setCellValue('D'.$rec,date("d M Y", strtotime($row["tgl_pelunasan"])))
										  ->setCellValue('E'.$rec,$row["data"])
										  ->setCellValue('F'.$rec,"Piutang")
										  ->setCellValue('G'.$rec,"Pencairan Leasing, ".$row["idpenjualan"].", ".$row["pembeli"].", ". $row["nopol"].", ".$row["tipemobil"])
										  ->setCellValue('H'.$rec,0)
										  ->setCellValue('I'.$rec,$row["hsdiscount"]-$row["totaldp"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec));					  
						$rec++;
						$no++;	
						
						$total_debit+=($row["hsdiscount"]-$row["totaldp"]);
						$total_kredit+=($row["hsdiscount"]-$row["totaldp"]);					
					}
				$this->newphpexcel->setActiveSheetIndex(0)->getStyle('H'.$rec.':I'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('H'.$rec, $total_debit)->setCellValue('I'.$rec, $total_kredit);
					
				$file = "SENTRAL_".date("YmdHis").".xls";
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
	function get_keseluruhan(){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',5),array('C',10),array('D',20),array('E',10),array('F',7),array('G',15),array('H',10),array('I',10),array('J',15),array('K',5),array('L',20),array('M',20),array('N',20),array('O',20),array('P',7),array('Q',7)));
				$this->newphpexcel->set_bold(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3','Q3'));
				
				$this->newphpexcel->getActiveSheet()->getStyle('A3:Q3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3','Q3'));
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A3', 'No')->setCellValue('B3', 'No')->setCellValue('C3', 'Jenis Mobil')->setCellValue('D3', 'Type')->setCellValue('E3', 'No. Pol')->setCellValue('F3', 'Thn')->setCellValue('G3', 'Warna')->setCellValue('H3', 'Pajak')->setCellValue('I3', 'Ket')->setCellValue('J3', 'Domisili')->setCellValue('K3', 'Tgn')->setCellValue('L3', 'Harga Modal')->setCellValue('M3', 'Harga Kredit')->setCellValue('N3', 'Harga Cash')->setCellValue('O3', 'Harga Jual')->setCellValue('P3', 'Lama')->setCellValue('Q3', 'Area');
				$isi = $this->db->query("SELECT idmobil,_jenismobil.data as jenismobil,tipemobil,nopol,tahun,warna,tglmp,keterangan,domisili,bbn,hawal,hkredit
												,hcash,hmax,datediff(current_date(),tglbeli) as selisih,_cabang.singkatan as cabang,status
										 FROM mobil,_jenismobil,_cabang
										 WHERE mobil._jenismobil=_jenismobil.code AND mobil._cabang=_cabang.code AND status='Tersedia' AND mobil._deleted=0
										 ORDER BY jenismobil,tipemobil ASC
										")->result_array();
				$no=1;				
				$nop=1;
				$rec = 4;
					foreach($isi as $row){
						$boms=$rec-1;
						$selisihbulan=$row["selisih"]/30;
						if($selisihbulan <= "1"){ $selisihbulan="New"; } else { $selisihbulan=ceil($selisihbulan)." Bln"; }
						
						$this->newphpexcel->setActiveSheetIndex(0)->getStyle('L'.$rec)->getNumberFormat()->setFormatCode('#,##0.00');
						$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
										  ->setCellValue('B'.$rec,$nop)
										  ->setCellValue('C'.$rec,$row["jenismobil"])
										  ->setCellValue('D'.$rec,$row["tipemobil"])
										  ->setCellValue('E'.$rec,$row["nopol"])
										  ->setCellValue('F'.$rec,$row["tahun"])
										  ->setCellValue('G'.$rec,$row["warna"])
										  ->setCellValue('H'.$rec,date("d M Y", strtotime($row["tglmp"])))
										  ->setCellValue('I'.$rec,$row["keterangan"])
										  ->setCellValue('J'.$rec,$row["domisili"])
										  ->setCellValue('K'.$rec,$row["bbn"])
										  ->setCellValue('L'.$rec,$row["hawal"])
										  ->setCellValue('M'.$rec,substr($row["hkredit"],0,-6)." Juta")
										  ->setCellValue('N'.$rec,substr($row["hcash"],0,-6)." Juta")
										  ->setCellValue('O'.$rec,substr($row["hmax"],0,-6)." Juta")
										  ->setCellValue('P'.$rec,$selisihbulan)
										  ->setCellValue('Q'.$rec,$row["cabang"]);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec,'Q'.$rec));				  
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
	function get_keseluruhan2(){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$no=1;				
				$nop=1;		
				$nops=1;
				$rec = 4;
				
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',5),array('C',10),array('D',20),array('E',10),array('F',7),array('G',15),array('H',10),array('I',10),array('J',15),array('K',5),array('L',10),array('M',10),array('N',10),array('O',10),array('P',10)));
				$this->newphpexcel->set_bold(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3'));
				
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3'));
				
				$this->newphpexcel->getActiveSheet()->getStyle('A3:P3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A3', 'No')->setCellValue('B3', 'No')->setCellValue('C3', 'Jenis Mobil')->setCellValue('D3', 'Type')->setCellValue('E3', 'No. Pol')->setCellValue('F3', 'Thn')->setCellValue('G3', 'Warna')->setCellValue('H3', 'Pajak')->setCellValue('I3', 'Ket')->setCellValue('J3', 'Domisili')->setCellValue('K3', 'Tgn')->setCellValue('L3', 'Harga Kredit')->setCellValue('M3', 'Harga Cash')->setCellValue('N3', 'Harga Jual')->setCellValue('O3', 'Ket')->setCellValue('P3', 'Tgl SPK');
				$countid=mysql_query("SELECT count(*) as data from _cabang");$countid1=mysql_fetch_assoc($countid);
				for($i=2;$i<=$countid1['data'];$i++) 
				{	
					$no=1;
					$nama_cabang=mysql_query("SELECT data as data from _cabang where code=".$i."");$nama_cabang1=mysql_fetch_assoc($nama_cabang);
					
					$this->newphpexcel->setActiveSheetIndex(0)->mergeCells('A'.$rec.':P'.$rec);
					$this->newphpexcel->getActiveSheet()->setCellValue('A'.$rec,$nama_cabang1['data']);
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$rec.':P'.$rec)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$rec+=1;
					
					$isi = $this->db->query("SELECT idmobil,_jenismobil.data as jenismobil,tipemobil,nopol,tahun,warna,tglmp,keterangan,domisili,bbn,hawal,hkredit
											 ,hcash,hmax,datediff(current_date(),tglbeli) as selisih,status,tglspk,mobil._cabang as cabang
											 FROM mobil,_jenismobil,penjualan
											 WHERE mobil._jenismobil=_jenismobil.code AND status NOT LIKE 'Sold Out' AND mobil._deleted=0 AND mobil.idpenjualan=penjualan.idpenjualan
											 AND penjualan._cabang='".$i."'	
											 ORDER BY tglspk DESC, jenismobil,tipemobil
											 ")->result_array();
											 $nop=1;
											 $nops=1;
					foreach($isi as $row)
					{	
						$boms=$rec-1;
						$selisihbulan=$row["selisih"]/30;
						$this->newphpexcel->set_bold(array('A'.$boms));
						if($row["tglspk"] == "0000-00-00"){ $tglspk=""; } else { $tglspk=date("d M Y", strtotime($row["tglspk"])); }
						if($selisihbulan <= "1"){ $selisihbulan="New"; } else { $selisihbulan=ceil($selisihbulan)." Bln"; }
						if($row["tglspk"] != "0000-00-00")
						{
							$this->newphpexcel->headings(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec));
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
											  ->setCellValue('B'.$rec,$nops)
											  ->setCellValue('C'.$rec,$row["jenismobil"])
											  ->setCellValue('D'.$rec,$row["tipemobil"])
											  ->setCellValue('E'.$rec,$row["nopol"])
											  ->setCellValue('F'.$rec,$row["tahun"])
											  ->setCellValue('G'.$rec,$row["warna"])
											  ->setCellValue('H'.$rec,date("d M Y", strtotime($row["tglmp"])))
											  ->setCellValue('I'.$rec,$row["keterangan"])
											  ->setCellValue('J'.$rec,$row["domisili"])
											  ->setCellValue('K'.$rec,$row["bbn"])
											  ->setCellValue('L'.$rec,"")
											  ->setCellValue('M'.$rec,"")
											  ->setCellValue('N'.$rec,"")
											  ->setCellValue('O'.$rec,$selisihbulan)
											  ->setCellValue('P'.$rec,$tglspk);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec));				  
						$rec++;
						$no++;
						$nops++;	
						}
					}
					$isi = $this->db->query("SELECT idmobil,_jenismobil.data as jenismobil,tipemobil,nopol,tahun,warna,tglmp,keterangan,domisili,bbn,hawal,hkredit
											 ,hcash,hmax,datediff(current_date(),tglbeli) as selisih,status,tglspk,mobil._cabang as cabang
											 FROM mobil,_jenismobil
											 WHERE mobil._jenismobil=_jenismobil.code AND status NOT LIKE 'Sold Out' AND mobil._deleted=0 AND mobil._cabang='".$i."'	
											 ORDER BY tglspk DESC, jenismobil,tipemobil
											 ")->result_array();
											 $nop=1;
											 $nops=1;
					foreach($isi as $row)
					{	
						$boms=$rec-1;
						$selisihbulan=$row["selisih"]/30;
						$this->newphpexcel->set_bold(array('A'.$boms));
						if($row["tglspk"] == "0000-00-00"){ $tglspk=""; } else { $tglspk=date("d M Y", strtotime($row["tglspk"])); }
						if($selisihbulan <= "1"){ $selisihbulan="New"; } else { $selisihbulan=ceil($selisihbulan)." Bln"; }
						if($row["tglspk"] == "0000-00-00")
						{ 
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
											  ->setCellValue('B'.$rec,$nop)
											  ->setCellValue('C'.$rec,$row["jenismobil"])
											  ->setCellValue('D'.$rec,$row["tipemobil"])
											  ->setCellValue('E'.$rec,$row["nopol"])
											  ->setCellValue('F'.$rec,$row["tahun"])
											  ->setCellValue('G'.$rec,$row["warna"])
											  ->setCellValue('H'.$rec,date("d M Y", strtotime($row["tglmp"])))
											  ->setCellValue('I'.$rec,$row["keterangan"])
											  ->setCellValue('J'.$rec,$row["domisili"])
											  ->setCellValue('K'.$rec,$row["bbn"])
											  ->setCellValue('L'.$rec,substr($row["hkredit"],0,-6)." Juta")
											  ->setCellValue('M'.$rec,substr($row["hcash"],0,-6)." Juta")
											  ->setCellValue('N'.$rec,substr($row["hmax"],0,-6)." Juta")
											  ->setCellValue('O'.$rec,$selisihbulan)
											  ->setCellValue('P'.$rec,$tglspk);
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec));				  
							$nop++;	
							$rec++;
						$no++;
						$nops++;
						}
					}
				}
				$rec+=3;
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec, 'Nama Cabang')->setCellValue('D'.$rec, 'Stock')->setCellValue('E'.$rec, 'Terjual');
				$this->newphpexcel->set_bold(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec));
				$this->newphpexcel->headings(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec));
				$rec+=1;
				
				for($i=2;$i<=$countid1['data'];$i++) 
				{
					$this->newphpexcel->setActiveSheetIndex(0)->mergeCells('A'.$rec.':C'.$rec);
					$nama_cabang=mysql_query("SELECT data as data from _cabang where code=".$i."");$nama_cabang1=mysql_fetch_assoc($nama_cabang);
					$stock=mysql_query("SELECT count(*) as data from mobil where _cabang=".$i." AND _deleted=0 AND status='Tersedia'");$stock1=mysql_fetch_assoc($stock);
					$terjual=mysql_query("SELECT count(*) as data from mobil,penjualan where mobil.idpenjualan=penjualan.idpenjualan AND penjualan._cabang=".$i." AND penjualan._deleted=0 AND mobil.status NOT LIKE 'Tersedia' AND mobil.status NOT LIKE 'Sold Out'");$terjual1=mysql_fetch_assoc($terjual);
					
					$this->newphpexcel->getActiveSheet()->setCellValue('A'.$rec,$nama_cabang1['data']);
					$this->newphpexcel->getActiveSheet()->setCellValue('D'.$rec,$stock1['data']." Unit");
					$this->newphpexcel->getActiveSheet()->setCellValue('E'.$rec,$terjual1['data']." Unit");
					
					$rec++;
				}
				$stocks=mysql_query("SELECT count(*) as data from mobil where _deleted=0 AND status='Tersedia'");$stocks1=mysql_fetch_assoc($stocks);
				$terjuals=mysql_query("SELECT count(*) as data from mobil where _deleted=0 AND status NOT LIKE 'Tersedia' AND status NOT LIKE 'Sold Out'");$terjuals1=mysql_fetch_assoc($terjuals);
					
				$this->newphpexcel->set_bold(array('D'.$rec,'E'.$rec,'F'.$rec));
				$this->newphpexcel->headings(array('D'.$rec,'E'.$rec,'F'.$rec));
				
				$this->newphpexcel->getActiveSheet()->setCellValue('D'.$rec,$stocks1['data']." Unit");
				$this->newphpexcel->getActiveSheet()->setCellValue('E'.$rec,$terjuals1['data']." Unit");
				$this->newphpexcel->getActiveSheet()->setCellValue('F'.$rec,$terjuals1['data']+$stocks1['data']." Unit");
				
				
				$file = "DAFTAR_HARGA_CABANG_".date("YmdHis").".xls";
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
	function get_keseluruhan22(){
		if($this->session->userdata('sm_username')){
			$conn = get_instance();
				$no=1;				
				$nop=1;		
				$nops=1;
				$rec = 4;
				
				$this->newphpexcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(10);
				$this->newphpexcel->setActiveSheetIndex(0);
				$this->newphpexcel->width(array(array('A',5),array('B',5),array('C',10),array('D',20),array('E',10),array('F',7),array('G',15),array('H',10),array('I',10),array('J',15),array('K',5),array('L',10),array('M',10),array('N',10),array('O',10),array('P',10)));
				$this->newphpexcel->set_bold(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3'));
				
				$this->newphpexcel->headings(array('A3','B3','C3','D3','E3','F3','G3','H3','I3','J3','K3','L3','M3','N3','O3','P3'));
				
				$this->newphpexcel->getActiveSheet()->getStyle('A3:P3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A3', 'No')->setCellValue('B3', 'No')->setCellValue('C3', 'Jenis Mobil')->setCellValue('D3', 'Type')->setCellValue('E3', 'No. Pol')->setCellValue('F3', 'Thn')->setCellValue('G3', 'Warna')->setCellValue('H3', 'Pajak')->setCellValue('I3', 'Ket')->setCellValue('J3', 'Domisili')->setCellValue('K3', 'Tgn')->setCellValue('L3', 'Harga Kredit')->setCellValue('M3', 'Harga Cash')->setCellValue('N3', 'Harga Jual')->setCellValue('O3', 'Ket')->setCellValue('P3', 'Tgl SPK');
				$countid=mysql_query("SELECT count(*) as data from _cabang");$countid1=mysql_fetch_assoc($countid);
				for($i=2;$i<=$countid1['data'];$i++) 
				{	
					$no=1;
					$nama_cabang=mysql_query("SELECT data as data from _cabang where code=".$i."");$nama_cabang1=mysql_fetch_assoc($nama_cabang);
					
					$this->newphpexcel->setActiveSheetIndex(0)->mergeCells('A'.$rec.':P'.$rec);
					$this->newphpexcel->getActiveSheet()->setCellValue('A'.$rec,$nama_cabang1['data']);
					$this->newphpexcel->getActiveSheet()->getStyle('A'.$rec.':P'.$rec)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$rec+=1;
					
					$isi = $this->db->query("SELECT idmobil,_jenismobil.data as jenismobil,tipemobil,nopol,tahun,warna,tglmp,keterangan,domisili,bbn,hawal,hkredit
											 ,hcash,hmax,datediff(current_date(),tglbeli) as selisih,status,tglspk,mobil._cabang as cabang
											 FROM mobil,_jenismobil
											 WHERE mobil._jenismobil=_jenismobil.code AND status NOT LIKE 'Sold Out' AND mobil._deleted=0 AND mobil._cabang='".$i."'	
											 ORDER BY tglspk DESC, jenismobil,tipemobil
											 ")->result_array();
											 $nop=1;
											 $nops=1;
					foreach($isi as $row)
					{	
						$boms=$rec-1;
						$selisihbulan=$row["selisih"]/30;
						$this->newphpexcel->set_bold(array('A'.$boms));
						if($row["tglspk"] == "0000-00-00"){ $tglspk=""; } else { $tglspk=date("d M Y", strtotime($row["tglspk"])); }
						if($selisihbulan <= "1"){ $selisihbulan="New"; } else { $selisihbulan=ceil($selisihbulan)." Bln"; }
						if($row["tglspk"] == "0000-00-00")
						{ 
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
											  ->setCellValue('B'.$rec,$nop)
											  ->setCellValue('C'.$rec,$row["jenismobil"])
											  ->setCellValue('D'.$rec,$row["tipemobil"])
											  ->setCellValue('E'.$rec,$row["nopol"])
											  ->setCellValue('F'.$rec,$row["tahun"])
											  ->setCellValue('G'.$rec,$row["warna"])
											  ->setCellValue('H'.$rec,date("d M Y", strtotime($row["tglmp"])))
											  ->setCellValue('I'.$rec,$row["keterangan"])
											  ->setCellValue('J'.$rec,$row["domisili"])
											  ->setCellValue('K'.$rec,$row["bbn"])
											  ->setCellValue('L'.$rec,substr($row["hkredit"],0,-6)." Juta")
											  ->setCellValue('M'.$rec,substr($row["hcash"],0,-6)." Juta")
											  ->setCellValue('N'.$rec,substr($row["hmax"],0,-6)." Juta")
											  ->setCellValue('O'.$rec,$selisihbulan)
											  ->setCellValue('P'.$rec,$tglspk);
							$nop++;	
						}
						else
						{
							$this->newphpexcel->headings(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec));
							$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec,$no)
											  ->setCellValue('B'.$rec,$nops)
											  ->setCellValue('C'.$rec,$row["jenismobil"])
											  ->setCellValue('D'.$rec,$row["tipemobil"])
											  ->setCellValue('E'.$rec,$row["nopol"])
											  ->setCellValue('F'.$rec,$row["tahun"])
											  ->setCellValue('G'.$rec,$row["warna"])
											  ->setCellValue('H'.$rec,date("d M Y", strtotime($row["tglmp"])))
											  ->setCellValue('I'.$rec,$row["keterangan"])
											  ->setCellValue('J'.$rec,$row["domisili"])
											  ->setCellValue('K'.$rec,$row["bbn"])
											  ->setCellValue('L'.$rec,"")
											  ->setCellValue('M'.$rec,"")
											  ->setCellValue('N'.$rec,"")
											  ->setCellValue('O'.$rec,$selisihbulan)
											  ->setCellValue('P'.$rec,$tglspk);
						}
						$this->newphpexcel->set_detilstyle(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec,'F'.$rec,'G'.$rec,'H'.$rec,'I'.$rec,'J'.$rec,'K'.$rec,'L'.$rec,'M'.$rec,'N'.$rec,'O'.$rec,'P'.$rec));				  
						$rec++;
						$no++;
						$nops++;	
					}
				}
				$rec+=3;
				$this->newphpexcel->setActiveSheetIndex(0)->setCellValue('A'.$rec, 'Nama Cabang')->setCellValue('D'.$rec, 'Stock')->setCellValue('E'.$rec, 'Terjual');
				$this->newphpexcel->set_bold(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec));
				$this->newphpexcel->headings(array('A'.$rec,'B'.$rec,'C'.$rec,'D'.$rec,'E'.$rec));
				$rec+=1;
				
				for($i=2;$i<=$countid1['data'];$i++) 
				{
					$this->newphpexcel->setActiveSheetIndex(0)->mergeCells('A'.$rec.':C'.$rec);
					$nama_cabang=mysql_query("SELECT data as data from _cabang where code=".$i."");$nama_cabang1=mysql_fetch_assoc($nama_cabang);
					$stock=mysql_query("SELECT count(*) as data from mobil where _cabang=".$i." AND _deleted=0 AND status='Tersedia'");$stock1=mysql_fetch_assoc($stock);
					$terjual=mysql_query("SELECT count(*) as data from mobil where _cabang=".$i." AND _deleted=0 AND status NOT LIKE 'Tersedia' AND status NOT LIKE 'Sold Out'");$terjual1=mysql_fetch_assoc($terjual);
					
					$this->newphpexcel->getActiveSheet()->setCellValue('A'.$rec,$nama_cabang1['data']);
					$this->newphpexcel->getActiveSheet()->setCellValue('D'.$rec,$stock1['data']." Unit");
					$this->newphpexcel->getActiveSheet()->setCellValue('E'.$rec,$terjual1['data']." Unit");
					
					$rec++;
				}
				$stocks=mysql_query("SELECT count(*) as data from mobil where _deleted=0 AND status='Tersedia'");$stocks1=mysql_fetch_assoc($stocks);
				$terjuals=mysql_query("SELECT count(*) as data from mobil where _deleted=0 AND status NOT LIKE 'Tersedia' AND status NOT LIKE 'Sold Out'");$terjuals1=mysql_fetch_assoc($terjuals);
					
				$this->newphpexcel->set_bold(array('D'.$rec,'E'.$rec,'F'.$rec));
				$this->newphpexcel->headings(array('D'.$rec,'E'.$rec,'F'.$rec));
				
				$this->newphpexcel->getActiveSheet()->setCellValue('D'.$rec,$stocks1['data']." Unit");
				$this->newphpexcel->getActiveSheet()->setCellValue('E'.$rec,$terjuals1['data']." Unit");
				$this->newphpexcel->getActiveSheet()->setCellValue('F'.$rec,$terjuals1['data']+$stocks1['data']." Unit");
				
				
				$file = "DAFTAR_HARGA_CABANG_".date("YmdHis").".xls";
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