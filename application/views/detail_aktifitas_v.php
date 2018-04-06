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
			<h2><i class="fa fa-hdd-o"></i> Detail Aktifitas</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Aktifitas</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Username</th>
									<th>Aktifitas</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT user.nama as nama,aktifitas,tanggal,jam,tipe 
									FROM log_user,user 
									WHERE log_user.username=user.username ORDER BY id DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->tanggal; ?></td>
									<td><?PHP echo $row->jam; ?></td>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo $row->aktifitas; ?></td>
									<?PHP if($row->tipe == '0') { ?>
									<td><span class="label label-primary">Tambah</span></td>
									<?PHP } else if($row->tipe == '1') { ?>
									<td><span class="label label-warning">Edit</span></td>
									<?PHP } else { ?>
									<td><span class="label label-danger">Hapus</span></td>
									<?PHP } ?>
								</tr>
								<?PHP
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
<?PHP
	}
?>