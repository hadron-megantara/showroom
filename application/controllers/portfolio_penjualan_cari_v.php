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
			<h2><i class="fa fa-print"></i> Portfolio Penjualan</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Portfolio Penjualan</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30">
							<thead>
								<tr>
									<td align="center" width="10%"><b>NO</b></td>
									<td width="30%"><b>CABANG</b></td>
									<td align="center" width="10%"><b>CASH</b></td>
									<td align="center" width="10%"><b>OTO</b></td>
									<td align="center" width="10%"><b>ACC</b></td>
									<td align="center" width="10%"><b>VERENA</b></td>
									<td align="center" width="10%"><b>ANDALAN</b></td>
									<td align="center" width="10%"><b>TOTAL</b></td>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("SELECT *
											FROM _cabang
											WHERE _deleted=0 AND code not like 1 ORDER BY data ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td align="center"><?PHP echo $i; ?></td>
									<td><?PHP echo $row->data; ?></td>
									<td align="center"><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and tipebayar='Cash'");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></td>
									<td align="center"><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=3");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></td>
									<td align="center"><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=2");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></td>
									<td align="center"><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=5");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></td>
									<td align="center"><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=4");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></td>
									<td align="center"><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit not like 6");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></td>
								</tr>
								<?PHP
									$i++;
										}
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<td align="center"><b></b></td>
									<td><b>TOTAL</b></td>
									<td align="center"><b><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and tipebayar='Cash'");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></b></td>
									<td align="center"><b><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=3");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></b></td>
									<td align="center"><b><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=2");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></b></td>
									<td align="center"><b><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=5");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></b></td>
									<td align="center"><b><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit=4");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></b></td>
									<td align="center"><b><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0 and _kredit not like 6");$data1=mysql_fetch_assoc($data);echo $data1["data"]; ?></b></td>
								</tr>
							</tfoot>
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