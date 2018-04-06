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
			<h2><i class="fa fa-dollar"></i> Pelunasan Cash</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Pelunasan Cash</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No. Urut</th>
									<th>No. Reg</th>
									<th>Tanggal SPK</th>
									<th>Nama Pembeli</th>
									<th>Harga Jual</th>
									<th>Pelunasan</th>
									<th>Sisa AR</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idpenjualan,pembeli,hsdiscount,hargajual,tanggalspk,datediff(current_date(),tanggalspk) as selisih
									FROM penjualan
									WHERE tipebayar='Cash' AND _deleted=0");
									$i = 0;
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$data=mysql_fetch_assoc($result);
									  if ($row->hsdiscount == $data['data']) { } else { if($i++ == 0) ?>
								<tr>
									<td><?PHP echo $i; ?></td>
									<td><?PHP echo $row->idpenjualan; ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?> | <?PHP echo $row->selisih; ?> Hari</td>
									<td><?PHP echo $row->pembeli; ?></td>
									<td><?PHP echo number_format($row->hsdiscount); ?></td>
									<td><?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$data=mysql_fetch_assoc($result);echo number_format($data['data']);?></td>
									<td><?PHP $result=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$data=mysql_fetch_assoc($result); echo number_format($row->hsdiscount-$data['data']); ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>penjualan_cash/deal/<?PHP echo $row->idpenjualan; ?>" class="fa fa-legal" style="text-decoration:none"></a>
									</td>
								</tr>
								<?PHP }  ?>
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