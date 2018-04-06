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
	if ($level1['data'] == 1) { ?> 
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
			<h2><i class="fa fa-book"></i> Peminjaman</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Peminjaman</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>peminjaman/tambah_peminjaman'"><i class="fa fa-plus"></i> Tambah Peminjaman</button>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
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
									WHERE detail_peminjaman._idkaryawan=karyawan.idkaryawan AND detail_peminjaman._deleted=0");
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
									<td><?PHP echo $row->jatuhtempo; ?> | <?PHP echo $row->selisih; ?> Hari</td>
									<td>
										<input type="hidden" value="<?PHP echo $row->idpeminjaman; ?>" id="id_<?PHP echo $row->idpeminjaman; ?>" />
										<a href="<?PHP echo base_url() ?>peminjaman/detail/<?PHP echo $row->idpeminjaman; ?>" ><i class="fa fa-search"></i></a> &nbsp;
										<a href="<?PHP echo base_url() ?>peminjaman/bayar/<?PHP echo $row->idpeminjaman; ?>" style="color:green" ><i class="fa fa-dollar"></i></a> &nbsp;
										<a href="<?PHP echo base_url() ?>peminjaman/edit/<?PHP echo $row->idpeminjaman; ?>" style="color:blue"><i class="fa fa-pencil"></i></a>
									</td>
								</tr>
								<?PHP
										}
										}
									}
								?>
							</tbody>
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
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>