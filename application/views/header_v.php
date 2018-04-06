<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?PHP echo base_url() ?>assets/images/favicon.png" type="image/png">

  <title>SENTRAL GROUP</title>

  <link href="<?PHP echo base_url() ?>assets/css/style.default.css" rel="stylesheet">
</head>
<body>
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>
  <div class="leftpanel">
    <div class="logopanel">
        <h1><span>[</span> SENTRAL<span>]</span></h1>
    </div>
    <div class="leftpanelinner">    
      <h5 class="sidebartitle">Menu</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li <?PHP if($this->uri->segment(1) == "home") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>home"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li <?PHP if($this->uri->segment(1) == "angsurantdp") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "angsuran") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "tdp") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "upping_otr") { echo ' class="nav-parent active"'; }  else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-cog"></i> <span>Calculator Angsuran</span></a>
			<ul class="children">
					<li <?PHP if($this->uri->segment(1) == "angsurantdp") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>angsurantdp"><i class="fa fa-caret-right"></i> Angsuran, TDP ?</a></li>
					<li <?PHP if($this->uri->segment(1) == "angsuran") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>angsuran"><i class="fa fa-caret-right"></i> Angsuran ?</a></li>
					<li <?PHP if($this->uri->segment(1) == "tdp") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>tdp"><i class="fa fa-caret-right"></i> TDP ?</a></li>
					<li <?PHP if($this->uri->segment(1) == "upping_otr") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>upping_otr"><i class="fa fa-caret-right"></i> Upping OTR</a></li>
			</ul>
        </li>
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 1 || $level1['data'] == 6) { ?> 
		<li <?PHP if($this->uri->segment(1) == "penjualan") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "batal_penjualan") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "rekap_spk") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "peminjaman") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-book"></i> <span>Transaksi</span></a>
			<ul class="children">
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 6) { ?> 
					<li <?PHP if($this->uri->segment(1) == "penjualan") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>penjualan"><i class="fa fa-caret-right"></i> Penjualan</a></li>
					<li <?PHP if($this->uri->segment(1) == "batal_penjualan") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>batal_penjualan"><i class="fa fa-caret-right"></i> Cancel Penjualan</a></li>
					<li <?PHP if($this->uri->segment(1) == "rekap_spk") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>rekap_spk"><i class="fa fa-caret-right"></i> Proses Kredit</a></li>				
				<?PHP } else {?>
				<?PHP }?>
			</ul>
        </li>
		<?PHP } else {?>
		<?PHP }?>
		
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 1 || $level1['data'] == 6) { ?> 
        <li <?PHP if($this->uri->segment(1) == "penjualan_cash") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "penjualan_kredit") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "pelunasan_leasing") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-dollar"></i> <span>Pelunasan</span></a>
			<ul class="children">
				<li <?PHP if($this->uri->segment(1) == "penjualan_cash") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>penjualan_cash"><i class="fa fa-caret-right"></i> Pelunasan Cash</a></li>
				<li <?PHP if($this->uri->segment(1) == "penjualan_kredit") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>penjualan_kredit"><i class="fa fa-caret-right"></i> Pelunasan DP</a></li>
				<li <?PHP if($this->uri->segment(1) == "pelunasan_leasing") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>pelunasan_leasing"><i class="fa fa-caret-right"></i> Pelunasan Kredit</a></li>
			</ul>
        </li>
		<?PHP } else {?>
		<?PHP }?>
        <li <?PHP if($this->uri->segment(1) == "rekapan_spk") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "rekapan_proses") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "rekapan_omset") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "rekapan_group") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "report_spk") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "report_omset") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "rekapan_cancel") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-print"></i> <span>Rekapan Penjualan</span></a>
			<ul class="children">
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1) { ?> 
				<li <?PHP if($this->uri->segment(1) == "portfolio_penjualan") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>portfolio_penjualan"><i class="fa fa-caret-right"></i> Portfolio Penjualan</a></li>
				<?PHP } else { }?>
				
				<li <?PHP if($this->uri->segment(1) == "rekapan_spk") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>rekapan_spk"><i class="fa fa-caret-right"></i> Detail SPK</a></li>
				<li <?PHP if($this->uri->segment(1) == "rekapan_proses") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>rekapan_proses"><i class="fa fa-caret-right"></i> Detail Proses</a></li>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 6 || $level1['data'] == 3) { ?> 
				<li <?PHP if($this->uri->segment(1) == "rekapan_omset") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>rekapan_omset"><i class="fa fa-caret-right"></i> Detail Omset</a></li>
				<li <?PHP if($this->uri->segment(1) == "rekapan_cancel") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>rekapan_cancel"><i class="fa fa-caret-right"></i> Rekapan Cancel</a></li>
				<?PHP } else { }?>
				<li <?PHP if($this->uri->segment(1) == "report_spk") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>report_spk"><i class="fa fa-caret-right"></i> Report SPK</a></li>
				<li <?PHP if($this->uri->segment(1) == "report_omset") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>report_omset"><i class="fa fa-caret-right"></i> Report Omset</a></li>
			</ul>
        </li>
        <li <?PHP if($this->uri->segment(1) == "stok_all") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "stok_display") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "stok_ho") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-truck"></i> <span>Mobil</span></a>
			<ul class="children">
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] != 4) { ?> 
				<li <?PHP if($this->uri->segment(1) == "stok_all") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>stok_all"><i class="fa fa-caret-right"></i> All</a></li>
				<?PHP } else { }?>
				
				<li <?PHP if($this->uri->segment(1) == "stok_display") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>stok_display"><i class="fa fa-caret-right"></i> Stok Display</a></li>
				<li <?PHP if($this->uri->segment(1) == "stok_ho") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>stok_ho"><i class="fa fa-caret-right"></i> Stok HO</a></li>
			</ul>
        </li>
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8 || $level1['data'] == 3 || $level1['data'] == 6) { ?> 
        <li <?PHP if($this->uri->segment(1) == "laba_cabang") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "buku_besar") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "laba_ho") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "laba_jurnal") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "laba_neraca") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-tasks"></i> <span>Laba Rugi</span></a>
			<ul class="children">
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8 || $level1['data'] == 3) { ?> 
				<li <?PHP if($this->uri->segment(1) == "laba_cabang") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>laba_cabang"><i class="fa fa-caret-right"></i> Cabang</a></li>
				<?PHP } else { }?>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8) { ?> 
				<li <?PHP if($this->uri->segment(1) == "laba_ho") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>laba_ho"><i class="fa fa-caret-right"></i> HO</a></li>
				<?PHP } else { }?>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8 || $level1['data'] == 3) { ?> 
				<li <?PHP if($this->uri->segment(1) == "laba_jurnal") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>laba_jurnal"><i class="fa fa-caret-right"></i> Jurnal</a></li>
				<?PHP } else { }?>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8) { ?> 
				<li <?PHP if($this->uri->segment(1) == "laba_neraca") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>laba_neraca"><i class="fa fa-caret-right"></i> Neraca</a></li>
				<?PHP } else { }?>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8) { ?> 
				<li <?PHP if($this->uri->segment(1) == "buku_besar") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>buku_besar"><i class="fa fa-caret-right"></i> Buku Besar</a></li>
				<?PHP } else { }?>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1) { ?> 
					<li <?PHP if($this->uri->segment(1) == "peminjaman") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>peminjaman"><i class="fa fa-caret-right"></i> Peminjaman</a></li>
				<?PHP } else { }?>
			</ul>
        </li>
		<?PHP } else { }?>
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 1 || $level1['data'] == 3) { ?> 
        <li <?PHP if($this->uri->segment(1) == "user") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "karyawan") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "supplier") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "pembeli") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-users"></i> <span>Member</span></a>
			<ul class="children">
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1 || $level1['data'] == 3) { ?> 
				<li <?PHP if($this->uri->segment(1) == "karyawan") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>karyawan"><i class="fa fa-caret-right"></i> Karyawan</a></li>
				<?PHP } ?>
				<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
				if ($level1['data'] == 1) { ?> 
				<li <?PHP if($this->uri->segment(1) == "user") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>user"><i class="fa fa-caret-right"></i> User</a></li>
				<li <?PHP if($this->uri->segment(1) == "supplier") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>supplier"><i class="fa fa-caret-right"></i> Supplier</a></li>
				<li <?PHP if($this->uri->segment(1) == "pembeli") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>pembeli"><i class="fa fa-caret-right"></i> Pembeli</a></li>
				<?PHP } ?>
			</ul>
        </li>
		<?PHP } else { }?>
		
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 5) { ?> 
        <li <?PHP if($this->uri->segment(1) == "user") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "karyawan") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "supplier") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "pembeli") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?> ><a href="#"><i class="fa fa-users"></i> <span>Member</span></a>
			<ul class="children">
				<li <?PHP if($this->uri->segment(1) == "supplier") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>supplier"><i class="fa fa-caret-right"></i> Supplier</a></li>
			</ul>
        </li>
		<?PHP } else { }?>
		
        <li <?PHP if($this->uri->segment(1) == "detail_penjualan") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "detail_aktifitas") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "detail_peminjaman") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?>><a href="#"><i class="fa fa-hdd-o"></i> <span>Detail</span></a>
			<ul class="children">
				<?PHP $levels=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$levels1=mysql_fetch_assoc($levels);
				if ($levels1['data'] == 1) { ?> 
				<li <?PHP if($this->uri->segment(1) == "detail_aktifitas") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>detail_aktifitas"><i class="fa fa-caret-right"></i> Detail Aktifitas</a></li>
				<?PHP } else { }?>
				<?PHP $levels=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$levels1=mysql_fetch_assoc($levels);
				if ($levels1['data'] == 1 || $levels1['data'] == 3) { ?> 
				<li <?PHP if($this->uri->segment(1) == "detail_peminjaman") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>detail_peminjaman"><i class="fa fa-caret-right"></i> Detail Peminjaman</a></li>
				<?PHP } else {?>
				<?PHP }?>
				<li <?PHP if($this->uri->segment(1) == "detail_penjualan") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>detail_penjualan"><i class="fa fa-caret-right"></i> Detail Penjualan</a></li>
			</ul>
        </li>
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 1) { ?> 
		<li <?PHP if($this->uri->segment(1) == "cabang") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "jenis_mobil") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "via_kredit") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "neraca") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "target") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?>><a href="#"><i class="fa fa-wrench"></i> <span>Pengaturan</span></a>
			<ul class="children">
				<li <?PHP if($this->uri->segment(1) == "cabang") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>cabang"><i class="fa fa-caret-right"></i> Cabang</a></li>
				<li <?PHP if($this->uri->segment(1) == "jenis_mobil") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>jenis_mobil"><i class="fa fa-caret-right"></i> Jenis Mobil</a></li>
				<li <?PHP if($this->uri->segment(1) == "via_kredit") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>via_kredit"><i class="fa fa-caret-right"></i> Via Kredit</a></li>
				<li <?PHP if($this->uri->segment(1) == "neraca") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>neraca"><i class="fa fa-caret-right"></i> Neraca</a></li>
				<li <?PHP if($this->uri->segment(1) == "target") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>target"><i class="fa fa-caret-right"></i> Target</a></li>
			</ul>
        </li>
		<?PHP } else {?>
		<?PHP }?>
		
		<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
		if ($level1['data'] == 5) { ?> 
		<li <?PHP if($this->uri->segment(1) == "cabang") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "jenis_mobil") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "via_kredit") { echo ' class="nav-parent active"'; } else if($this->uri->segment(1) == "neraca") { echo ' class="nav-parent active"'; } else { echo ' class="nav-parent"'; }?>><a href="#"><i class="fa fa-wrench"></i> <span>Pengaturan</span></a>
			<ul class="children">
				<li <?PHP if($this->uri->segment(1) == "jenis_mobil") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>jenis_mobil"><i class="fa fa-caret-right"></i> Jenis Mobil</a></li>
			</ul>
        </li>
		<?PHP } else {?>
		<?PHP }?>
		
        <li <?PHP if($this->uri->segment(1) == "ubah_password") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>ubah_password"><i class="fa fa-cogs"></i> <span>Ubah Password</span></a></li>
        <li <?PHP if($this->uri->segment(1) == "login/logout") { echo ' class="active"'; } ?>><a href="<?PHP echo base_url() ?>login/logout"><i class="fa fa-unlock"></i> <span>Log Out</span></a></li>
      </ul>
    </div>
  </div>
</section>
<script src="<?PHP echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/toggles.min.js"></script>
<script src="<?PHP echo base_url() ?>assets/js/custom.js"></script>
</body>
</html>