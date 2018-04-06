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
			<h2><i class="fa fa-wrench"></i> Cabang</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>cabang">Cabang</a></li>
					<li class="active">Manipulasi Cabang</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon edit nama cabang dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>cabang/edit_data" method="post" name="formsentral">
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Kode Cabang</label>
								<input type="text" autocomplete="off" name="code" class="form-control" value="<?PHP echo $iddata; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nama Cabang</label>
								<input type="text" autocomplete="off" name="data" class="form-control" value="<?PHP $result=mysql_query("SELECT data as data from _cabang WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Singkatan Cabang</label>
								<input type="text" autocomplete="off" name="singkatan" class="form-control" value="<?PHP $result=mysql_query("SELECT singkatan as data from _cabang WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-9">
							<button class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
				</form>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Telepon</th>
									<th>Gender</th>
									<th>Jabatan</th>
									<th>Cabang</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idkaryawan,nama,telp,gender,jabatan,_cabang.data as cabang
									FROM karyawan,_cabang
									WHERE karyawan._cabang=_cabang.code AND karyawan._deleted=0 AND karyawan._cabang='".$iddata."'");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo $row->telp; ?></td>
									<td><?PHP echo $row->gender; ?></td>
									<td><?PHP echo $row->jabatan; ?></td>
									<td><?PHP echo $row->cabang; ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>karyawan/detail/<?PHP echo $row->idkaryawan; ?>"><i class="fa fa-search"></i></a> &nbsp;
										<a href="<?PHP echo base_url() ?>karyawan/edit/<?PHP echo $row->idkaryawan; ?>"><i class="fa fa-pencil"></i></a>
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
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Anda yakin ingin menghapus cabang</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>cabang/delete_data" method="post" name="formsentral">
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Kode Cabang</label>
								<input type="text" autocomplete="off" name="code" class="form-control" value="<?PHP echo $iddata; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nama Cabang</label>
								<input type="text" autocomplete="off" name="data" class="form-control" value="<?PHP $result=mysql_query("SELECT data as data from _cabang WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Singkatan Cabang</label>
								<input type="text" autocomplete="off" name="singkatan" class="form-control" value="<?PHP $result=mysql_query("SELECT singkatan as data from _cabang WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-9">
							<button class="btn btn-danger">Submit</button>
						</div>
					</div>
				</div>
				</form>
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