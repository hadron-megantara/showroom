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
			<h2><i class="fa fa-print"></i> Rekapan Proses</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Rekapan Proses</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<button class="btn btn-danger" id="all" onclick="blank_($(this)); return false;" url="rekapan_proses/all"><i class="fa fa-print"></i> Semua Proses</button>
		<button class="btn btn-info" id="cash" onclick="blank_($(this)); return false;" url="rekapan_proses/cash"><i class="fa fa-print"></i> Proses Cash</button>
		<button class="btn btn-warning" id="spo" onclick="blank_($(this)); return false;" url="rekapan_proses/spo"><i class="fa fa-print"></i> Proses Sudah PO</button>
		<button class="btn btn-primary" id="bpo" onclick="blank_($(this)); return false;" url="rekapan_proses/bpo"><i class="fa fa-print"></i> Proses Belum PO</button>
		<br /><br />
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pembeli</th>
									<th>Cabang</th>
									<th>Tanggal SPK</th>
									<th>No. Reg</th>
									<th>Tipe Bayar</th>
									<th>Harga Terjual</th>
									<th>Ket</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=0;
									$query = $this->db->query("SELECT idpenjualan,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,totaldp,a.ket,a.tglpo,statjual,tgl_pelunasan
									FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
									WHERE a._deleted=0 ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
											if ($row->tipebayar == 'Cash') {
												if ($uang1["data"] != $row->hsdiscount) {$i++;
								?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->ket; ?></td>
												<td>
													<a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a> &nbsp;
													<a href="<?PHP echo base_url() ?>rekapan_proses/edit/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-pencil"></i></a>
												</td>
											</tr>
								<?PHP } } if ($row->tipebayar == 'Kredit') {
											if ($uang1["data"] != $row->totaldp) {$i++;
								?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->ket; ?></td>
												<td>
													<a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a> &nbsp;
													<a href="<?PHP echo base_url() ?>rekapan_proses/edit/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-pencil"></i></a>
												</td>
											</tr>
								<?PHP } else if ($uang1["data"] == $row->totaldp && $row->tgl_pelunasan == '0000-00-00') {$i++; ?>
											<tr>
												<td><?PHP echo $i; ?></td>
												<td><?PHP echo $row->pembeli; ?></td>
												<td><?PHP echo $row->cabang; ?></td>
												<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
												<td><?PHP echo $row->idpenjualan; ?></td>
												
												<?PHP if($row->tipebayar == 'Cash') { ?>
												<td><span class="label label-success">Cash</span></td>
												<?PHP } else {?>
												<td><span class="label label-primary">Kredit</span></td>
												<?PHP }?>
												<td><?PHP echo number_format($row->hsdiscount); ?></td>
												<td><?PHP echo $row->ket; ?></td>
												<td>
													<a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a> &nbsp;
													<a href="<?PHP echo base_url() ?>rekapan_proses/edit/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-pencil"></i></a>
												</td>
											</tr>
								<?PHP
								}
										}
								?>
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
function blank_(obj){
		var url = $(obj).attr("url");
		window.open(url, '_blank');
		return false;
	}
</script>
<script type="text/javascript">
    jQuery('#table-responsive').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
</script>
<?PHP
	}
?>