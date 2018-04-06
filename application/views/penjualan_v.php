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
	if ($level1['data'] == 1 || $level1['data'] == 6) { ?> 
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
			<h2><i class="fa fa-book"></i> Penjualan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Penjualan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>penjualan/item'"><i class="fa fa-plus"></i> Pilih Mobil</button>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Daftar Pembelian</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30">
							<thead>
								<tr>
									<th>Merk</th>
									<th>Tipe</th>
									<th>Warna</th>
									<th>No. Polisi</th>
									<th>Harga Jual</th>
									<th>Hapus</th>
								</tr>
							</thead>
							<tbody>
								<?PHP $total_price=0; $total_item=0; $total_modal=0 ?>
								<?php foreach ($this->cart->contents() as $items): ?>
								<?PHP if($items['types'] == 'penjualan') { ?>
								<tr>
									<form class="form-horizontal" role="form" method="post" action="<?PHP echo site_url(); ?>penjualan/delete_cart">
									<td><?php echo $items['merk']; ?></td>
									<td><?php echo $items['name']; ?></td>
									<td><?php echo $items['warna']; ?></td>
									<td><?php echo $items['nopol']; ?></td>
									<td align="right">IDR <?php echo number_format($items['price']); ?></td>
									<td>
										<input type="hidden" value="<?php echo $items['id']; ?>" name="cidmobil"/>
										<button type="submit" class="fa fa-trash-o"></button>
									</td>
									</form>
								</tr>
								<?PHP $total_modal+=$items['awal']; $total_price+=$items['subtotal']; $total_item+=$items['qty'];} else { } ?>
								<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3">
									</td>
									<td colspan="1">Total : <?php echo $total_item ?></td>
									<td colspan="1" align="right">IDR <?php echo number_format($total_price); ?></td>
									<td colspan="2">
									</td>
								</tr>
							</tfoot>
					</table>
					</div>
				</div>
			</div>
			
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a data-toggle="tab" href="#cash"><strong>Cash</strong></a></li>
				<li><a data-toggle="tab" href="#kredit"><strong>Kredit</strong></a></li>
			</ul>
			<div class="tab-content">
				<div id="cash" class="widget-bloglist tab-pane active">
					<form id="basicForm" action="<?PHP echo base_url() ?>penjualan/insert_data_cash" method="post" name="formsentral1">
						<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
						<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
						<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
						<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
						<input type="hidden" name="countid" value="<?PHP $result=mysql_query("SELECT MAX(idpenjualan) as data from penjualan");$data=mysql_fetch_assoc($result);echo $data['data']+1;?>"/>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tipe Unit</label>
									<select class="form-control mb15" name="jenisbarang" required >
										<option value=""></option>
										<option value="New Car">New Car</option>
										<option value="Used Car">Used Car</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Modal <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" value="<?PHP echo number_format($total_modal); ?>" required readonly />
									<input type="hidden" autocomplete="off" name="hargatotal" value="<?PHP echo $total_price; ?>" />
									<input type="hidden" autocomplete="off" name="hargamodal" id="hhargamodal" value="<?PHP echo $total_modal; ?>" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanggal SPK <font color="red">*</font></label>
									<div class="input-group">
										<input type="text" class="form-control" name="tglspk" id="tglspk" required readonly >
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Jual / OTR <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="hargajual" id="hhargajual" required onkeyup="HitungTotal1();formatAngka(this, ',')" />
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
									<label class="control-label">Selisih Harga</label>
									<input type="text" autocomplete="off" class="form-control" id="selisihharga" value="0" readonly onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Pembeli <font color="red">*</font></label>
									<input type="text" autocomplete="off" name="pembeli" class="form-control" required />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Persentase</label>
									<input type="text" autocomplete="off" class="form-control" id="persentase" value="0" readonly />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Alamat <font color="red">*</font></label>
									<input type="text" autocomplete="off" name="alamat" class="form-control" required />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Discount <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="discount" id="hdiscount" required value="0" onkeyup="HitungTotal1();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Telepon / HP <font color="red">*</font></label>
									<input type="text" autocomplete="off" name="telepon" class="form-control" required onkeypress="return isNumberKey(event)" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Setelah Discount</label>
									<input type="text" autocomplete="off" class="form-control" name="hsdiscount" id="hsdiscount" value="0" readonly required onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Catatan</label>
									<input type="text" autocomplete="off" name="catatan" class="form-control" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanda Jadi <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="tandajadi" required onkeyup="HitungTotal1();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<button class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<div id="kredit" class="widget-bloglist tab-pane">
					<form id="basicForms" action="<?PHP echo base_url() ?>penjualan/insert_data_kredit" method="post" name="formsentral2">
						<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
						<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
						<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
						<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
						<input type="hidden" name="countid" value="<?PHP $result=mysql_query("SELECT MAX(idpenjualan) as data from penjualan");$data=mysql_fetch_assoc($result);echo $data['data']+1;?>"/>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tipe Unit</label>
									<select class="form-control mb15" name="jenisbarang" required >
										<option value=""></option>
										<option value="New Car">New Car</option>
										<option value="Used Car">Used Car</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Modal <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" value="<?PHP echo number_format($total_modal); ?>" required readonly />
									<input type="hidden" autocomplete="off" name="hargatotal" value="<?PHP echo $total_price; ?>" />
									<input type="hidden" autocomplete="off" name="hargamodal" id="hhargamodal" value="<?PHP echo $total_modal; ?>" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanggal SPK <font color="red">*</font></label>
									<div class="input-group">
										<input type="text" class="form-control" name="tglspk" id="tglspks" required readonly >
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Jual / OTR <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="hargajual" id="hhargajual" required onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<label class="control-label">Selisih Harga</label>
									<input type="text" autocomplete="off" class="form-control" id="selisihharga" value="0" readonly onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Via Kredit <font color="red">*</font></label>
									<select class="form-control mb15" name="viakredit" required >
										<?PHP
											$query = $this->db->query("SELECT * FROM _kredit WHERE _deleted=0 AND code NOT LIKE 1 ORDER BY data ASC");
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
									<label class="control-label">Persentase</label>
									<input type="text" autocomplete="off" class="form-control" id="persentase" value="0" readonly />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Pembeli <font color="red">*</font></label>
									<input type="text" autocomplete="off" name="pembeli" class="form-control" required />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Discount <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="discount" id="hdiscount" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Alamat <font color="red">*</font></label>
									<input type="text" autocomplete="off" name="alamat" class="form-control" required />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Setelah Discount</label>
									<input type="text" autocomplete="off" class="form-control" name="hsdiscount" id="hsdiscount" value="0" readonly required onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Telepon / HP <font color="red">*</font></label>
									<input type="text" autocomplete="off" name="telepon" class="form-control" required onkeypress="return isNumberKey(event)" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">DP Min <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="dp" id="hdp" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Catatan</label>
									<input type="text" autocomplete="off" name="catatan" class="form-control" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Jangka Waktu / Tenor <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="jangkawaktubunga" required />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Angsuran <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="angsuran" id="hangsuran" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Biaya Adm <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="biayaadm" id="hbiayaadm" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Asuransi <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="asuransi" id="hasuransi" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Biaya Polis Asuransi <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="biayaasuransi" id="hbiayaasuransi" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Profisi <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="profisi" id="hprofisi" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Uang Muka</label>
									<input type="text" autocomplete="off" class="form-control" id="htotaldp" name="totaldp" required readonly value="0" onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Discount DP <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" id="discountdp" name="discountdp" required value="0" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Total DP <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" id="thdp" name="thdp" required readonly value="0" onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">&nbsp;</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanda Jadi <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control"  name="tandajadi" required onkeyup="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<button class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#tglspk').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#tglspks').datepicker({
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
    jQuery("#basicForms").validate({
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
	function HitungTotal1() {
		a = Number(formsentral1.hhargamodal.value.replace(/[^0-9\.]+/g,""));
		b = Number(formsentral1.hhargajual.value.replace(/[^0-9\.]+/g,""));
		c = Number(formsentral1.hdiscount.value.replace(/[^0-9\.]+/g,""));
		n=b-a;
		//m=(n/b*100).toFixed(0);
		z=n-c;
		q=b+c;
		w=(z/q*100).toFixed(0);
		l=b-c;
		formsentral1.selisihharga.value = n;
		formsentral1.persentase.value = w;
		formsentral1.hsdiscount.value = l;
	}
	function HitungTotal2() {
		x = Number(formsentral2.hhargamodal.value.replace(/[^0-9\.]+/g,""));
		y = Number(formsentral2.hhargajual.value.replace(/[^0-9\.]+/g,""));
		z = Number(formsentral2.hdiscount.value.replace(/[^0-9\.]+/g,""));
		a = Number(formsentral2.hdp.value.replace(/[^0-9\.]+/g,""));
		b = Number(formsentral2.hasuransi.value.replace(/[^0-9\.]+/g,""));
		c = Number(formsentral2.hangsuran.value.replace(/[^0-9\.]+/g,""));
		d = Number(formsentral2.hbiayaasuransi.value.replace(/[^0-9\.]+/g,""));
		e = Number(formsentral2.hbiayaadm.value.replace(/[^0-9\.]+/g,""));
		f = Number(formsentral2.hprofisi.value.replace(/[^0-9\.]+/g,""));
		g = Number(formsentral2.discountdp.value.replace(/[^0-9\.]+/g,""));
		n=y-x;
		//m=(n/y*100).toFixed(0);
		l=y-z;
		h=a+b+c+d+e+f;
		
		a1=n-z;
		q=y+z;
		w=(a1/q*100).toFixed(0);
		
		k=h-g;
		
		formsentral2.selisihharga.value = n;
		formsentral2.persentase.value = w;
		formsentral2.hsdiscount.value = l;
		formsentral2.htotaldp.value = h;
		formsentral2.thdp.value = k;
	}
</script>
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>