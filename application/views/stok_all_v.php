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
			<h2><i class="fa fa-truck"></i> All</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">All</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="table-responsive">
			<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
			if ($level1['data'] == 4) { ?> 
			<button class="btn btn-info" id="keseluruhan2" onclick="blank_($(this)); return false;" url="stok_all/keseluruhan2"><i class="fa fa-print"></i> Stock Display Cabang</button>
			<?PHP } else {?>
			<button class="btn btn-info" id="keseluruhan2" onclick="blank_($(this)); return false;" url="stok_all/keseluruhan2"><i class="fa fa-print"></i> Stock Display Cabang</button>
			<button class="btn btn-primary" id="keseluruhan" onclick="blank_($(this)); return false;" url="stok_all/keseluruhan"><i class="fa fa-print"></i> Daftar Harga Modal</button>
			<?PHP }?>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
					if ($level1['data'] == 3 || $level1['data'] == 4) 
					{ 
					$bind=mysql_query("SELECT _cabang as data from user WHERE username='".$this->session->userdata("sm_username")."'");$bind1=mysql_fetch_assoc($bind);
					?> 
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Merk</th>
									<th>Tipe</th>
									<th>Tahun</th>
									<th>Warna</th>
									<th>No. Polisi</th>
									<th>Status</th>
									<th>Harga Modal</th>
									<th >Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("SELECT idmobil,status,_jenismobil.data as merk,tipemobil,nopol,warna,status,
									datediff(current_date(),tglbeli) as selisih,tglbeli,hawal,tahun,warna
											FROM mobil,_jenismobil
											WHERE mobil._jenismobil=_jenismobil.code AND mobil._deleted=0 AND mobil._cabang=".$bind1['data']." 
											ORDER BY merk ASC,tipemobil");
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
									<?PHP if($row->status == 'Tersedia') { ?>
										<td><span class="label label-primary"><?PHP echo $row->status; ?></span></td>
									<?PHP } else if($row->status == 'Terjual-Cash') { ?>
										<td><span class="label label-warning"><?PHP echo $row->status; ?></span></td>
									<?PHP } else if($row->status == 'Terjual-Kredit') { ?>
										<td><span class="label label-warning"><?PHP echo $row->status; ?></span></td>
									<?PHP } else { ?>
										<td><span class="label label-danger"><?PHP echo $row->status; ?></span></td>
									<?PHP } ?>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td align="center">
										<input type="hidden" value="<?PHP echo $row->idmobil; ?>" id="idmobil_<?PHP echo $row->idmobil; ?>" />
										<a href="<?PHP echo base_url() ?>stok_all/detail/<?PHP echo $row->idmobil; ?>" class="fa fa-search" style="text-decoration:none;color:blue"></a> &nbsp;
									</td>
								</tr>
								<?PHP
										$i++;}
									}
								?>
							</tbody>
						</table>
					<?PHP } else {?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Merk</th>
									<th>Tipe</th>
									<th>Tahun</th>
									<th>Warna</th>
									<th>No. Polisi</th>
									<th>Status</th>
									<th>Harga Modal</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("SELECT idmobil,status,_jenismobil.data as merk,tipemobil,nopol,warna,status,
									datediff(current_date(),tglbeli) as selisih,tglbeli,hawal,tahun,warna
											FROM mobil,_jenismobil
											WHERE mobil._jenismobil=_jenismobil.code AND mobil._deleted=0 ORDER BY merk ASC,tipemobil");
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
									<?PHP if($row->status == 'Tersedia') { ?>
										<td><span class="label label-primary"><?PHP echo $row->status; ?></span></td>
									<?PHP } else if($row->status == 'Terjual-Cash') { ?>
										<td><span class="label label-warning"><?PHP echo $row->status; ?></span></td>
									<?PHP } else if($row->status == 'Terjual-Kredit') { ?>
										<td><span class="label label-warning"><?PHP echo $row->status; ?></span></td>
									<?PHP } else { ?>
										<td><span class="label label-danger"><?PHP echo $row->status; ?></span></td>
									<?PHP } ?>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td align="center">
										<input type="hidden" value="<?PHP echo $row->idmobil; ?>" id="idmobil_<?PHP echo $row->idmobil; ?>" />
										<a href="<?PHP echo base_url() ?>stok_all/detail/<?PHP echo $row->idmobil; ?>" class="fa fa-search" style="text-decoration:none;color:blue"></a> &nbsp;
									</td>
								</tr>
								<?PHP
										$i++;}
									}
								?>
							</tbody>
						</table>
					<?PHP }?>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
    jQuery('#table-responsive').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
function blank_(obj){
		var url = $(obj).attr("url");
		window.open(url, '_blank');
		return false;
	}
</script>
<?PHP
	}
?>