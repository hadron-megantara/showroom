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
			<h2><i class="fa fa-dollar"></i> Pelunasan Kredit</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Pelunasan Kredit</li>
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
									<th>Pembeli</th>
									<th>Harga Jadi</th>
									<th>Tanggal SPK</th>
									<th>Nominal PO</th>
									<th>Tanggal PO</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idpenjualan,pembeli,hsdiscount,tanggalspk,nominalpo,tglpo,datediff(current_date(),
									tanggalspk) as selisih1,datediff(current_date(),tglpo) as selisih2,tgl_pelunasan,tgl_asuransi,tgl_refund,tgl_profisi
									FROM penjualan
									WHERE penjualan._deleted=0 AND tipebayar='Kredit' AND tglpo not like '0000-00-00'");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											if($row->tgl_pelunasan == '0000-00-00' || $row->tgl_asuransi == '0000-00-00' || $row->tgl_refund == '0000-00-00' || $row->tgl_profisi == '0000-00-00')
											{ 
								?>
								<tr>
									<td><?PHP echo $row->pembeli; ?></td>
									<td><?PHP echo number_format($row->hsdiscount); ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?> | <?PHP echo $row->selisih1; ?> Hari</td>
									<td><?PHP echo number_format($row->nominalpo); ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tglpo)); ?> | <?PHP echo $row->selisih2; ?> Hari</td>
									<td>
										<a href="<?PHP echo base_url() ?>pelunasan_leasing/deal/<?PHP echo $row->idpenjualan; ?>"<i class="fa fa-legal"></i></a>
									</td>
								</tr>
								<?PHP
											} else { }
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