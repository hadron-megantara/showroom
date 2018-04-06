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
	<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
	if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8 || $level1['data'] == 3) { ?> 
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
			<h2><i class="fa fa-tasks"></i> Cabang</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Profit Cabang</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
			if ($level1['data'] == 1 || $level1['data'] == 6) { ?> 
		<form action="<?PHP echo base_url(); ?>laba_cabang/cetak_group" method="post" target="_blank">
			<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
			<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
			<button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Sentral Group</button>
		</form>
			<?PHP }?>
		<br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
					<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
					if ($level1['data'] == 3) 
					{ 
					$bind=mysql_query("SELECT _cabang as data from user WHERE username='".$this->session->userdata("sm_username")."'");$bind1=mysql_fetch_assoc($bind);
					?> 
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Cabang</th>
									<th>Total Harga Net</th>
									<th>Total Harga Modal</th>
									<th>Total Profit</th>
									<th>Unit Terjual</th>
									<th>Detail</th>
									<th>Print</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT *
									FROM _cabang
									WHERE _deleted=0 AND code=".$bind1['data']."");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{
										
										$otrnya="0";$xxx=0;$modalnya="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row->code."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row->code."
														AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $otr)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$otr->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($otr->tipebayar == 'Cash') 
													{
														if ($otr->hsdiscount == $uang1["data"]) 
														{
															$otrnya+=$otr->hsdiscount;
															$modalnya+=$otr->hargamodal;
															$xxx+=1;
														}	
													} 
													else if ($otr->tipebayar == 'Kredit') 
													{
														if ($otr->totaldp == $uang1["data"] && $otr->tgl_pelunasan != '0000-00-00') 
														{
															$otrnya+=$otr->hsdiscount;
															$modalnya+=$otr->hargamodal;
															$xxx+=1;
														}
													}
											}
										}

								
											$result1=mysql_query("SELECT sum(hsdiscount) as data from penjualan WHERE _cabang=".$row->code." AND _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
											$data1=mysql_fetch_assoc($result1);
											$result2=mysql_query("SELECT sum(hargamodal) as data from penjualan WHERE _cabang=".$row->code." AND _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
											$data2=mysql_fetch_assoc($result2);
											$result3=mysql_query("SELECT sum(hsdiscount-hargamodal) as data from penjualan WHERE _cabang=".$row->code." AND _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
											$data3=mysql_fetch_assoc($result3);
											$result4=mysql_query("SELECT count(*) as data from detail_penjualan,penjualan WHERE detail_penjualan.d_idpenjualan=penjualan.idpenjualan AND d_cabang=".$row->code." AND d_tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND penjualan._deleted=0");
											$data4=mysql_fetch_assoc($result4);
								?>
								<tr>
									<td><?PHP echo $row->data; ?></td>
									<td><?PHP echo number_format($otrnya) ?></td>
									<td><?PHP echo number_format($modalnya) ?></td>
									<td><?PHP echo number_format($otrnya-$modalnya) ?></td>
									<td><?PHP echo $xxx ?></td>
									<td>
										<form action="<?PHP echo base_url() ?>laba_cabang/detail" method="post">
											<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
											<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
											<input type="hidden" name="iddata" value="<?PHP echo $row->code; ?>">
											<button class=""><i class="fa fa-search"></i></button>
										</form>
									</td>
									<td>
										<form action="<?PHP echo base_url() ?>laba_cabang/cetak_cabang" method="post" target="_blank">
											<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
											<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
											<input type="hidden" name="iddata" value="<?PHP echo $row->code; ?>">
											<button class=""><i class="fa fa-print"></i></button>
										</form>
									</td>
								</tr>
								<?PHP
										}
									}
								?>
							</tbody>
						</table>
					<?PHP } else {?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Cabang</th>
									<th>Total Harga Net</th>
									<th>Total Harga Modal</th>
									<th>Total Profit</th>
									<th>Unit Terjual</th>
									<th>Detail</th>
									<th>Print</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT *
									FROM _cabang
									WHERE _deleted=0 AND code not like 1");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{
										
										$otrnya="0";$xxx=0;$modalnya="0";
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row->code."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$row->code."
														AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $otr)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$otr->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($otr->tipebayar == 'Cash') 
													{
														if ($otr->hsdiscount == $uang1["data"]) 
														{
															$otrnya+=$otr->hsdiscount;
															$modalnya+=$otr->hargamodal;
															$xxx+=1;
														}	
													} 
													else if ($otr->tipebayar == 'Kredit') 
													{
														if ($otr->totaldp == $uang1["data"] && $otr->tgl_pelunasan != '0000-00-00') 
														{
															$otrnya+=$otr->hsdiscount;
															$modalnya+=$otr->hargamodal;
															$xxx+=1;
														}
													}
											}
										}

								
											$result1=mysql_query("SELECT sum(hsdiscount) as data from penjualan WHERE _cabang=".$row->code." AND _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
											$data1=mysql_fetch_assoc($result1);
											$result2=mysql_query("SELECT sum(hargamodal) as data from penjualan WHERE _cabang=".$row->code." AND _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
											$data2=mysql_fetch_assoc($result2);
											$result3=mysql_query("SELECT sum(hsdiscount-hargamodal) as data from penjualan WHERE _cabang=".$row->code." AND _deleted=0 AND tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'");
											$data3=mysql_fetch_assoc($result3);
											$result4=mysql_query("SELECT count(*) as data from detail_penjualan,penjualan WHERE detail_penjualan.d_idpenjualan=penjualan.idpenjualan AND d_cabang=".$row->code." AND d_tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND penjualan._deleted=0");
											$data4=mysql_fetch_assoc($result4);
								?>
								<tr>
									<td><?PHP echo $row->data; ?></td>
									<td><?PHP echo number_format($otrnya) ?></td>
									<td><?PHP echo number_format($modalnya) ?></td>
									<td><?PHP echo number_format($otrnya-$modalnya) ?></td>
									<td><?PHP echo $xxx ?></td>
									<td>
										<form action="<?PHP echo base_url() ?>laba_cabang/detail" method="post">
											<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
											<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
											<input type="hidden" name="iddata" value="<?PHP echo $row->code; ?>">
											<button class=""><i class="fa fa-search"></i></button>
										</form>
									</td>
									<td>
										<form action="<?PHP echo base_url() ?>laba_cabang/cetak_cabang" method="post" target="_blank">
											<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
											<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
											<input type="hidden" name="iddata" value="<?PHP echo $row->code; ?>">
											<button class=""><i class="fa fa-print"></i></button>
										</form>
									</td>
								</tr>
								<?PHP
										}
									}
								?>
							</tbody>
						</table>
					<?PHP } ?>
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
<?PHP } else { }?>
<?PHP
	}
?>