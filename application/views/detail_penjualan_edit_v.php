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
			<h2><i class="fa fa-hdd-o"></i> Edit Penjualan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Edit Penjualan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<?PHP $tipebayar=mysql_query("SELECT tipebayar as data from penjualan WHERE idpenjualan='".$iddata."'");$tipebayar1=mysql_fetch_assoc($tipebayar);
			if ($tipebayar1['data'] == "Cash") { ?> 
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a data-toggle="tab" href="#cash"><strong>Cash</strong></a></li>
			</ul>
			<div class="tab-content">
				<div id="cash" class="widget-bloglist tab-pane active">
					<form id="basicForm" action="<?PHP echo base_url() ?>detail_penjualan/edit_cash" method="post" name="formsentral1">
						<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
						<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
						<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
						<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
						<input type="hidden" name="iddata" value="<?PHP echo $iddata; ?>"/>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tipe Unit <font color="red">*</font></label>
									<select class="form-control mb15" name="jenisbarang" required >
										<option value=""></option>
										<option value="New Car" <?php $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == "New Car"){echo 'selected="selected"'; }?>>New Car</option>
										<option value="Used Car" <?php $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == "Used Car"){echo 'selected="selected"'; }?>>Used Car</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Modal <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" value="<?PHP $result=mysql_query("SELECT hargamodal as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" required readonly />
									<input type="hidden" autocomplete="off" name="hargatotal" value="<?PHP $result=mysql_query("SELECT totalharga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
									<input type="hidden" autocomplete="off" name="hargamodal" id="hhargamodal" value="<?PHP $result=mysql_query("SELECT hargamodal as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanggal SPK <font color="red">*</font></label>
									<div class="input-group">
										<input type="text" class="form-control" name="tglspk" id="tglspk" required readonly value="<?PHP $result=mysql_query("SELECT tanggalspk as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Jual / OTR <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="hargajual" id="hhargajual" required onkeyup="HitungTotal1();formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT hargajual as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
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
											<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _cabang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
										<?PHP
											endforeach;
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Selisih Harga</label>
									<input type="text" autocomplete="off" class="form-control" id="selisihharga" readonly onClick="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT sum(hargajual-hargamodal) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Pembeli</label>
									<input type="text" autocomplete="off" name="pembeli" class="form-control" required readonly value="<?PHP $result=mysql_query("SELECT pembeli as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Persentase</label>
									<input type="text" autocomplete="off" class="form-control" id="persentase" value="-" readonly />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Alamat</label>
									<input type="text" autocomplete="off" name="alamat" class="form-control" required readonly value="<?PHP $result=mysql_query("SELECT alamat as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Discount <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="discount" id="hdiscount" required value="<?PHP $result=mysql_query("SELECT discount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal1();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Telepon / HP</label>
									<input type="text" autocomplete="off" name="telepon" class="form-control" required onkeypress="return isNumberKey(event)" readonly value="<?PHP $result=mysql_query("SELECT telepon as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Setelah Discount</label>
									<input type="text" autocomplete="off" class="form-control" name="hsdiscount" id="hsdiscount" value="<?PHP $result=mysql_query("SELECT hsdiscount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly required onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Catatan</label>
									<input type="text" autocomplete="off" name="catatan" class="form-control" value="<?PHP $result=mysql_query("SELECT catatan as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanda Jadi</label>
									<input type="text" autocomplete="off" class="form-control" name="tandajadi" required onkeyup="HitungTotal1();formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT tandajadi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<button class="btn btn-info">Edit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Tanda Jadi</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT tgl1 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT dp1 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Pembayaran Pelunasan</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>detail_penjualan/edit_data" method="post" name="formsentral">
				<input type="hidden" name="totalnya1" id="totalnya1" class="input-xlarge" value="<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
				<input type="hidden" name="totaldp" id="totaldp" value="<?PHP $result=mysql_query("SELECT sum(dp1) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
				<input type="hidden" name="iddata" value="<?PHP echo $iddata ?>" />
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 1</label>
									<input readonly type="text" class="form-control" name="tgl1" id="date1" required value="<?PHP $result=mysql_query("SELECT tgl2 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 1</label>
								<input type="text" autocomplete="off" name="dp1" id="dp1" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 2</label>
									<input readonly type="text" class="form-control" name="tgl2" id="date2" required value="<?PHP $result=mysql_query("SELECT tgl3 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 2</label>
								<input type="text" autocomplete="off" name="dp2" id="dp2" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 3</label>
									<input readonly type="text" class="form-control" name="tgl3" id="date3" required value="<?PHP $result=mysql_query("SELECT tgl4 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 3</label>
								<input type="text" autocomplete="off" name="dp3" id="dp3" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 4</label>
									<input readonly type="text" class="form-control" name="tgl4" id="date4" required value="<?PHP $result=mysql_query("SELECT tgl5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 4</label>
								<input type="text" autocomplete="off" name="dp4" id="dp4" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 5</label>
									<input readonly type="text" class="form-control" name="tgl5" id="date5" required value="<?PHP $result=mysql_query("SELECT tgl6 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 5</label>
								<input type="text" autocomplete="off" name="dp5" id="dp5" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-9">
							<button class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
				</form>
			</div>
			<br>
			<?PHP } else { ?>
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a data-toggle="tab" href="#cash"><strong>Kredit</strong></a></li>
			</ul>
			<div class="tab-content">
				<div id="kredit" class="widget-bloglist tab-pane active">
					<form id="basicForms" action="<?PHP echo base_url() ?>detail_penjualan/edit_kredit" method="post" name="formsentral2">
						<input type="hidden" name="entry" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("Y-m-d")?>"/>
						<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
						<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
						<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
						<input type="hidden" name="iddata" value="<?PHP echo $iddata; ?>"/>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tipe Unit <font color="red">*</font></label>
									<select class="form-control mb15" name="jenisbarang" required >
										<option value=""></option>
										<option value="New Car" <?php $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == "New Car"){echo 'selected="selected"'; }?>>New Car</option>
										<option value="Used Car" <?php $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == "Used Car"){echo 'selected="selected"'; }?>>Used Car</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Modal <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" value="<?PHP $result=mysql_query("SELECT hargamodal as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" required readonly />
									<input type="hidden" autocomplete="off" name="hargatotal" value="<?PHP $result=mysql_query("SELECT totalharga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
									<input type="hidden" autocomplete="off" name="hargamodal" id="hhargamodal" value="<?PHP $result=mysql_query("SELECT hargamodal as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Tanggal SPK <font color="red">*</font></label>
									<div class="input-group">
										<input type="text" class="form-control" name="tglspk" id="tglspks" required readonly value="<?PHP $result=mysql_query("SELECT tanggalspk as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Jual / OTR <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="hargajual" id="hhargajual" required onkeyup="HitungTotal2();formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT hargajual as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
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
										<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _cabang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
										<?PHP
											endforeach;
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Selisih Harga</label>
									<input type="text" autocomplete="off" class="form-control" id="selisihharga" value="<?PHP $result=mysql_query("SELECT sum(hargajual-hargamodal) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly onClick="formatAngka(this, ',')" />
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
										<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _kredit as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
										<?PHP
											endforeach;
										?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Persentase</label>
									<input type="text" autocomplete="off" class="form-control" id="persentase" value="-" readonly />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Pembeli</label>
									<input type="text" autocomplete="off" name="pembeli" class="form-control" required value="<?PHP $result=mysql_query("SELECT pembeli as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Discount <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="discount" id="hdiscount" required value="<?PHP $result=mysql_query("SELECT discount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Alamat </label>
									<input type="text" autocomplete="off" name="alamat" class="form-control" required readonly value="<?PHP $result=mysql_query("SELECT alamat as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>"/>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Harga Setelah Discount</label>
									<input type="text" autocomplete="off" class="form-control" name="hsdiscount" id="hsdiscount" value="<?PHP $result=mysql_query("SELECT hsdiscount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly required onClick="formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Telepon / HP</label>
									<input type="text" autocomplete="off" name="telepon" class="form-control" required onkeypress="return isNumberKey(event)" readonly value="<?PHP $result=mysql_query("SELECT telepon as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">DP Min <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="dp" id="hdp" required value="<?PHP $result=mysql_query("SELECT dp as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Catatan</label>
									<input type="text" autocomplete="off" name="catatan" class="form-control" value="<?PHP $result=mysql_query("SELECT catatan as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Jangka Waktu / Tenor <font color="red">*</font></label>
									<input type="text" autocomplete="off" class="form-control" name="jangkawaktubunga" required value="<?PHP $result=mysql_query("SELECT jangkawaktubunga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>"/>
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
									<input type="text" autocomplete="off" class="form-control" name="angsuran" id="hangsuran" required value="<?PHP $result=mysql_query("SELECT angsuran as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" name="biayaadm" id="hbiayaadm" required value="<?PHP $result=mysql_query("SELECT biayaadm as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" name="asuransi" id="hasuransi" required value="<?PHP $result=mysql_query("SELECT asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" name="biayaasuransi" id="hbiayaasuransi" required value="<?PHP $result=mysql_query("SELECT biayaasuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" name="profisi" id="hprofisi" required value="<?PHP $result=mysql_query("SELECT profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" id="htotaldp" name="totaldp" required readonly value="<?PHP $result=mysql_query("SELECT uangmuka as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onClick="formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" id="discountdp" name="discountdp" required value="<?PHP $result=mysql_query("SELECT discountdp as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="HitungTotal2();formatAngka(this, ',')" />
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
									<input type="text" autocomplete="off" class="form-control" id="thdp" name="thdp" required readonly value="<?PHP $result=mysql_query("SELECT sum(uangmuka-discountdp) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onClick="formatAngka(this, ',')" />
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
									<label class="control-label">Tanda Jadi</label>
									<input type="text" autocomplete="off" class="form-control"  name="tandajadi" readonly onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT tandajadi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-sm-12">
								<button class="btn btn-info">Edit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Tanda Jadi</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT tgl1 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT dp1 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Pembayaran Pelunasan</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>detail_penjualan/edit_data" method="post" name="formsentral">
				<input type="hidden" name="totalnya1" id="totalnya1" class="input-xlarge" value="<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
				<input type="hidden" name="totaldp" id="totaldp" value="<?PHP $result=mysql_query("SELECT sum(dp1) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
				<input type="hidden" name="iddata" value="<?PHP echo $iddata ?>" />
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 1</label>
									<input readonly type="text" class="form-control" name="tgl1" id="date1" required value="<?PHP $result=mysql_query("SELECT tgl2 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 1</label>
								<input type="text" autocomplete="off" name="dp1" id="dp1" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 2</label>
									<input readonly type="text" class="form-control" name="tgl2" id="date2" required value="<?PHP $result=mysql_query("SELECT tgl3 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 2</label>
								<input type="text" autocomplete="off" name="dp2" id="dp2" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 3</label>
									<input readonly type="text" class="form-control" name="tgl3" id="date3" required value="<?PHP $result=mysql_query("SELECT tgl4 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 3</label>
								<input type="text" autocomplete="off" name="dp3" id="dp3" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 4</label>
									<input readonly type="text" class="form-control" name="tgl4" id="date4" required value="<?PHP $result=mysql_query("SELECT tgl5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 4</label>
								<input type="text" autocomplete="off" name="dp4" id="dp4" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 5</label>
									<input readonly type="text" class="form-control" name="tgl5" id="date5" required value="<?PHP $result=mysql_query("SELECT tgl6 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 5</label>
								<input type="text" autocomplete="off" name="dp5" id="dp5" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-9">
							<button class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
				</form>
			</div>
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Deal Purchase Order</h4>
				</div>
				<div class="panel-body">
				<form id="basicForm" action="<?PHP echo base_url() ?>detail_penjualan/deal_po" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata ?>" />
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor PO</label>
								<input type="text" autocomplete="off" name="nopo" class="form-control" value="<?PHP $result=mysql_query("SELECT nopo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal PO <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglpo" id="date6" readonly required value="<?PHP $result=mysql_query("SELECT tglpo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal PO <font color="red">*</font></label>
								<input type="text" autocomplete="off" required name="nominalpo" class="form-control" onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT nominalpo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
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
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Pencairan Leasing</h4>
				</div>
				<div class="panel-body">
				<form id="basicForm" action="<?PHP echo base_url() ?>detail_penjualan/deal_pelunasan" method="post" name="formsentral">
				<input type="hidden" name="iddata" value="<?PHP echo $iddata ?>" />
				<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
				<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
				<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglpelunasan" id="date7" readonly required value="<?PHP $result=mysql_query("SELECT tgl_pelunasan as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pelunasan <font color="red">*</font></label>
								<input onClick="formatAngka(this, ',')" type="text" autocomplete="off" name="pelunasan" class="form-control" readonly value="<?PHP $result=mysql_query("SELECT sum(hsdiscount-totaldp) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Refund Asuransi <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglasuransi" id="date8" readonly required value="<?PHP $result=mysql_query("SELECT tgl_asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Asuransi <font color="red">*</font></label>
								<input onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="asuransi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Bunga <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglrefund" id="date9" readonly required value="<?PHP $result=mysql_query("SELECT tgl_refund as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Bunga <font color="red">*</font></label>
								<input onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="refund" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_refund as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Profisi <font color="red">*</font></label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglprofisi" id="date10" readonly required value="<?PHP $result=mysql_query("SELECT tgl_profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Profisi <font color="red">*</font></label>
								<input onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="profisi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
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
			<?PHP } ?>
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
	jQuery('#date5').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date6').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date7').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date8').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date9').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
	jQuery('#date10').datepicker({
		numberOfMonths: 3,dateFormat:'yy-mm-dd'
	  });
 });
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