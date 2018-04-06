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
	if ($level1['data'] == 1 || $level1['data'] == 3) { ?> 
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
			<h2><i class="fa fa-hdd-o"></i> Detail Peminjaman</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Peminjaman</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
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
									<th>Nama Karyawan</th>
									<th>Jumlah</th>
									<th>Dibayar</th>
									<th>Jatuh Tempo</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idpeminjaman,karyawan.nama as nama,jumlah,dibayar,jatuhtempo,
									datediff(jatuhtempo,current_date()) as selisih
									FROM detail_peminjaman,karyawan
									WHERE detail_peminjaman._idkaryawan=karyawan.idkaryawan AND detail_peminjaman._deleted=0 AND karyawan._cabang=".$bind1['data']." ORDER BY idpeminjaman DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											if($row->jumlah == $row->dibayar){ } else {
								?>
								<tr>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo number_format($row->jumlah); ?></td>
									<td><?PHP echo number_format($row->dibayar); ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->jatuhtempo)); ?> | <?PHP echo $row->selisih; ?> Hari</td>
									<td>
										<input type="hidden" value="<?PHP echo $row->idpeminjaman; ?>" id="id_<?PHP echo $row->idpeminjaman; ?>" />
										<a href="<?PHP echo base_url() ?>peminjaman/detail/<?PHP echo $row->idpeminjaman; ?>" ><i class="fa fa-search"></i></a> &nbsp;
									</td>
								</tr>
								<?PHP
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
									<th>Nama Karyawan</th>
									<th>Jumlah</th>
									<th>Dibayar</th>
									<th>Jatuh Tempo</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idpeminjaman,karyawan.nama as nama,jumlah,dibayar,jatuhtempo,datediff(jatuhtempo,current_date()) as selisih
									FROM detail_peminjaman,karyawan
									WHERE detail_peminjaman._idkaryawan=karyawan.idkaryawan AND detail_peminjaman._deleted=0 ORDER BY idpeminjaman DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											if($row->jumlah == $row->dibayar){ } else {
								?>
								<tr>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo number_format($row->jumlah); ?></td>
									<td><?PHP echo number_format($row->dibayar); ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->jatuhtempo)); ?> | <?PHP echo $row->selisih; ?> Hari</td>
									<td>
										<input type="hidden" value="<?PHP echo $row->idpeminjaman; ?>" id="id_<?PHP echo $row->idpeminjaman; ?>" />
										<a href="<?PHP echo base_url() ?>peminjaman/detail/<?PHP echo $row->idpeminjaman; ?>" ><i class="fa fa-search"></i></a> &nbsp;
									</td>
								</tr>
								<?PHP
										}
										}
									}
								?>
							</tbody>
						</table>
					<?PHP }?>
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
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>