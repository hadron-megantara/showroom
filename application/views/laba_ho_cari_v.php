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
	if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8) { ?> 
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
			<h2><i class="fa fa-tasks"></i> HO</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Profit HO</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<form action="<?PHP echo base_url(); ?>laba_ho/cetak_ho" method="post" target="_blank">
			<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
			<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
			<button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Head Office</button>
		</form>
		<br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th width="10%">Tanggal</th>
									<th width="20%">Jenis</th>
									<th width="40%">Keterangan</th>
									<th width="15%">Debit</th>
									<th width="15%">Kredit</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idlr,tgl,_jenis.data as jenis,keterangan,debit,kredit
									FROM laba_rugi,_jenis
									WHERE laba_rugi._jenis=_jenis.code AND _cabang=1 AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY idlr DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $row->tgl; ?></td>
									<td><?PHP echo $row->jenis; ?></td>
									<td><?PHP echo $row->keterangan; ?></td>
									<td><?PHP echo number_format($row->debit); ?></td>
									<td><?PHP echo number_format($row->kredit); ?></td>
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
<?PHP } else { }?>
<?PHP
	}
?>