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
			<h2><i class="fa fa-book"></i> Pelunasan Kredit</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>pelunasan_leasing">Pelunasan Kredit</a></li>
					<li class="active">Detail Pelunasan Kredit</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Penjualan</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">No. Reg</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo $iddata; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Total Harga</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT totalharga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pembeli</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT pembeli as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Jual</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT hargajual as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Telepon</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT telepon as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Discount</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT discount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alamat</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT alamat as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Setelah Discount</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT hsdiscount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tipe Unit</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">DP Min</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT dp as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal SPK</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT tanggalspk as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jangka Waktu / Tenor</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT jangkawaktubunga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT _cabang.data as data from penjualan,_cabang WHERE penjualan._cabang=_cabang.code AND idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Angsuran</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT angsuran as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Via Kredit</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT _kredit.data as data from penjualan,_kredit WHERE penjualan._kredit=_kredit.code AND idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Adm.</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT biayaadm as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Input</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT entry as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Asuransi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Modified</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT user.nama as data from penjualan,user WHERE penjualan.updated=user.username AND idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Polis Asuransi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT biayaasuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
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
								<label class="control-label">Profisi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
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
								<label class="control-label">Total DP</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT totaldp as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$jtdp=$data['data']?>" readonly />
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
								<label class="control-label">Jumlah Bayar</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$jbayar=$data['data']?>" readonly />
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
								<label class="control-label">Sisa AR</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($jtdp-$jbayar);?>" readonly />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mobil Yang Dibeli</h4>
				</div>
				<div class="panel-body">
					<table class="table table-striped mb30">
						<thead>
							<th>Merk</th>
							<th>Tipe</th>
							<th>No. Polisi</th>
							<th>Warna</th>
							<th>Harga Modal</th>
						</thead>
						<tbody>
							<?PHP
								$query = $this->db->query("SELECT *
								FROM detail_penjualan
								WHERE d_idpenjualan='".$iddata."'");
								if($query->num_rows())
								{
									foreach($query->result() as $row)
									{	
							?>
							<tr>
								<td><?PHP echo $row->d_merk; ?></td>
								<td><?PHP echo $row->d_tipemobil; ?></td>
								<td><?PHP echo $row->d_nopol; ?></td>
								<td><?PHP echo $row->d_warna; ?></td>
								<td><?PHP echo number_format($row->d_dasar); ?></td>
							</tr>
							<?PHP
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Purchase Order</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor PO</label>
								<input type="text" autocomplete="off" name="" readonly class="form-control" value="<?PHP $result=mysql_query("SELECT nopo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal PO <font color="red">*</font></label>
								<input type="text" class="form-control" name="" readonly required value="<?PHP $result=mysql_query("SELECT tglpo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal PO</label>
								<input readonly type="text" autocomplete="off" name="nominalpo" class="form-control" onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT nominalpo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Pencairan Leasing</h4>
				</div>
				<div class="panel-body">
				<form id="basicForm" action="<?PHP echo base_url() ?>pelunasan_leasing/deal_pelunasan" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata ?>" />
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglpelunasan" id="date1" readonly required value="<?PHP $result=mysql_query("SELECT tgl_pelunasan as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pelunasan <font color="red">*</font></label>
								<input onClick="formatAngka(this, ',');HitungTotal()" type="text" autocomplete="off" name="pelunasan" id="pelunasan" class="form-control" readonly value="<?PHP $result=mysql_query("SELECT sum(hsdiscount-totaldp) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Refund Asuransi <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglasuransi" id="date2" readonly required value="<?PHP $result=mysql_query("SELECT tgl_asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Asuransi <font color="red">*</font></label>
								<input onkeyup="formatAngka(this, ',');HitungTotal()" type="text" autocomplete="off" name="asuransi" id="asuransi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Bunga <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglrefund" id="date3" readonly required value="<?PHP $result=mysql_query("SELECT tgl_refund as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Bunga <font color="red">*</font></label>
								<input onkeyup="formatAngka(this, ',');HitungTotal()" type="text" autocomplete="off" name="refund" id="refund" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_refund as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Profisi <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglprofisi" id="date4" readonly required value="<?PHP $result=mysql_query("SELECT tgl_profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Profisi <font color="red">*</font></label>
								<input onkeyup="formatAngka(this, ',');HitungTotal()" type="text" autocomplete="off" name="profisi" id="profisi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
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
								<label class="control-label">Total Refund + Pelunasan</label>
								<input type="text" readonly id="tfp" name="tfp" class="form-control" onClick="formatAngka(this, ',');HitungTotal();" value="<?PHP $result=mysql_query("SELECT sum(hsdiscount-totaldp+p_profisi+p_refund+p_asuransi) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-9">
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
	jQuery('#date1').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date2').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date3').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date4').datepicker({
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
		a = Number(formsentral.pelunasan.value.replace(/[^0-9\.]+/g,""));
		b = Number(formsentral.asuransi.value.replace(/[^0-9\.]+/g,""));
		c = Number(formsentral.refund.value.replace(/[^0-9\.]+/g,""));
		d = Number(formsentral.profisi.value.replace(/[^0-9\.]+/g,""));
		n=a+b+c+d;
		formsentral.tfp.value = n;
	}
</script>
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>