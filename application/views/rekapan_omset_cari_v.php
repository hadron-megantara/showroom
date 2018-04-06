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
	if ($level1['data'] == 1 || $level1['data'] == 6 || $level1['data'] == 3) { ?> 
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
			<h2><i class="fa fa-print"></i> Rekapan Omset</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Rekapan Omset</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 3) { 
		$bind=mysql_query("SELECT _cabang as data from user WHERE username='".$this->session->userdata("sm_username")."'");$bind1=mysql_fetch_assoc($bind);
		?> 
		<form action="<?PHP echo base_url() ?>rekapan_omset/omset_cabang" method="post" target="_blank">
			<input type="hidden" name="cabang" value="<?PHP echo $bind1['data']; ?>">
			<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
			<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
		<button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Omset</button>
		</form>
		<?PHP } else {?>
		<form action="<?PHP echo base_url() ?>rekapan_omset/omset" method="post" target="_blank">
			<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
			<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
		<button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Omset</button>
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
									<th>No</th>
									<th>Tanggal SPK</th>
									<th>No. Reg</th>
									<th>Nama Pembeli</th>
									<th>Tipe Bayar</th>
									<th>Status</th>
									<th>Harga Terjual</th>
									<th>Cabang</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$bind1['data']."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
									UNION
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$bind1['data']."'
													AND tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
									ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
												if ($row->tipebayar == 'Cash') 
												{
													if ($row->hsdiscount == $uang1["data"]) 
													{
								?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												
												<?PHP if($row->deleted == 0) { ?>
												<td><span class="label label-success">Deal</span></td>
												<?PHP } else {?>
												<td><span class="label label-danger">Reject</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a></td>
											</tr>
								<?PHP
													$i++;}	
												} 
												else if ($row->tipebayar == 'Kredit') 
												{
													if ($row->totaldp == $uang1["data"] ) 
													{
								?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												
												<?PHP if($row->deleted == 0) { ?>
												<td><span class="label label-success">Deal</span></td>
												<?PHP } else {?>
												<td><span class="label label-danger">Reject</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a></td>
											</tr>
								<?PHP
												$i++;
													}
												}
										}
									}
								?>
								
							</tbody>
						</table>
					<?PHP } else {?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal SPK</th>
									<th>No. Reg</th>
									<th>Nama Pembeli</th>
									<th>Tipe Bayar</th>
									<th>Status</th>
									<th>Harga Terjual</th>
									<th>Cabang</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
									UNION
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset'
													AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
									ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
												if ($row->tipebayar == 'Cash') 
												{
													if ($row->hsdiscount == $uang1["data"]) 
													{
								?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												
												<?PHP if($row->deleted == 0) { ?>
												<td><span class="label label-success">Deal</span></td>
												<?PHP } else {?>
												<td><span class="label label-danger">Reject</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a></td>
											</tr>
								<?PHP
													$i++;}	
												} 
												else if ($row->tipebayar == 'Kredit') 
												{
													if ($row->totaldp == $uang1["data"] && $row->tgl_pelunasan != '0000-00-00') 
													{
								?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												
												<?PHP if($row->deleted == 0) { ?>
												<td><span class="label label-success">Deal</span></td>
												<?PHP } else {?>
												<td><span class="label label-danger">Reject</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a></td>
											</tr>
								<?PHP
												$i++;
													}
												}
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
function blank_(obj){
		var url = $(obj).attr("url");
		window.open(url, '_blank');
		return false;
	}
</script>
<script type="text/javascript">
    jQuery('#table-responsive').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
</script>
	<?PHP } else { }?>
<?PHP
	}
?>