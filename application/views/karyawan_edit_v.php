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
			<h2><i class="fa fa-users"></i> Karyawan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>karyawan">Karyawan</a></li>
					<li class="active">Edit Karyawan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon edit data karyawan dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>karyawan/edit_data" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata?>"/>
				<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">No KTP <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="noktp" class="form-control" required value="<?PHP $result=mysql_query("SELECT noktp as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jabatan</label>
								<input type="text" autocomplete="off" name="jabatan" class="form-control" value="<?PHP $result=mysql_query("SELECT jabatan as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nama <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="nama" class="form-control" required value="<?PHP $result=mysql_query("SELECT nama as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Mulai Kerja <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="mulaikerja" id="datepicker-multiple" readonly required value="<?PHP $result=mysql_query("SELECT mulaikerja as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tempat Lahir</label>
								<input type="text" autocomplete="off" name="tempatlahir" class="form-control" value="<?PHP $result=mysql_query("SELECT tempatlahir as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Lahir</label>
									<input type="text" autocomplete="off" name="tgllahir" class="form-control" value="<?PHP $result=mysql_query("SELECT tgllahir as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alamat KTP</label>
								<input type="text" autocomplete="off" name="alamatktp" class="form-control" value="<?PHP $result=mysql_query("SELECT alamatktp as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang <font color="red">*</font></label>
								<select class="form-control mb15" name="cabang" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _cabang as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alamat Sekarang</label>
								<input type="text" autocomplete="off" name="alamat" class="form-control" value="<?PHP $result=mysql_query("SELECT alamat as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Gaji</label>
								<input type="text" autocomplete="off" name="gaji" onkeyup="formatAngka(this, ',')" class="form-control" value="<?PHP $result=mysql_query("SELECT gaji as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Telp</label>
								<input type="text" autocomplete="off" name="telp" class="form-control" value="<?PHP $result=mysql_query("SELECT telp as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Uang Makan</label>
								<input type="text" autocomplete="off" name="uangmakan" onkeyup="formatAngka(this, ',')" class="form-control" value="<?PHP $result=mysql_query("SELECT uangmakan as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Gender <font color="red">*</font></label>
								<select class="form-control mb15" name="gender" required >
									<option value="Pria" <?php $result=mysql_query("SELECT gender as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 'Pria'){echo 'selected="selected"'; }?>>Pria</option>
									<option value="Wanita" <?php $result=mysql_query("SELECT gender as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == 'Wanita'){echo 'selected="selected"'; }?>>Wanita</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Status <font color="red">*</font></label>
								<select class="form-control mb15" name="status" required >
									<option value="0" <?php $result=mysql_query("SELECT _deleted as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == '0'){echo 'selected="selected"'; }?>>Aktif</option>
									<option value="1" <?php $result=mysql_query("SELECT _deleted as data from karyawan WHERE idkaryawan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == '1'){echo 'selected="selected"'; }?>>Tidak Aktif</option>
								</select>
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
	function HitungTotal() {
		a = Number(formsentral.hbeli.value.replace(/[^0-9\.]+/g,""));
		b = Number(formsentral.hbengkel.value.replace(/[^0-9\.]+/g,""));
		c = Number(formsentral.hcat.value.replace(/[^0-9\.]+/g,""));
		d = Number(formsentral.hacc.value.replace(/[^0-9\.]+/g,""));
		e = Number(formsentral.hbbn.value.replace(/[^0-9\.]+/g,""));
		f = Number(formsentral.hkomisi.value.replace(/[^0-9\.]+/g,""));
		g = Number(formsentral.hstnk.value.replace(/[^0-9\.]+/g,""));
		n=a+b+c+d+e+f+g;
		formsentral.hmodal.value = n;
	}
</script>
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>