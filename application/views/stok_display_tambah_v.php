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
			<h2><i class="fa fa-truck"></i> Stok Display</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>stok_display">Stok Display</a></li>
					<li class="active">Tambah Stok Display</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon input data mobil dengan benar</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>stok_display/insert_data" method="post" name="formsentral">
				<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Mobil <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jenis Mobil <font color="red">*</font></label>
								<select class="form-control mb15" name="jenis" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _jenismobil WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>"><?PHP echo $row->data; ?></option>
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
								<label class="control-label">Cabang <font color="red">*</font></label>
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
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Beli <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hbeli" id="hbeli" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tipe Mobil <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="tipe" class="form-control" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Komisi <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hkomisi" id="hkomisi" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Polisi <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="nopol" maxlength="10" class="form-control" onkeyup="f(this)" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Bengkel <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hbengkel" id="hbengkel" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tahun <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="tahun" class="form-control" maxlength="4" onkeypress="return isNumberKey(event)" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan Bengkel</label>
								<input type="text" autocomplete="off" name="ketbengkel" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Warna <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="warna" class="form-control" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Cat dan Poles <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hcat" id="hcat" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Mati Pajak <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglmp" id="datepicker-multiple" readonly required >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Aksesoris <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hacc" id="hacc" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Domisili <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="domisili" class="form-control" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan Aksesoris</label>
								<input type="text" autocomplete="off" name="ketaksesoris" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">BBN <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="bbn" class="form-control" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya BBN <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hbbn" id="hbbn" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Supplier <font color="red">*</font></label>
								<select class="form-control mb15" name="supplier" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM supplier WHERE _deleted=0 ORDER BY nama ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->idsupplier; ?>"><?PHP echo $row->nama; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya STNK <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hstnk" id="hstnk" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0" required />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Beli <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglbeli" id="datepicker-multiples" readonly required >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Cas Dealer <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="bcasd" id="bcasd" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0" required />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Cash <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hcash" class="form-control" required onkeyup="formatAngka(this, ',')" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Lain Lain <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="blain" id="blain" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0" required />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Kredit <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hkredit" class="form-control" required onkeyup="formatAngka(this, ',')" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Modal <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hawal" id="hmodal" class="form-control" required onClick="formatAngka(this, ',')" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">&nbsp; </label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Saran <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="hjual" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="0"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Keterangan <font color="red">*</font></label>
								<input type="text" autocomplete="off" name="keterangan" class="form-control" required />
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-9">
							<button class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-default">Reset</button>
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
		h = Number(formsentral.bcasd.value.replace(/[^0-9\.]+/g,""));
		i = Number(formsentral.blain.value.replace(/[^0-9\.]+/g,""));
		n=a+b+c+d+e+f+g+h+i;
		formsentral.hmodal.value = n;
	}
</script>
<?PHP } else { }?>
<?PHP
	}
?>