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
			<h2><i class="fa fa-print"></i> Report SPK</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Report SPK</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
					<?PHP date_default_timezone_set ("Asia/Jakarta");
					$tgl2 = date('Y-m-d', strtotime('-1 days', strtotime(date("Y-m-d"))));	
					?>
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Nama Cabang</th>
									<th>Target</th>
									<th>H-1</th>
									<th>H</th>
									<th>Total</th>
									<th>%</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=0;$targets=0;$target_po=0;$target_belum=0;$totalnya=0;
									$query = $this->db->query("SELECT *
											FROM _cabang
											WHERE _deleted=0 AND code not like 1 ORDER BY data ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								
								<?PHP $target="1";
								$data=mysql_query("SELECT target_po as data from _target WHERE _cabang='".$row->code."' AND tgl='".$this->input->post("tahun")."-".$this->input->post("bulan")."-01'");
								$data1=mysql_fetch_assoc($data);
								$satu=$data1["data"];
								if($data1["data"] == ''){ }else{ $target=$data1["data"]; }; ?>
								<tr>
									<td><?PHP echo $row->data; ?></td>
									<td><?PHP echo $target; ?></td>
									<td><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk='".$tgl2."' and _deleted=0");$data1=mysql_fetch_assoc($data);echo $data1["data"];$dua=$data1["data"]; ?></td>
									<td><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk='".date("Y-m-d") ."' and _deleted=0");$data1=mysql_fetch_assoc($data);echo $data1["data"];$satu=$data1["data"]; ?></td>
									<td><?PHP $data=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang='".$row->code."' AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' and _deleted=0");$data1=mysql_fetch_assoc($data);echo $data1["data"];$hasil=$data1["data"]; ?></td>
									<td><?PHP $h1=$target+$hasil;$h2=$h1/$target;$h3=$h2-1;$h4=$h3*100;echo ceil($h4); ?>%</td>
								</tr>
								<?PHP
									$i++; $targets+=$target; $target_po+=$dua; $target_belum+=$satu; $totalnya+=$hasil;
										}
									}
								?>
							</tbody>
							<tfoot>
								<th><?PHP echo $i; ?></th>
								<th><?PHP echo $targets; ?></th>
								<th><?PHP echo $target_po; ?></th>
								<th><?PHP echo $target_belum; ?></th>
								<th><?PHP echo $totalnya; ?></th>
								<th><?PHP echo ceil($totalnya/$targets*100); ?>%</th>
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