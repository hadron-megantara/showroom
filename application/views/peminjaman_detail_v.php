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
			<h2><i class="fa fa-book"></i> Peminjaman</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>peminjaman">Peminjaman</a></li>
					<li class="active">Detail Peminjaman</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon lihat data peminjaman dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>peminjaman/insert_data" method="post" name="formsentral">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nama Karyawan </label>
								<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT karyawan.nama as data from detail_peminjaman,karyawan WHERE detail_peminjaman._idkaryawan=karyawan.idkaryawan AND idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jumlah </label>
								<input type="text" autocomplete="off" name="jumlah" class="form-control" readonly value="<?PHP $result=mysql_query("SELECT jumlah as data from detail_peminjaman WHERE idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jatuh Tempo </label>
									<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT jatuhtempo as data from detail_peminjaman WHERE idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Dibayar </label>
								<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT dibayar as data from detail_peminjaman WHERE idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Catatan </label>
								<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT catatan as data from detail_peminjaman WHERE idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Entry </label>
									<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT entry as data from detail_peminjaman WHERE idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Modified </label>
								<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT user.nama as data from detail_peminjaman,user WHERE detail_peminjaman.updated=user.username AND idpeminjaman='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#datepicker-multiple').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	  jQuery('#datepicker-multiples').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
    jQuery("#basicForm").validate({
    highlight: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
      jQuery(element).closest('.form-group').removeClass('has-error');
    }
  });
 });
  function f(o){o.value=o.value.toUpperCase().replace(/([^0-9A-Z])/g,"");}
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function formatAngka(objek, separator) {
  a = objek.value;
  b = a.replace(/[^\d]/g,"");
  c = "";
  panjang = b.length;
  j = 0;
  for (i = panjang; i > 0; i--) {
    j = j + 1;
    if (((j % 3) == 1) && (j != 1)) {
      c = b.substr(i-1,1) + separator + c;
    } else {
      c = b.substr(i-1,1) + c;
    }
  }
  objek.value = c;
}
</script>
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>