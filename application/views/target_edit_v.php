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
	<link rel="stylesheet" href="<?PHP echo base_url() ?>assets/css/bootstrap-timepicker.min.css" />
	<script src="<?PHP echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
	<script src="<?PHP echo base_url() ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?PHP echo base_url() ?>assets/js/bootstrap-timepicker.min.js"></script>
	<script src="<?PHP echo base_url() ?>assets/js/jquery-ui-1.10.3.min.js"></script>
	
	<div class="mainpanel">
		<div class="headerbar">
		  <a class="menutoggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="pageheader">
			<h2><i class="fa fa-wrench"></i> Target</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>target">Target</a></li>
					<li class="active">Edit Target</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon edit target dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>target/edit_data" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata; ?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang</label>
								<input type="text" autocomplete="off"  class="form-control" value="<?PHP $result=mysql_query("SELECT _cabang.data as data from _target,_cabang WHERE _target._cabang=_cabang.code AND _target.code='".$iddata."'");$data=mysql_fetch_assoc($result); echo $data['data']; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" autocomplete="off"  class="form-control" value="<?PHP $result=mysql_query("SELECT tgl as data from _target WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result); echo date("M Y", strtotime($data['data'])); ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Target SPK <font color="red">*</font></label>
								<input type="number" autocomplete="off" name="po" class="form-control" required value="<?PHP $result=mysql_query("SELECT target_po as data from _target WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Target Omset <font color="red">*</font></label>
								<input type="number" autocomplete="off" name="omset" class="form-control" required value="<?PHP $result=mysql_query("SELECT target_omset as data from _target WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
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
				<div class="panel-heading">
				<h4 class="panel-title">Anda yakin ingin menghapus target</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>target/hapus_data" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata; ?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang</label>
								<input type="text" autocomplete="off"  class="form-control" value="<?PHP $result=mysql_query("SELECT _cabang.data as data from _target,_cabang WHERE _target._cabang=_cabang.code AND _target.code='".$iddata."'");$data=mysql_fetch_assoc($result); echo $data['data']; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" autocomplete="off"  class="form-control" value="<?PHP $result=mysql_query("SELECT tgl as data from _target WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result); echo date("M Y", strtotime($data['data'])); ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Target SPK</label>
								<input readonly type="number" autocomplete="off" name="po" class="form-control" required value="<?PHP $result=mysql_query("SELECT target_po as data from _target WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Target Omset</label>
								<input readonly type="number" autocomplete="off" name="omset" class="form-control" required value="<?PHP $result=mysql_query("SELECT target_omset as data from _target WHERE code='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
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
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>