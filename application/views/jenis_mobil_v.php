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
	if ($level1['data'] == 1 || $level1['data'] == 5) { ?> 
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
			<h2><i class="fa fa-wrench"></i> Jenis Mobil</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Jenis Mobil</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<button class="btn btn-primary tambahdata" data-toggle="modal" data-target="#ModalTambah"><i class="fa fa-plus"></i> Tambah Jenis Mobil </button>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th width="15%">Kode Jenis Mobil</th>
									<th width="80%">Nama Jenis Mobil</th>
									<th width="5%">Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT *
											FROM _jenismobil
											WHERE _deleted=0 ORDER BY code ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->code; ?></td>
									<td><?PHP echo $row->data; ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>jenis_mobil/edit/<?PHP echo $row->code; ?>" class="fa fa-pencil" style="text-decoration:none;color:green"></a>
									</td>
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
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form method="post" action="<?PHP echo site_url(); ?>jenis_mobil/tambah_data">
	<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
	<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
	<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Jenis Mobil</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Kode Jenis Mobil</label>
							<input type="text" autocomplete="off" name="kodecabang" class="form-control" value="<?PHP $result=mysql_query("SELECT count(*) as data from _jenismobil");$data=mysql_fetch_assoc($result);echo $data['data']+1;?>" readonly />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Nama Jenis Mobil <font color="red">*</font></label>
							<input type="text" autocomplete="off" name="nama" class="form-control" required />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</form>
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