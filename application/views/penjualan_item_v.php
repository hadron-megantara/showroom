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
	<link href="<?PHP echo base_url() ?>assets/css/jquery.datatables.css" rel="stylesheet">
	<script src="<?PHP echo base_url() ?>assets/js/jquery.datatables.min.js"></script>
	
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
					<li><a href="<?PHP echo base_url() ?>penjualan">Penjualan</a></li>
					<li class="active">Item</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Stok dan Daftar Harga Mobil</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Merk</th>
									<th>Tipe</th>
									<th>No. Polisi</th>
									<th>Warna</th>
									<th>Harga Jual</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idmobil,_jenismobil.data as merk,tipemobil,nopol,warna,hmax,hawal
									FROM mobil,_jenismobil
									WHERE mobil._jenismobil=_jenismobil.code  AND mobil._deleted=0 AND mobil.status='Tersedia'");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<form class="form-horizontal" role="form" method="post" action="<?PHP echo base_url() ?>penjualan/input_cart">
									<td><?PHP echo $row->merk; ?></td>
									<td><?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo $row->nopol; ?></td>
									<td><?PHP echo $row->warna; ?></td>
									<td>Rp. <?PHP echo number_format($row->hmax); ?></td>
									<td>
											<input type="hidden" value="<?PHP echo $row->hawal; ?>" name="chawal" />
											<input type="hidden" value="<?PHP echo $row->idmobil; ?>" name="cidmobil" />
											<input type="hidden" value="<?PHP echo $row->merk; ?>" name="cmerk" />
											<input type="hidden" value="<?PHP echo $row->tipemobil; ?>" name="ctipemobil" />
											<input type="hidden" value="<?PHP echo $row->nopol; ?>" name="cnopol" />
											<input type="hidden" value="<?PHP echo $row->warna; ?>" name="cwarna" />
											<input type="hidden" value="<?PHP echo $row->hmax; ?>" name="chmax" />
											<button type="submit" class="fa fa-plus"></button>
									</td>
									</form>
								</tr>
								<?PHP
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
    jQuery('#table-responsive').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
</script>
	<?PHP } else {?>
	<?PHP }?>
<?PHP
	}
?>