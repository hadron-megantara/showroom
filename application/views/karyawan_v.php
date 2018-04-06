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
			<h2><i class="fa fa-users"></i> Karyawan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Karyawan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
			if ($level1['data'] == 1) { ?> 
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>karyawan/tambah_karyawan'"><i class="fa fa-plus"></i> Tambah Karyawan</button>
			<br><br>
			<?PHP } ?>
			<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
			if ($level1['data'] == 1) { ?> 
			<form action="<?PHP echo base_url() ?>karyawan/cari" method="post">
			<div class="row">
				<div class="col-sm-3">
					<label class="control-label">Cabang</label>
					<select class="form-control mb15" name="cabang" required >
						<option value="0">- Semua Cabang -</option>
						<?PHP
							$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
							foreach($query->result() as $row) :
						?>
						<option value="<?PHP echo $row->code; ?>"><?PHP echo $row->data; ?></option>
						<?PHP
							endforeach;
						?>
					</select>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<div class="input-group">
						<button class="btn btn-primary">Cari</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<?PHP } else {
				$bind=mysql_query("SELECT _cabang as data from user WHERE username='".$this->session->userdata("sm_username")."'");
				$bind1=mysql_fetch_assoc($bind);?>
			<form action="<?PHP echo base_url() ?>karyawan/cari" method="post">
			<div class="row">
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<div class="input-group">
						<button class="btn btn-primary">Cari</button>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<label class="control-label">&nbsp;</label>
					<select class="form-control hidden" name="cabang" required readonly >
						<?PHP
							$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
							foreach($query->result() as $row) :
						?>
						<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT code as data from _cabang WHERE code='".$bind1['data']."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?> ><?PHP echo $row->data; ?></option>
						<?PHP
							endforeach;
						?>
					</select>
				</div>
			</div>
			</form>
			<?PHP } ?>
		</div>
	</div>
	<?PHP } ?>
<?PHP
	}
?>