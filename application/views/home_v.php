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
	<div class="mainpanel">
		<div class="headerbar">
		  <a class="menutoggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="pageheader">
			<h2><i class="fa fa-home"></i> Home</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li class="active">Home</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="col-sm-6 col-md-6">
				<div class="panel panel-default panel-alt widget-messaging">
				    <div class="panel-heading">
						<h3 class="panel-title">Aktifitas Terbaru</h3>
					</div>
					<div class="panel-body">
						<ul>
						<?PHP
							$query = $this->db->query("SELECT user.nama as username,aktifitas,tanggal,jam,tipe FROM log_user,user WHERE user.username=log_user.username AND _deleted=0 ORDER BY id DESC LIMIT 5");
							foreach($query->result() as $row) :
						?>
							<li>
							  <small class="pull-right"><?PHP echo $row->tanggal; ?> - <?PHP echo $row->jam; ?></small>
							  <h4 class="sender"><?PHP echo $row->username; ?></h4>
							  <small>
							  <b><?PHP if($row->tipe == 0){ ?>Tambah <?PHP } else if ($row->tipe == 1) {?> Edit <?PHP } else {?> Hapus <?PHP } ?></b>
							  -<?PHP echo $row->aktifitas; ?></small>
							</li>
						<?PHP
							endforeach;
						?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
			    <div class="panel panel-default">
					<div class="panel-body">
					    <div class="row">
							<div class="col-sm-12">
							    <h5 class="subtitle mb5">Satus Aplikasi</h5>
							    <p class="mb15">Summary of the status of your server.</p>
								
							    <span class="sublabel">Data Penjualan (<?PHP $result=mysql_query("SELECT count(*) as data from penjualan");$data=mysql_fetch_assoc($result);echo number_format($data['data']); ?> - 10,000,000)</span>
							    <div class="progress progress-sm">
									<div style="width:<?PHP $result=mysql_query("SELECT count(*) as data from penjualan Where _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data']/100000; ?>%" role="progressbar" class="progress-bar progress-bar-primary"></div>
							    </div>
								
							    <span class="sublabel">Data Mobil (<?PHP $result=mysql_query("SELECT count(*) as data from mobil");$data=mysql_fetch_assoc($result);echo number_format($data['data']); ?> - 10,000,000)</span>
							    <div class="progress progress-sm">
									<div style="width:<?PHP $result=mysql_query("SELECT count(*) as data from mobil Where _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data']/100000; ?>%" role="progressbar" class="progress-bar progress-bar-success"></div>
							    </div>
								
							    <span class="sublabel">Data Aktifitas User (<?PHP $result=mysql_query("SELECT count(*) as data from log_user");$data=mysql_fetch_assoc($result);echo number_format($data['data']); ?> - 10,000,000)</span>
							    <div class="progress progress-sm">
									<div style="width:<?PHP $result=mysql_query("SELECT count(*) as data from log_user");$data=mysql_fetch_assoc($result);echo $data['data']/100000; ?>%" role="progressbar" class="progress-bar progress-bar-danger"></div>
							    </div>
								
							    <span class="sublabel">Data Jurnal (<?PHP $result=mysql_query("SELECT count(*) as data from laba_rugi");$data=mysql_fetch_assoc($result);echo number_format($data['data']); ?> - 10,000,000)</span>
							    <div class="progress progress-sm">
									<div style="width:<?PHP $result=mysql_query("SELECT count(*) as data from laba_rugi");$data=mysql_fetch_assoc($result);echo $data['data']/100000; ?>%" role="progressbar" class="progress-bar progress-bar-warning"></div>
							    </div>
								
							</div>
					    </div>
					</div>
			    </div>
			</div>
		</div>
		<div class="contentpanel">
			<div class="col-sm-3">
				<div class="panel panel-default panel-alt widget-messaging">
				    <div class="panel-heading">
						<h3 class="panel-title">Export Excel</h3>
					</div>
					<div class="panel-body" align="center">
					<br>
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
						if ($level1['data'] == 4) { ?> 
						<button style="width:100%" class="btn btn-info" id="keseluruhan2" onclick="blank_($(this)); return false;" url="stok_all/keseluruhan2"><i class="fa fa-print"></i> Stock Display Cabang</button>
					<br>
					<br>
						<?PHP } else {?>
						<button style="width:100%"  class="btn btn-info" id="keseluruhan2" onclick="blank_($(this)); return false;" url="stok_all/keseluruhan2"><i class="fa fa-print"></i> Stock Display Cabang</button>
					<br>
					<br>
						<button style="width:100%"  class="btn btn-primary" id="keseluruhan" onclick="blank_($(this)); return false;" url="stok_all/keseluruhan"><i class="fa fa-print"></i> Daftar Harga Modal</button>
					<br>
					<br>
						<?PHP }?>
						<button style="width:100%"  class="btn btn-danger" id="all" onclick="blank_($(this)); return false;" url="rekapan_proses/all"><i class="fa fa-print"></i> Semua Proses</button>
					<br>
					<br>
						<button style="width:100%"  class="btn btn-info" id="cash" onclick="blank_($(this)); return false;" url="rekapan_proses/cash"><i class="fa fa-print"></i> Proses Cash</button>
					<br>
					<br>
						<button style="width:100%"  class="btn btn-warning" id="spo" onclick="blank_($(this)); return false;" url="rekapan_proses/spo"><i class="fa fa-print"></i> Proses Sudah PO</button>
					<br>
					<br>
						<button style="width:100%"  class="btn btn-primary" id="bpo" onclick="blank_($(this)); return false;" url="rekapan_proses/bpo"><i class="fa fa-print"></i> Proses Belum PO</button>
					<br>	
					<?PHP if ($level1['data'] == 1) { ?> 
					<!--<br>	
						<a href="home/backup_sql" style="width:100%" class="btn btn-info">Backup Database</a>
					<br>-->
					<?PHP } ?>
					<br>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
function blank_(obj){
		var url = $(obj).attr("url");
		window.open(url, '_blank');
		return false;
	}
</script>
<?PHP
	}
?>