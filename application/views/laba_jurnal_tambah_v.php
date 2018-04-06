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
					<li class="active">Tambah Jurnal</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="row">
				<form id="basicForm" action="<?PHP echo base_url() ?>laba_jurnal/insert_datas" method="post" name="formsentral">
				<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				
				<input type="hidden" name="banyakdebit" value="<?PHP echo $banyakdebit; ?>"/>
				<input type="hidden" name="banyakkredit" value="<?PHP echo $banyakkredit; ?>"/>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Data Jurnal</h4>
						</div>
						<div class="panel-body">
							<label>Voucher <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="voucher" id="voucher" class="form-control" required />
						
							<label>Tanggal <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tgl" id="datepicker-multiple" readonly required >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
					  
							<label>Cabang <font color="red">*</font></label>
								<select class="form-control mb15" name="cabang" required >
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
					</div>
					<div class="row">
						<div class="col-sm-9">
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
						if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
							<button class="btn btn-primary">Submit</button>
						<?PHP } else { }?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Debit</h4>
						</div>
						<div class="panel-body">
							<?PHP $i=1; for($i=1;$i<=$banyakdebit;$i++) {?>
							<label class="control-label"><?PHP echo $i; ?>. Jenis Debit <font color="red">*</font></label>
								<select class="form-control mb15" name="jdebit<?PHP echo $i; ?>" id="jdebit<?PHP echo $i; ?>" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _jenis ORDER BY code ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>"><?PHP echo $row->code; ?> | <?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
								
								<label class="control-label"><?PHP echo $i; ?>. Nominal Debit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="ndebit<?PHP echo $i; ?>" id="ndebit<?PHP echo $i; ?>" class="form-control" required onkeyup="formatAngka(this, ',');HitungDebit()"/>
								
								
								<label>Keterangan Debit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="kdebit<?PHP echo $i; ?>" class="form-control" required />
								
								<hr>
							<?PHP }?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Kredit</h4>
						</div>
						<div class="panel-body">
							<?PHP $x=1; for($x=1;$x<=$banyakkredit;$x++) {?>
							<label class="control-label"><?PHP echo $x; ?>. Jenis Kredit <font color="red">*</font></label>
								<select class="form-control mb15" name="jkredit<?PHP echo $x; ?>" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _jenis ORDER BY code ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>"><?PHP echo $row->code; ?> | <?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
								
								<label class="control-label"><?PHP echo $x; ?>. Nominal Kredit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="nkredit<?PHP echo $x; ?>" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()"/>
								
								<label>Keterangan Kredit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="kkredit<?PHP echo $x; ?>" class="form-control" required />
								
								<hr>
							<?PHP }?>
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
	function HitungDebit() {
	var banyakdebit=<?PHP echo $i; ?>-1;
		for(i=1;i<=banyakdebit;i++) 
		{
			akaks = Number(formsentral.jdebit+i.value.replace(/[^0-9\.]+/g,""));
			alert(i);
		}
			//n=a+b+c+d+e+f+g+h+i;
			//formsentral.hmodal.value = n;
	}
</script>
<?PHP } else { }?>
<?PHP
	}
?>