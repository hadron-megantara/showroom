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
			<h2><i class="fa fa-truck"></i> Terjual Lunas</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Terjual Lunas</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
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
									<th width="23%">Merk</th>
									<th width="23%">Tipe</th>
									<th width="15%">No. Polisi</th>
									<th width="19%">Pembeli</th>
									<th width="15%">Tgl SPK</th>
									<th width="5%">Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idmobil,_jenismobil.data as merk,tipemobil,nopol,warna,status,tglspk,penjualan.pembeli as pembeli
											FROM mobil,_jenismobil,penjualan
											WHERE mobil._jenismobil=_jenismobil.code AND mobil._deleted=0 AND status='Sold Out' AND 
											mobil.idpenjualan=penjualan.idpenjualan AND penjualan._cabang=".$bind1['data']." ORDER BY merk ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->merk; ?></td>
									<td><?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo $row->nopol; ?></td>
									<td><?PHP echo $row->pembeli; ?></td>
									<td><?PHP echo $row->tglspk; ?></td>
									<td align="center">
										<input type="hidden" value="<?PHP echo $row->idmobil; ?>" id="idmobil_<?PHP echo $row->idmobil; ?>" />
										<a href="<?PHP echo base_url() ?>terjual_lunas/detail/<?PHP echo $row->idmobil; ?>" class="fa fa-search" style="text-decoration:none;color:blue"></a> &nbsp;
									</td>
								</tr>
								<?PHP
										}
									}
								?>
							</tbody>
						</table>
					<?PHP } else {?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th width="23%">Merk</th>
									<th width="23%">Tipe</th>
									<th width="15%">No. Polisi</th>
									<th width="19%">Pembeli</th>
									<th width="15%">Tgl SPK</th>
									<th width="5%">Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idmobil,_jenismobil.data as merk,tipemobil,nopol,warna,status,tglspk,penjualan.pembeli as pembeli
											FROM mobil,_jenismobil,penjualan
											WHERE mobil._jenismobil=_jenismobil.code AND mobil._deleted=0 AND status='Sold Out' AND mobil.idpenjualan=penjualan.idpenjualan ORDER BY merk ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->merk; ?></td>
									<td><?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo $row->nopol; ?></td>
									<td><?PHP echo $row->pembeli; ?></td>
									<td><?PHP echo $row->tglspk; ?></td>
									<td align="center">
										<input type="hidden" value="<?PHP echo $row->idmobil; ?>" id="idmobil_<?PHP echo $row->idmobil; ?>" />
										<a href="<?PHP echo base_url() ?>terjual_lunas/detail/<?PHP echo $row->idmobil; ?>" class="fa fa-search" style="text-decoration:none;color:blue"></a> &nbsp;
									</td>
								</tr>
								<?PHP
										}
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
</script>
<?PHP
	}
?>