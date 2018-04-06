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
	if ($level1['data'] == 1 || $level1['data'] == 2 || $level1['data'] == 8 || $level1['data'] == 3) { ?> 
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
			<h2><i class="fa fa-tasks"></i> Jurnal</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>laba_jurnal">Jurnal</a></li>
					<li class="active">Detail Jurnal</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="row">
				<div class="col-sm-2">
		<?PHP if($this->input->post("cabang") == 0) { ?>		
		<form action="<?PHP echo base_url(); ?>laba_jurnal/cetak_excel_all" method="post" target="_blank">
			<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
			<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
			<button class="btn btn-warning"><i class="fa fa-clipboard"></i> Expor Excel Jurnal</button>
		</form>
		<?PHP } else { ?>
		<form action="<?PHP echo base_url(); ?>laba_jurnal/cetak_excel_cabang" method="post" target="_blank">
			<input type="hidden" name="tglawal" value="<?PHP echo $this->input->post("tglawal") ?>">
			<input type="hidden" name="tglakhir" value="<?PHP echo $this->input->post("tglakhir") ?>">
			<input type="hidden" name="cabang" value="<?PHP echo $this->input->post("cabang") ?>">
			<button class="btn btn-warning"><i class="fa fa-clipboard"></i> Expor Excel Jurnal</button>
		</form>
		<?PHP }  ?>
				</div>
			</div>
		<br>
			<div class="panel panel-default">
				<div class="panel-body">
					<?PHP if($this->input->post("cabang") == 0) { ?>
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th width="10%">Tanggal</th>
									<th width="20%">Jenis</th>
									<th width="40%">Keterangan</th>
									<th width="15%">Debit</th>
									<th width="15%">Kredit</th>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
									<th>Edit</th>
									<?PHP }else{} ?>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$query = $this->db->query("SELECT idlr,tgl,_jenis.data as jenis,keterangan,debit,kredit
									FROM laba_rugi,_jenis
									WHERE laba_rugi._jenis=_jenis.code AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tgl DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl)); ?></td>
									<td><?PHP echo $row->jenis; ?></td>
									<td><?PHP echo $row->keterangan; ?></td>
									<td><?PHP echo number_format($row->debit); ?></td>
									<td><?PHP echo number_format($row->kredit); ?></td>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
									<td><a href="<?PHP echo base_url() ?>laba_jurnal/edit/<?PHP echo $row->idlr; ?>" class="fa fa-pencil" style="text-decoration:none;color:green"></a></td>
									<?PHP }else{} ?>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Harga Setelah Discount // Tanda Jadi
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,tanggalspk,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tanggalspk DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Bank</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Modal Mobil
									$query = $this->db->query("SELECT idmobil,nopol,tipemobil,hawal,tglbeli
									FROM mobil
									WHERE _deleted=0 AND tglbeli BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tglbeli DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Pembelian</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Bank</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 1
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl2,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp2
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl2 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp2 NOT LIKE 0 ORDER BY tgl2 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 2
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl3,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp3
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl3 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp3 NOT LIKE 0  ORDER BY tgl3 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 3
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl4,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp4
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl4 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp4 NOT LIKE 0  ORDER BY tgl4 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pelunasan DP 4
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl5,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp5
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl5 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp5 NOT LIKE 0 ORDER BY tgl5 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 5
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl6,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp6
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl6 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp6 NOT LIKE 0  ORDER BY tgl6 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Refund Asuransi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_asuransi,tgl_asuransi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_asuransi NOT LIKE '0000-00-00'  ORDER BY tgl_asuransi DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Bank</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Refund Asuransi</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Refund Bunga
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_refund,tgl_refund,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_refund NOT LIKE '0000-00-00'  ORDER BY tgl_refund DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Bank</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Refund Bunga</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Provisi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_profisi,tgl_profisi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_profisi NOT LIKE '0000-00-00'  ORDER BY tgl_profisi DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Bank</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Refund Provisi</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pencairan Leasing
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,totaldp,tgl_pelunasan,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_pelunasan NOT LIKE '0000-00-00' ORDER BY tgl_pelunasan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Bank</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Piutang Leasing</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
							</tbody>
						</table>
					</div>
					<?PHP } else { ?>
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th width="10%">Tanggal</th>
									<th width="20%">Jenis</th>
									<th width="40%">Keterangan</th>
									<th width="15%">Debit</th>
									<th width="15%">Kredit</th>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
									<th>Edit</th>
									<?PHP }else{} ?>
								</tr>
							</thead>
							<tbody>
								<?PHP
									//Jurnal
									$query = $this->db->query("SELECT idlr,tgl,_jenis.data as jenis,keterangan,debit,kredit
									FROM laba_rugi,_jenis
									WHERE laba_rugi._cabang='".$this->input->post("cabang")."' AND laba_rugi._jenis=_jenis.code AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tgl DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl)); ?></td>
									<td><?PHP echo $row->jenis; ?></td>
									<td><?PHP echo $row->keterangan; ?></td>
									<td><?PHP echo number_format($row->debit); ?></td>
									<td><?PHP echo number_format($row->kredit); ?></td>
									<?PHP $level=mysql_query("SELECT _jabatan as data from user WHERE username='".$this->session->userdata("sm_username")."'");$level1=mysql_fetch_assoc($level);
									if ($level1['data'] == 1 || $level1['data'] == 2) { ?> 
									<td><a href="<?PHP echo base_url() ?>laba_jurnal/edit/<?PHP echo $row->idlr; ?>" class="fa fa-pencil" style="text-decoration:none;color:green"></a></td>
									<?PHP }else{} ?>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Harga Setelah Discount // Tanda Jadi
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,tanggalspk,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tanggalspk DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Bank</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Modal Mobil
									$query = $this->db->query("SELECT idmobil,nopol,tipemobil,hawal,tglbeli
									FROM mobil
									WHERE _deleted=0 AND _cabang='".$this->input->post("cabang")."' AND tglbeli BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tglbeli DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Pembelian</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Bank</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 1
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl2,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp2
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl2 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp2 NOT LIKE 0 ORDER BY tgl2 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 2
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl3,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp3
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl3 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp3 NOT LIKE 0  ORDER BY tgl3 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 3
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl4,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp4
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl4 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp4 NOT LIKE 0  ORDER BY tgl4 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pelunasan DP 4
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl5,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp5
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl5 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp5 NOT LIKE 0 ORDER BY tgl5 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 5
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl6,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp6
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl6 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp6 NOT LIKE 0  ORDER BY tgl6 DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Refund Asuransi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_asuransi,tgl_asuransi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_asuransi NOT LIKE '0000-00-00'  ORDER BY tgl_asuransi DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Bank</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Refund Asuransi</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Refund Bunga
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_refund,tgl_refund,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_refund NOT LIKE '0000-00-00'  ORDER BY tgl_refund DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Bank</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Refund Bunga</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Provisi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_profisi,tgl_profisi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_profisi NOT LIKE '0000-00-00'  ORDER BY tgl_profisi DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Bank</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Refund Provisi</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pencairan Leasing
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,totaldp,tgl_pelunasan,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_pelunasan NOT LIKE '0000-00-00' ORDER BY tgl_pelunasan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Bank</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td>0</td>
									<td>-</td>
								</tr>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Piutang Leasing</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td>-</td>
								</tr>
								<?PHP
										}
									}
								?>
							</tbody>
						</table>
					</div>
					<?PHP } ?>
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