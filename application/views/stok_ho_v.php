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
			<h2><i class="fa fa-truck"></i> Stok HO</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Stok HO</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="table-responsive">
			<button class="btn btn-primary" id="ho" onclick="blank_($(this)); return false;" url="stok_ho/ho"><i class="fa fa-print"></i> Daftar Stok HO</button>
			<br><br>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>No</th>
									<th>Merk</th>
									<th>Tipe</th>
									<th>Tahun</th>
									<th>Warna</th>
									<th>No. Polisi</th>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] != 4) { ?> 
									<th>Harga Modal</th>
									<?PHP } ?>
									<th>Wait</th>
									<th>Bengkel</th>
									<th>Cat & Poles</th>
									<th>Variasi</th>
									<th>Salon</th>
									<th>Ket</th>
									<th>Perkiraan Penyelesaian</th>
									
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;
									$query = $this->db->query("SELECT idmobil,status,_jenismobil.data as merk,tipemobil,nopol,tahun,
											warna,status,datediff(current_date(),tglbeli) as selisih,tglbeli,hawal,wait,bengkel,catpoles,variasi,salon,ket,perkiraan
											FROM mobil,_jenismobil
											WHERE mobil._jenismobil=_jenismobil.code AND mobil._deleted=0 AND mobil._cabang=1 AND status='Tersedia' ORDER BY merk ASC,tipemobil");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo $i; ?></td>
									<td><?PHP echo $row->merk; ?></td>
									<td><?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo $row->tahun; ?></td>
									<td><?PHP echo $row->warna; ?></td>
									<td><?PHP echo $row->nopol; ?></td>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] != 4) { ?> 
									<td><?PHP echo number_format($row->hawal); ?></td>
									<?PHP } ?>
									<td><?PHP if($row->wait == 1) { ?>&#10003; <?PHP } else { ?> <?PHP } ?></td>
									<td><?PHP if($row->bengkel == 1) { ?>&#10003; <?PHP } else { ?> <?PHP } ?></td>
									<td><?PHP if($row->catpoles == 1) { ?>&#10003; <?PHP } else { ?> <?PHP } ?></td>
									<td><?PHP if($row->variasi == 1) { ?>&#10003; <?PHP } else { ?> <?PHP } ?></td>
									<td><?PHP if($row->salon == 1) { ?>&#10003; <?PHP } else { ?> <?PHP } ?></td>
									<td><?PHP echo $row->ket; ?></td>
									<td><?PHP echo $row->perkiraan; ?></td>
									<td align="center">
										<input type="hidden" value="<?PHP echo $row->idmobil; ?>" id="idmobil_<?PHP echo $row->idmobil; ?>" />
										<a href="<?PHP echo base_url() ?>stok_all/detail/<?PHP echo $row->idmobil; ?>" class="fa fa-search" style="text-decoration:none;color:blue"></a> &nbsp;
										<a href="<?PHP echo base_url() ?>stok_ho/edit/<?PHP echo $row->idmobil; ?>" class="fa fa-pencil" style="text-decoration:none;color:green"></a> &nbsp;
									</td>
								</tr>
								<?PHP
										$i++;}
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
function blank_(obj){
		var url = $(obj).attr("url");
		window.open(url, '_blank');
		return false;
	}
</script>
<?PHP
	}
?>