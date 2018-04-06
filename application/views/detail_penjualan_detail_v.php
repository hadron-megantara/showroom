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
			<h2><i class="fa fa-hdd-o"></i> Detail Penjualan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Penjualan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<?PHP 
			$result=mysql_query("SELECT tipebayar as data from penjualan WHERE idpenjualan='".$iddata."'");
			$data=mysql_fetch_assoc($result);
			if($data['data'] == "Cash") {
		?>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Penjualan</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">No. Reg</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP echo $iddata; ?>" readonly />
							</div>
						</div>
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
						if ($level1['data'] != 4) { ?> 
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Total Harga</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT totalharga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
						<?PHP } ?>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pembeli</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT pembeli as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Jual</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT hargajual as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Telepon</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT telepon as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Discount</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT discount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alamat</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT alamat as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Setelah Discount</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT hsdiscount as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$hsdiscount=$data['data']?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tipe Unit</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT tipebarang as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Jumlah Bayar</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$jbayar=$data['data']?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal SPK</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT tanggalspk as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Sisa AR</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP echo number_format($hsdiscount-$jbayar);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Cabang</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT _cabang.data as data from penjualan,_cabang WHERE penjualan._cabang=_cabang.code AND idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Banyak</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT count(*) as data from detail_penjualan WHERE d_idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?> Unit" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Input</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT entry as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Modified</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT user.nama as data from penjualan,user WHERE penjualan.updated=user.username AND idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
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
				<h4 class="panel-title">Tanda Jadi</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT tgl1 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT dp1 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
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
								<input readonly type="text" autocomplete="off" name="dp1" id="dp1" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input readonly type="text" autocomplete="off" name="dp2" id="dp2" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input readonly type="text" autocomplete="off" name="dp3" id="dp3" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 4</label>
									<input readonly type="text" class="form-control" name="tgl4" id="date44" required value="<?PHP $result=mysql_query("SELECT tgl5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 4</label>
								<input readonly type="text" autocomplete="off" name="dp4" id="dp4" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input readonly type="text" autocomplete="off" name="dp5" id="dp5" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		<?PHP 
			} else {
		?>
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
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
						if ($level1['data'] != 4) { ?> 
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Total Harga</label>
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT totalharga as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" readonly />
							</div>
						</div>
						<?PHP } ?>
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
								<input type="text" autocomplete="off" name="nomormobil" class="form-control" value="<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);$jbayar=$data['data']?>" readonly />
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
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Pembayaran Pelunasan</h4>
				</div>
				<form id="basicForm" action="<?PHP echo base_url() ?>penjualan_kredit/edit_data" method="post" name="formsentral">
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
								<input readonly type="text" autocomplete="off" name="dp1" id="dp1" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp2 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input readonly type="text" autocomplete="off" name="dp2" id="dp2" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp3 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input readonly type="text" autocomplete="off" name="dp3" id="dp3" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp4 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Pelunasan 4</label>
									<input readonly type="text" class="form-control" name="tgl4" id="date44" required value="<?PHP $result=mysql_query("SELECT tgl5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal Pelunasan 4</label>
								<input readonly type="text" autocomplete="off" name="dp4" id="dp4" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp5 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input readonly type="text" autocomplete="off" name="dp5" id="dp5" class="form-control" required value="<?PHP $result=mysql_query("SELECT dp6 as data from detail_tunai WHERE iddtunai='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" onkeyup="formatAngka(this, ',');HitungTotal()" />
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
								<input type="text" autocomplete="off" name="" readonly class="form-control" value="<?PHP $result=mysql_query("SELECT nopo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal PO </label>
								<input type="text" class="form-control" name="" readonly required value="<?PHP $result=mysql_query("SELECT tglpo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nominal PO</label>
								<input type="text" autocomplete="off" name="" readonly class="form-control" value="<?PHP $result=mysql_query("SELECT nominalpo as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
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
								<label class="control-label">Tanggal Pelunasan </label>
									<input type="text" class="form-control" name="tglpelunasan" id="date1" readonly required value="<?PHP $result=mysql_query("SELECT tgl_pelunasan as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Pelunasan </label>
								<input readonly onClick="formatAngka(this, ',')" type="text" autocomplete="off" name="pelunasan" class="form-control" readonly value="<?PHP $result=mysql_query("SELECT sum(hsdiscount-totaldp) as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Refund Asuransi </label>
									<input type="text" class="form-control" name="tglasuransi" id="date2" readonly required value="<?PHP $result=mysql_query("SELECT tgl_asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Asuransi </label>
								<input readonly onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="asuransi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_asuransi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Bunga </label>
									<input type="text" class="form-control" name="tglrefund" id="date3" readonly required value="<?PHP $result=mysql_query("SELECT tgl_refund as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Bunga </label>
								<input readonly onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="refund" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_refund as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Tanggal Profisi </label>
									<input type="text" class="form-control" name="tglprofisi" id="date4" readonly required value="<?PHP $result=mysql_query("SELECT tgl_profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Profisi </label>
								<input readonly onkeyup="formatAngka(this, ',')" type="text" autocomplete="off" name="profisi" class="form-control" required value="<?PHP $result=mysql_query("SELECT p_profisi as data from penjualan WHERE idpenjualan='".$iddata."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?>" />
							</div>
						</div>
					</div>
				</div>
			</div>
		<?PHP 
			} 
		?>
		</div>
	</div>
<?PHP
	}
?>