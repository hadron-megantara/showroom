<?PHP
	if($this->session->userdata("sm_username") == "")
	{
?>
	<?PHP
		$this->load->view('notice_v');
	?>
<?PHP
	}
	else
	{
?>
	<?PHP
		$this->load->view('header_v');
	?>
	<link href="<?PHP echo base_url() ?>assets/css/jquery.datatables.css" rel="stylesheet">
	<script src="<?PHP echo base_url() ?>assets/js/jquery.datatables.min.js"></script>
	
	<div class="mainpanel">
		<div class="headerbar">
		  <a class="menutoggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="pageheader">
			<h2><i class="fa fa-print"></i> Report Omset</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Report Omset</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
					<?PHP 
						$JabatanUser = "";$CabangUser = "";
						$level=mysql_query("SELECT * from user WHERE username='".$this->session->userdata("sm_username")."'");
						$level1=mysql_fetch_assoc($level);
						$JabatanUser = $level1['_jabatan'];
						$CabangUser = $level1['_cabang'];
					?> 
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Nama Cabang</th>
									<th>Target</th>
									<th>Omset</th>
									<th>Proses</th>
									<th>Total</th>
									<th>% Omset</th>
									<th>% Total</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=0;$targets=0;$target_omset=0;$target_proses=0;$totalnya=0;
									$query = "";
									if($JabatanUser == "3"){
										$query = $this->db->query("SELECT * FROM _cabang WHERE code = ".$CabangUser." _deleted=0 AND code not like 1 ORDER BY data ASC");
									}else{
										$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 AND code not like 1 ORDER BY data ASC");
									}
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
										
									$t_omset=0;
									$query = $this->db->query("
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND _cabang='".$row->code."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>+tgl_pelunasan
									UNION
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND _cabang='".$row->code."'
													AND tgl_pelunasan LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
									ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $rows)
										{	
											$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$rows->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
												if ($rows->tipebayar == 'Cash') 
												{
													if ($rows->hsdiscount == $uang1["data"]) 
													{ $t_omset+=1; }	
												} 
												else if ($rows->tipebayar == 'Kredit') 
												{
													if ($rows->totaldp == $uang1["data"] && $rows->tgl_pelunasan != '0000-00-00') 
													{ $t_omset+=1; }
												}
										}
									}
									
									$j_proses=0;
									$query = $this->db->query("SELECT idpenjualan,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,totaldp,a.ket,a.tglpo,statjual,tgl_pelunasan
									FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
									WHERE a._deleted=0 AND _cabang='".$row->code."' 
									AND tanggalspk BETWEEN '2000-01-01' AND '".date('Y-m-t',strtotime($this->input->post("bulan").'/1/'.$this->input->post("tahun")))."' 
									ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $rowq)
										{	
											$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$rowq->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
											if ($rowq->tipebayar == 'Cash') 
											{
												if ($uang1["data"] != $rowq->hsdiscount) 
												{
													$j_proses++;
												} 
											} 
											if ($rowq->tipebayar == 'Kredit') 
											{
												if ($uang1["data"] != $rowq->totaldp) 
												{
													$j_proses++;
												} 
												else if ($uang1["data"] == $rowq->totaldp && $rowq->tgl_pelunasan == '0000-00-00') 
												{
													$j_proses++;
												}
											}	
										}
									}
									
									
								?>
								
								<?PHP $target=1;
								$data=mysql_query("SELECT target_omset as data from _target WHERE _cabang='".$row->code."' AND tgl='".$this->input->post("tahun")."-".$this->input->post("bulan")."-01'");
								$data1=mysql_fetch_assoc($data);
								$satu=$data1["data"];
								if($data1["data"] == ''){ }else{ $target=$data1["data"]; }; ?>
								<tr>
									<td><?PHP echo $row->data; ?></td>
									<td><?PHP echo $target; ?></td>
									<td><?PHP echo $dua=$t_omset; ?></td>
									<td><?PHP echo $satu=$j_proses; ?></td>
									<td><?PHP echo $hasil=$satu+$dua; ?></td>
									<td><?PHP echo ceil($dua/$target*100); ?>%</td>
									<td><?PHP $h1=$target+$hasil;$h2=$h1/$target;$h3=$h2-1;$h4=$h3*100;echo ceil($h4); ?>%</td>
								</tr>
								<?PHP
									$i++; $targets+=$target; $target_omset+=$t_omset; $target_proses+=$j_proses; $totalnya+=$hasil;
									
								
								
								
								
								
										}
									}
								?>
							</tbody>
							<tfoot>
								<th><?PHP echo $i; ?> Cabang</th>
								<th><?PHP echo $targets; ?></th>
								<th><?PHP echo $target_omset; ?></th>
								<th><?PHP echo $target_proses; ?></th>
								<th><?PHP echo $totalnya; ?></th>
								<th><?PHP echo ceil($target_omset/$targets*100); ?>%</th>
								<th><?PHP echo ceil($totalnya/$targets*100); ?>%</th>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
    jQuery('#table-responsive').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
</script>
<?PHP
	}
?>