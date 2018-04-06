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
									<th>No. Reg</th>
									<th>Tanggal SPK</th>
									<th>Nama Pembeli</th>
									<th>Tipe Bayar</th>
									<th>Status</th>
									<th>Harga Terjual</th>
									<th>Cabang</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idpenjualan,pembeli,tipebayar,hsdiscount,tanggalspk,_cabang.data as cabang,penjualan._deleted as deleted
									FROM penjualan,_cabang
									WHERE penjualan._cabang=_cabang.code AND penjualan._cabang=".$bind1['data']." ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->idpenjualan; ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)) ?></td>
									<td><?PHP echo $row->pembeli; ?></td>
									<?PHP if($row->tipebayar == 'Cash') { ?>
									<td><span class="label label-success">Cash</span></td>
									<?PHP } else {?>
									<td><span class="label label-primary">Kredit</span></td>
									<?PHP }?>
									
									<?PHP if($row->deleted == 0) { ?>
									<td><span class="label label-success">Deal</span></td>
									<?PHP } else if($row->deleted == 1) {?>
									<td><span class="label label-danger">Batal</span></td>
									<?PHP } else {?>
									<td><span class="label label-danger">Reject</span></td>
									<?PHP }?>
									
									<td><?PHP echo number_format($row->hsdiscount); ?></td>
									<td><?PHP echo $row->cabang; ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a>
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
									<th>No. Reg</th>
									<th>Tanggal SPK</th>
									<th>Nama Pembeli</th>
									<th>Tipe Bayar</th>
									<th>Status</th>
									<th>Harga Terjual</th>
									<th>Cabang</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idpenjualan,pembeli,tipebayar,hsdiscount,tanggalspk,_cabang.data as cabang,penjualan._deleted as deleted
									FROM penjualan,_cabang
									WHERE penjualan._cabang=_cabang.code ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->idpenjualan; ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td><?PHP echo $row->pembeli; ?></td>
									<?PHP if($row->tipebayar == 'Cash') { ?>
									<td><span class="label label-success">Cash</span></td>
									<?PHP } else {?>
									<td><span class="label label-primary">Kredit</span></td>
									<?PHP }?>
									
									<?PHP if($row->deleted == 0) { ?>
									<td><span class="label label-success">Deal</span></td>
									<?PHP } else if($row->deleted == 1) {?>
									<td><span class="label label-danger">Batal</span></td>
									<?PHP } else {?>
									<td><span class="label label-danger">Reject</span></td>
									<?PHP }?>
									
									<td><?PHP echo number_format($row->hsdiscount); ?></td>
									<td><?PHP echo $row->cabang; ?></td>
									<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a> &nbsp;
										<a href="<?PHP echo base_url() ?>detail_penjualan/edit/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-pencil"></i></a></td>
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