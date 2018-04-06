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
	<link href="<?PHP echo base_url() ?>assets/css/jquery.datatables.css" rel="stylesheet">
	<script src="<?PHP echo base_url() ?>assets/js/jquery.datatables.min.js"></script>
	
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
					<li class="active">Stok Display</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
			if ($level1['data'] == 1 || $level1['data'] == 5) { ?> 
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>stok_display/tambah_mobil'"><i class="fa fa-plus"></i> Pembelian Mobil</button>
			<br><br>
			<?PHP } else { }?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Merk</th>
									<th>Tipe</th>
									<th>Tahun</th>
									<th>Warna</th>
									<th>No. Polisi</th>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] != 4) { ?> 
									<th>Harga Modal</th>
									<?PHP } ?>
									<th>Harga Kredit</th>
									<th>Harga Cash</th>
									<th>Harga Saran</th>
									<th>Cabang</th>
									<th>Tgl Masuk</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("SELECT idmobil,_jenismobil.data as merk,tipemobil,nopol,warna,status,tahun,warna,
									datediff(current_date(),tglbeli)/30 as selisih,tglbeli,hawal,hmax,hcash,hkredit,_cabang.data as cabang
											FROM mobil,_jenismobil,_cabang
											WHERE mobil._jenismobil=_jenismobil.code AND mobil._deleted=0 AND mobil._cabang=_cabang.code 
											AND status='Tersedia' ORDER BY merk ASC,tipemobil");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $i; ?></td>
									<td><?PHP echo $row->merk; ?></td>
									<td><?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo $row->tahun; ?></td>
									<td><?PHP echo $row->warna; ?></td>
									<td><?PHP echo $row->nopol; ?></td>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] != 4) { ?> 
									<td align="right"><?PHP echo number_format($row->hawal); ?></td>
									<?PHP } ?>
									<td align="right"><?PHP echo number_format($row->hkredit); ?></td>
									<td align="right"><?PHP echo number_format($row->hcash); ?></td>
									<td align="right"><?PHP echo number_format($row->hmax); ?></td>
									<td><?PHP echo $row->cabang; ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?> | <?PHP echo ceil($row->selisih); ?> Bulan</td>
									<td align="center">
										<input type="hidden" value="<?PHP echo $row->idmobil; ?>" id="idmobil_<?PHP echo $row->idmobil; ?>" />
										<input type="hidden" value="<?PHP echo $row->nopol; ?>" id="nopol_<?PHP echo $row->idmobil; ?>" />
										<a href="<?PHP echo base_url() ?>stok_display/detail/<?PHP echo $row->idmobil; ?>" class="fa fa-search" style="text-decoration:none;color:blue"></a> &nbsp;
										<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
										if ($level1['data'] == 1 || $level1['data'] == 5) { ?> 
											<a href="<?PHP echo base_url() ?>stok_display/edit/<?PHP echo $row->idmobil; ?>" class="fa fa-pencil" style="text-decoration:none;color:green"></a>
										<?PHP } else { }?>
									</td>
								</tr>
								<?PHP
										$i++;}
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
<?PHP
	}
?>