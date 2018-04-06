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
			<h2><i class="fa fa-truck"></i> Stok HO</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>stok_ho">Stok HO</a></li>
					<li class="active">Edit Stok HO</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon edit data mobil dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>stok_ho/edit_data" method="post" name="formsentral">
				<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Mobil</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP echo $iddata; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Wait </label>
								<select class="form-control mb15" name="wait" required >
									<option value="0" <?php $result=mysql_query("SELECT wait as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 0){echo 'selected="selected"'; }?>> </option>
									<option value="1" <?php $result=mysql_query("SELECT wait as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 1){echo 'selected="selected"'; }?>>&#10003;</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Bengkel </label>
								<select class="form-control mb15" name="bengkel" required >
									<option value="0" <?php $result=mysql_query("SELECT bengkel as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 0){echo 'selected="selected"'; }?>> </option>
									<option value="1" <?php $result=mysql_query("SELECT bengkel as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 1){echo 'selected="selected"'; }?>>&#10003;</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cat & Poles </label>
								<select class="form-control mb15" name="catpoles" required >
									<option value="0" <?php $result=mysql_query("SELECT catpoles as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 0){echo 'selected="selected"'; }?>> </option>
									<option value="1" <?php $result=mysql_query("SELECT catpoles as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 1){echo 'selected="selected"'; }?>>&#10003;</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Variasi </label>
								<select class="form-control mb15" name="variasi" required >
									<option value="0" <?php $result=mysql_query("SELECT variasi as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 0){echo 'selected="selected"'; }?>> </option>
									<option value="1" <?php $result=mysql_query("SELECT variasi as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 1){echo 'selected="selected"'; }?>>&#10003;</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Salon </label>
								<select class="form-control mb15" name="salon" required >
									<option value="0" <?php $result=mysql_query("SELECT salon as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 0){echo 'selected="selected"'; }?>> </option>
									<option value="1" <?php $result=mysql_query("SELECT salon as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 1){echo 'selected="selected"'; }?>>&#10003;</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan </label>
								<input type="text" autocomplete="off" name="ket" class="form-control" value="<?PHP $result=mysql_query("SELECT ket as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Perkiraan </label>
								<input type="text" autocomplete="off" name="perkiraan" class="form-control" value="<?PHP $result=mysql_query("SELECT perkiraan as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
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
		</div>
	</div>
<?PHP } else { }?>
<?PHP
	}
?>