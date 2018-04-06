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
	if ($level1['data'] == 1 || $level1['data'] == 5) { ?> 
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
			<h2><i class="fa fa-users"></i> Supplier</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Supplier</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<button class="btn btn-primary" onClick="parent.location='<?PHP echo base_url(); ?>supplier/tambah_supplier'"><i class="fa fa-plus"></i> Tambah Supplier</button>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Telepon</th>
									<th>Modified</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idsupplier,supplier.nama,telp,user.nama as updated
									FROM supplier,user
									WHERE supplier.updated=user.username AND supplier._deleted=0");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo $row->telp; ?></td>
									<td><?PHP echo $row->updated; ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>supplier/detail/<?PHP echo $row->idsupplier; ?>"><i class="fa fa-search"></i></a> &nbsp;
										<a href="<?PHP echo base_url() ?>supplier/edit/<?PHP echo $row->idsupplier; ?>"><i class="fa fa-pencil"></i></a>
									</td>
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