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
			<h2><i class="fa fa-truck"></i> Terjual Kredit</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>terjual_cash">Terjual Kredit</a></li>
					<li class="active">Detail Terjual Kredit</li>
				</ol>
			</div>
		</div>
		<?PHP $result=mysql_query("SELECT idpenjualan as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);$idpenjualan=$data['data'];?>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Mohon lihat data mobil dengan benar</h4>
				</div>
				<form id="" action="" method="post" name="formsentral">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Mobil</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP echo $iddata; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jenis Mobil</label>
								<select readonly class="form-control mb15" name="jenis" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _jenismobil WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _jenismobil as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
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
								<label class="control-label">Cabang</label>
								<select readonly class="form-control mb15" name="cabang" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>" <?php $result=mysql_query("SELECT _cabang as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->code){echo 'selected="selected"'; }?>><?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Beli</label>
								<input readonly type="text" autocomplete="off" name="hbeli" id="hbeli" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hbeli as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tipe Mobil</label>
								<input readonly type="text" autocomplete="off" name="tipe" class="form-control" value="<?PHP $result=mysql_query("SELECT tipemobil as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Komisi</label>
								<input readonly type="text" autocomplete="off" name="hkomisi" id="hkomisi" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hkomisi as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nomor Polisi</label>
								<input readonly type="text" autocomplete="off" name="nopol" maxlength="10" class="form-control" onkeyup="f(this)" value="<?PHP $result=mysql_query("SELECT nopol as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Bengkel</label>
								<input readonly type="text" autocomplete="off" name="hbengkel" id="hbengkel" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hbengkel as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tahun</label>
								<input readonly type="text" autocomplete="off" name="tahun" class="form-control" maxlength="4" onkeypress="return isNumberKey(event)" value="<?PHP $result=mysql_query("SELECT tahun as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan Bengkel</label>
								<input readonly type="text" autocomplete="off" name="ketbengkel" class="form-control" value="<?PHP $result=mysql_query("SELECT ketbengkel as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Warna</label>
								<input readonly type="text" autocomplete="off" name="warna" class="form-control" value="<?PHP $result=mysql_query("SELECT warna as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Cat dan Poles</label>
								<input readonly type="text" autocomplete="off" name="hcat" id="hcat" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hcat as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Mati Pajak</label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglmp" id="datepicker-multiple" readonly value="<?PHP $result=mysql_query("SELECT tglmp as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Aksesoris</label>
								<input readonly type="text" autocomplete="off" name="hacc" id="hacc" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hacc as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Domisili</label>
								<input readonly type="text" autocomplete="off" name="domisili" class="form-control" value="<?PHP $result=mysql_query("SELECT domisili as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Keterangan Aksesoris</label>
								<input readonly type="text" autocomplete="off" name="ketaksesoris" class="form-control" value="<?PHP $result=mysql_query("SELECT ketacc as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">BBN</label>
								<input readonly type="text" autocomplete="off" name="bbn" class="form-control" value="<?PHP $result=mysql_query("SELECT bbn as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya BBN</label>
								<input readonly type="text" autocomplete="off" name="hbbn" id="hbbn" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hbbn as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Supplier</label>
								<select readonly class="form-control mb15" name="supplier" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM supplier WHERE _deleted=0 AND idsupplier NOT LIKE 0 ORDER BY nama ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->idsupplier; ?>" <?php $result=mysql_query("SELECT _idsupplier as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result); if($data['data'] == $row->idsupplier){echo 'selected="selected"'; }?>><?PHP echo $row->nama; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya STNK</label>
								<input readonly type="text" autocomplete="off" name="hstnk" id="hstnk" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hstnk as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Beli</label>
								<div class="input-group">
									<input type="text" class="form-control" name="tglbeli" id="datepicker-multiples" readonly value="<?PHP $result=mysql_query("SELECT tglbeli as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required >
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Modal</label>
								<input readonly type="text" autocomplete="off" name="hawal" id="hmodal" class="form-control" required onClick="formatAngka(this, ',')" readonly value="<?PHP $result=mysql_query("SELECT hawal as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Cash</label>
								<input readonly type="text" autocomplete="off" name="hcash" class="form-control" required onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT hcash as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Saran</label>
								<input readonly type="text" autocomplete="off" name="hjual" class="form-control" required onkeyup="formatAngka(this, ',');HitungTotal()" value="<?PHP $result=mysql_query("SELECT hmax as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Kredit</label>
								<input readonly type="text" autocomplete="off" name="hkredit" class="form-control" required onkeyup="formatAngka(this, ',')" value="<?PHP $result=mysql_query("SELECT hkredit as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Keterangan</label>
								<input readonly type="text" autocomplete="off" name="keterangan" class="form-control" value="<?PHP $result=mysql_query("SELECT keterangan as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Entry </label>
									<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT entry as data from mobil WHERE idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Modified </label>
								<input type="text" class="form-control" name="jatuhtempo" readonly value="<?PHP $result=mysql_query("SELECT user.nama as data from mobil,user WHERE mobil.updated=user.username AND idmobil='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Penjualan</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">No. Reg</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo $idpenjualan; ?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Total Harga</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT totalharga as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pembeli</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT pembeli as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Jual</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT hargajual as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Telepon</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT telepon as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Discount</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT discount as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alamat</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT alamat as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Setelah Discount</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT hsdiscount as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tipe Unit</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">DP Min</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT dp as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal SPK</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT tanggalspk as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jangka Waktu / Tenor</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT jangkawaktubunga as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT _cabang.data as data from penjualan,_cabang WHERE penjualan._cabang=_cabang.code AND idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Angsuran</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT angsuran as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Via Kredit</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT _kredit.data as data from penjualan,_kredit WHERE penjualan._kredit=_kredit.code AND idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Adm.</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT biayaadm as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Input</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT entry as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Asuransi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT asuransi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Modified</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT user.nama as data from penjualan,user WHERE penjualan.updated=user.username AND idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Biaya Polis Asuransi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT biayaasuransi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
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
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT profisi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
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
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT totaldp as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$jtdp=$data['data']?>" readonly />
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
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5) as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$jbayar=$data['data']?>" readonly />
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
				<h4 class="panel-title">Tanda Jadi</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT tgl1 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT dp1 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Pembayaran Pelunasan</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>penjualan_cash/edit_data" method="post" name="formsentral">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 1</label>
									<input readonly type="text" class="form-control" name="tgl1" id="date1" required value="<?PHP $result=mysql_query("SELECT tgl2 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 1</label>
								<input readonly type="text" autocomplete="off" name="dp1" id="dp1" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 2</label>
									<input readonly type="text" class="form-control" name="tgl2" id="date2" required value="<?PHP $result=mysql_query("SELECT tgl3 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 2</label>
								<input readonly type="text" autocomplete="off" name="dp2" id="dp2" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 3</label>
									<input readonly type="text" class="form-control" name="tgl3" id="date3" required value="<?PHP $result=mysql_query("SELECT tgl4 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 3</label>
								<input readonly type="text" autocomplete="off" name="dp3" id="dp3" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 4</label>
									<input readonly type="text" class="form-control" name="tgl4" id="date44" required value="<?PHP $result=mysql_query("SELECT tgl5 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 4</label>
								<input readonly type="text" autocomplete="off" name="dp4" id="dp4" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 5</label>
									<input readonly type="text" class="form-control" name="tgl5" id="date5" required value="<?PHP $result=mysql_query("SELECT tgl6 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 5</label>
								<input readonly type="text" autocomplete="off" name="dp5" id="dp5" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
				</div>
				</form>
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
								<input type="text" autocomplete="off" name="" readonly class="form-control" value="<?PHP $result=mysql_query("SELECT nopo as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal PO </label>
								<input type="text" class="form-control" name="" readonly required value="<?PHP $result=mysql_query("SELECT tglpo as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
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
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan </label>
									<input type="text" class="form-control" name="tglpelunasan" id="date1" readonly required value="<?PHP $result=mysql_query("SELECT tgl_pelunasan as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pelunasan </label>
								<input readonly onClick="formatAngka(this, ',')" type="text" autocomplete="off" name="pelunasan" class="form-control" readonly value="<?PHP $result=mysql_query("SELECT sum(hsdiscount-totaldp) as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Refund Asuransi </label>
									<input type="text" class="form-control" name="tglasuransi" id="date2" readonly required value="<?PHP $result=mysql_query("SELECT tgl_asuransi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Asuransi </label>
								<input readonly onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="asuransi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_asuransi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Bunga </label>
									<input type="text" class="form-control" name="tglrefund" id="date3" readonly required value="<?PHP $result=mysql_query("SELECT tgl_refund as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Bunga </label>
								<input readonly onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="refund" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_refund as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Profisi </label>
									<input type="text" class="form-control" name="tglprofisi" id="date4" readonly required value="<?PHP $result=mysql_query("SELECT tgl_profisi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Profisi </label>
								<input readonly onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="profisi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_profisi as data from penjualan WHERE idpenjualan='".$idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
				</div>
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
<?PHP
	}
?>