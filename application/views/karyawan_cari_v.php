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
	if ($level1['data'] == 1 || $level1['data'] == 3) { ?> 
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
			<h2><i class="fa fa-users"></i> Karyawan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Karyawan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
					<?PHP if($this->input->post("cabang") == "0") { ?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Gender</th>
									<th>Jabatan</th>
									<th>Cabang</th>
									<th>Mulai Kerja</th>
									<th>Status</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
								$i=1;
									$query = $this->db->query("SELECT idkaryawan,nama,telp,gender,jabatan,_cabang.data as cabang,mulaikerja,karyawan._deleted as deleted
									FROM karyawan,_cabang
									WHERE karyawan._cabang=_cabang.code
									ORDER BY nama ASC,gender");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $i; ?></td>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo $row->gender; ?></td>
									<td><?PHP echo $row->jabatan; ?></td>
									<td><?PHP echo $row->cabang; ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->mulaikerja)); ?></td>
									<?PHP if($row->deleted == 0) { ?>
										<td><span class="label label-primary">AKTIF</span></td>
									<?PHP } else { ?>
										<td><span class="label label-danger">TIDAK</span></td>
									<?PHP } ?>
									<td>
										<a href="<?PHP echo base_url() ?>karyawan/detail/<?PHP echo $row->idkaryawan; ?>"><i class="fa fa-search"></i></a> &nbsp;
										<a href="<?PHP echo base_url() ?>karyawan/edit/<?PHP echo $row->idkaryawan; ?>"><i class="fa fa-pencil"></i></a>
									</td>
								</tr>
								<?PHP
										$i++; }
									}
								?>
							</tbody>
						</table>
					<?PHP } else { ?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Gender</th>
									<th>Jabatan</th>
									<th>Cabang</th>
									<th>Mulai Kerja</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
								$i=1;
									$query = $this->db->query("SELECT idkaryawan,nama,telp,gender,jabatan,_cabang.data as cabang,datediff(current_date(),mulaikerja) as selisih,mulaikerja
									FROM karyawan,_cabang
									WHERE karyawan._cabang=_cabang.code AND karyawan._deleted=0 AND karyawan._cabang='".$this->input->post("cabang")."'
									ORDER BY nama ASC,gender");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $i; ?></td>
									<td><?PHP echo $row->nama; ?></td>
									<td><?PHP echo $row->gender; ?></td>
									<td><?PHP echo $row->jabatan; ?></td>
									<td><?PHP echo $row->cabang; ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->mulaikerja)); ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>karyawan/detail/<?PHP echo $row->idkaryawan; ?>"><i class="fa fa-search"></i></a> &nbsp;
										
										<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
										if ($level1['data'] == 1) { ?> 
										<a href="<?PHP echo base_url() ?>karyawan/edit/<?PHP echo $row->idkaryawan; ?>"><i class="fa fa-pencil"></i></a>
										<?PHP } ?>
									</td>
								</tr>
								<?PHP
										$i++; }
									}
								?>
							</tbody>
						</table>
					<?PHP } ?>
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