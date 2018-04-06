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
			<h2><i class="fa fa-print"></i> Detail SPK</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail SPK</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<form action="<?PHP echo base_url() ?>rekapan_spk/cari" method="post">
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label">Tanggal Awal</label>
						<div class="input-group">
							<input type="text" class="form-control" name="tglawal" id="tglawal" readonly value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>" >
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label">Tanggal Akhir</label>
						<div class="input-group">
							<input type="text" class="form-control" name="tglakhir" id="tglakhir" readonly value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>" >
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>
					</div>
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
<?PHP
	}
?>