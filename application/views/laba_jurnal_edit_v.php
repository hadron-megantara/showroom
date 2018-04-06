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
	if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8) { ?> 
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
					<li><a href="<?PHP echo base_url() ?>laba_jurnal">Jurnal</a></li>
					<li class="active">Edit Jurnal</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<?PHP $jenisjurnal=mysql_query("SELECT * from laba_rugi WHERE idlr='".$iddata."'");$jenisjurnal1=mysql_fetch_assoc($jenisjurnal);
		if ($jenisjurnal1['debit'] != "0") { ?> 
		<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon edit data jurnal dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>laba_jurnal/edit_data_debit" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata?>"/>
				<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Voucher </label>
								<input type="text" autocomplete="off" name="voucher" class="form-control" required readonly value="<?PHP $result=mysql_query("SELECT voucher as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<div class="input-group">
									<input type="text" class="form-control" name="tgl" id="datepicker-multiple" readonly required value="<?PHP $result=mysql_query("SELECT tgl as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jenis <font color="red">*</font></label>
								<select class="form-control mb15" name="jenis" required>
									<?PHP
										$query = $this->db->query("SELECT * FROM _jenis ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _jenis as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->code; ?> | <?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Debit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="nominal" class="form-control" required onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT debit as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang </label>
								<select class="form-control mb15" name="cabang" required readonly>
									<?PHP
										$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _cabang as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="keterangan" class="form-control" required value="<?PHP $result=mysql_query("SELECT keterangan as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-9">
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
						if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
							<button class="btn btn-primary">Submit</button>
						<?PHP } else { }?>
						</div>
					</div>
				</div>
				</form>
			</div>
		<?PHP }else { ?> 
		<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon edit data jurnal dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>laba_jurnal/edit_data_kredit" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata?>"/>
				<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Voucher </label>
								<input type="text" autocomplete="off" name="voucher" class="form-control" required readonly value="<?PHP $result=mysql_query("SELECT voucher as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<div class="input-group">
									<input type="text" class="form-control" name="tgl" id="datepicker-multiple" readonly required value="<?PHP $result=mysql_query("SELECT tgl as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jenis <font color="red">*</font></label>
								<select class="form-control mb15" name="jenis" required>
									<?PHP
										$query = $this->db->query("SELECT * FROM _jenis ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _jenis as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Kredit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="nominal" class="form-control" required onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT kredit as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang </label>
								<select class="form-control mb15" name="cabang" required readonly>
									<?PHP
										$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _cabang as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="keterangan" class="form-control" required value="<?PHP $result=mysql_query("SELECT keterangan as data from laba_rugi WHERE idlr='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-9">
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
						if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
							<button class="btn btn-primary">Submit</button>
						<?PHP } else { }?>
						</div>
					</div>
				</div>
				</form>
			</div>
		<?PHP }?> 
			
		</div>
	</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#datepicker-multiple').datepicker({
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
		a = Number(formsentral.ndebit.value.replace(/[^0-9\.]+/g,""));
		b = Number(formsentral.nkredit.value.replace(/[^0-9\.]+/g,""));
		n=a-b;
		formsentral.selisih.value = n;
	}
</script>
<?PHP } else { }?>
<?PHP
	}
?>