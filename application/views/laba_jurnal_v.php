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
			<h2><i class="fa fa-tasks"></i> Jurnal</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Jurnal</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
			if ($level1['data'] == 1) { ?> 
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>laba_jurnal/tambah_jurnal'"><i class="fa fa-plus"></i> Tambah Jurnal</button>
			<br><br>
			<?PHP } else if ($level1['data'] == 2) {?>
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>laba_jurnal/tambah_jurnal'"><i class="fa fa-plus"></i> Tambah Jurnal</button>
			<br><br>
			<?PHP } else {?>
			<?PHP }?>
			<form action="<?PHP echo base_url() ?>laba_jurnal/cari" method="post">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Tanggal Awal</label>
						<div class="input-group">
							<input type="text" class="form-control" name="tglawal" id="tglawal" readonly value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>" >
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">Tanggal Akhir</label>
						<div class="input-group">
							<input type="text" class="form-control" name="tglakhir" id="tglakhir" readonly value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>" >
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>
				</div>
				
				<?PHP 
				$bind=mysql_query("SELECT _cabang as data from user WHERE username='".$this->session->userdata("sm_username")."'");
				$bind1=mysql_fetch_assoc($bind);
				$level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8) 
				{ 
				?> 
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
				<div class="col-sm-3">
					<div class="form-group">
						<label class="control-label">&nbsp;</label>
						<div class="input-group">
						<button class="btn btn-primary">Cari</button>
						</div>
					</div>
				</div>
				<?PHP } else {?>
				<div class="col-sm-3">
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
				<?PHP }?>
				
			</div>
			</form>
		</div>
	</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#tglawal').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	  jQuery('#tglakhir').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
 });
</script>
<?PHP } else { }?>
<?PHP
	}
?>