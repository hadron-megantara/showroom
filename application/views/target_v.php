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
	if ($level1['data'] == 1) { ?> 
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
			<h2><i class="fa fa-wrench"></i> Target</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Target</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<button class="btn btn-primary tambahdata" data-toggle="modal" data-target="#ModalTambah"><i class="fa fa-plus"></i> Tambah Target </button>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Cabang</th>
									<th>Tanggal</th>
									<th>Target SPK</th>
									<th>Target Omset</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT a.code,b.data as cabang,a.tgl,a.target_po,a.target_omset
											FROM _target a INNER JOIN _cabang b ON a._cabang=b.code
											ORDER BY tgl DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->cabang; ?></td>
									<td><?PHP echo date("M Y", strtotime($row->tgl)) ?></td>
									<td><?PHP echo $row->target_po; ?></td>
									<td><?PHP echo $row->target_omset; ?></td>
									<td>
										<a href="<?PHP echo base_url() ?>target/edit/<?PHP echo $row->code; ?>" class="fa fa-pencil" style="text-decoration:none;color:green"></a>
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
	
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form method="post" action="<?PHP echo site_url(); ?>target/tambah_data">
	<input type="hidden" name="iduser" value="<?PHP echo $this->session->userdata("sm_username")?>"/>
	<input type="hidden" name="tanggaluser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("d F Y")?>"/>
	<input type="hidden" name="jamuser" value="<?PHP date_default_timezone_set ("Asia/Jakarta"); echo date("H:i:s")?>"/>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Via Kredit</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="control-label">Cabang <font color="red">*</font></label>
								<select class="form-control mb15" name="cabang" required >
									<?PHP
										$query = $this->db->query("SELECT * FROM _cabang WHERE _deleted=0 ORDER BY data ASC");
										foreach($query->result() as $row) :
									?>
									<option value="<?PHP echo $row->code; ?>"><?PHP echo $row->data; ?></option>
									<?PHP
										endforeach;
									?>
								</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Bulan</label>
							<select class="form-control mb15" name="bulan" required >
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">Novermber</option>
								<option value="12">Desember</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Tahun</label>
							<select class="form-control mb15" name="tahun" required >
								<option value="2000">2000</option>
								<option value="2001">2001</option>
								<option value="2002">2002</option>
								<option value="2003">2003</option>
								<option value="2004">2004</option>
								<option value="2005">2005</option>
								<option value="2006">2006</option>
								<option value="2007">2007</option>
								<option value="2008">2008</option>
								<option value="2009">2009</option>
								<option value="2010">2010</option>
								<option value="2011">2011</option>
								<option value="2012">2012</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
								<option value="2027">2027</option>
								<option value="2028">2028</option>
								<option value="2029">2029</option>
								<option value="2030">2030</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Target SPK <font color="red">*</font></label>
							<input type="number" autocomplete="off" name="po" class="form-control" required />
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label">Target Omset <font color="red">*</font></label>
							<input type="number" autocomplete="off" name="omset" class="form-control" required />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</div>
</form>
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