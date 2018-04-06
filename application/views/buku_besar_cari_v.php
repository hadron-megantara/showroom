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
			<h2><i class="fa fa-tasks"></i> Buku Besar</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li><a href="<?PHP echo base_url() ?>buku_besar">Buku Besar</a></li>
					<li class="active">Detail Buku Besar</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<br>
			<div class="panel panel-default">
				<div class="panel-body">
					<?PHP if($this->input->post("cabang") == 0) { ?>
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Jenis</th>
									<th>Keterangan</th>
									<th>Debit</th>
									<th>Kredit</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody>
								<?PHP date_default_timezone_set ("Asia/Jakarta");
								$tgl_cari = date('Y-m-d', strtotime('-1 days', strtotime($this->input->post("tglawal"))));	
								?>
								<?PHP
									//Saldo Awal
									$saldo_semua="0";$debit_semua="0";$kredit_semua="0";
								?>
								<tr>
									<td></td>
									<td></td>
									<td><b>Saldo Awal</b></td>
									<td></td>
									<td></td>
									<td><?PHP $data=mysql_query("SELECT sum(debit-kredit) as hasil,sum(debit) as debit,sum(kredit) as kredit FROM laba_rugi WHERE _jenis='".$this->input->post("akun")."' AND  tgl BETWEEN '2010-01-01' AND '".$tgl_cari."'");$data1=mysql_fetch_assoc($data);echo number_format($saldo_semua=$data1["hasil"]);$debit_semua=$data1["debit"];$kredit_semua=$data1["kredit"]; ?></td>
								</tr>
								<?PHP
									//Jurnal
									$saldo_semua="0";$debit_semua="0";$kredit_semua="0";
									$query = $this->db->query("SELECT idlr,tgl,_jenis.data as jenis,keterangan,debit,kredit
									FROM laba_rugi,_jenis
									WHERE _jenis.code='".$this->input->post("akun")."' AND laba_rugi._jenis=_jenis.code AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tgl ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
										$debit_semua+=$row->debit;
										$kredit_semua+=$row->kredit;
										$saldo_semua=$debit_semua-$kredit_semua;
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl)); ?></td>
									<td><?PHP echo $row->jenis; ?></td>
									<td><?PHP echo $row->keterangan; ?></td>
									<td><?PHP echo number_format($row->debit); ?></td>
									<td><?PHP echo number_format($row->kredit); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Harga Setelah Discount // Tanda Jadi
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,tanggalspk,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tanggalspk ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") { 
									$debit_semua+=$row->tandajadi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Bank</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") { 
									$kredit_semua+=$row->tandajadi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Modal Mobil
									$query = $this->db->query("SELECT idmobil,nopol,tipemobil,hawal,tglbeli
									FROM mobil
									WHERE _deleted=0 AND tglbeli BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tglbeli ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "7200") {
									$debit_semua+=$row->hawal;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Pembelian</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "1200") { 
									$kredit_semua+=$row->hawal;
									$saldo_semua=$debit_semua-$kredit_semua;?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Bank</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 1
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl2,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp2
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl2 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp2 NOT LIKE 0 ORDER BY tgl2 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {  
									$debit_semua+=$row->dp2;
									$saldo_semua=$debit_semua-$kredit_semua;?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {  
									$kredit_semua+=$row->dp2;
									$saldo_semua=$debit_semua-$kredit_semua;?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 2
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl3,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp3
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl3 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp3 NOT LIKE 0  ORDER BY tgl3 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->dp3;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {   
									$kredit_semua+=$row->dp3;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 3
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl4,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp4
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl4 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp4 NOT LIKE 0  ORDER BY tgl4 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->dp4;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {   
									$kredit_semua+=$row->dp4;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pelunasan DP 4
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl5,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp5
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl5 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp5 NOT LIKE 0 ORDER BY tgl5 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->dp5;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {   
									$kredit_semua+=$row->dp5;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 5
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl6,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp6
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl6 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp6 NOT LIKE 0  ORDER BY tgl6 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {    
									$debit_semua+=$row->dp6;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {    
									$kredit_semua+=$row->dp6;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Refund Asuransi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_asuransi,tgl_asuransi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_asuransi NOT LIKE '0000-00-00'  ORDER BY tgl_asuransi ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->p_asuransi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Bank</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "7301") {   
									$kredit_semua+=$row->p_asuransi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Refund Asuransi</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Refund Bunga
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_refund,tgl_refund,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_refund NOT LIKE '0000-00-00'  ORDER BY tgl_refund ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->p_refund;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Bank</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "7300") {   
									$kredit_semua+=$row->p_refund;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Refund Bunga</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Provisi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_profisi,tgl_profisi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_profisi NOT LIKE '0000-00-00'  ORDER BY tgl_profisi ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") { 
									$debit_semua+=$row->p_profisi; 
									$saldo_semua=$debit_semua-$kredit_semua;  ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Bank</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "7302") {  
									$kredit_semua+=$row->p_profisi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Refund Provisi</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pencairan Leasing
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,totaldp,tgl_pelunasan,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_pelunasan NOT LIKE '0000-00-00' ORDER BY tgl_pelunasan ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {  
									$debit_semua+=$row->hsdiscount-$row->totaldp; 
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Bank</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2001") {  
									$kredit_semua+=$row->hsdiscount-$row->totaldp;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Pencairan Leasing</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th>Total</th>
									<th><?PHP echo number_format($debit_semua); ?></th>
									<th><?PHP echo number_format($kredit_semua); ?></th>
									<th><?PHP echo number_format($saldo_semua); ?></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<?PHP } else { ?>
					<div class="table-responsive">
						<table class="table table-striped mb30" id="table-responsive">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Jenis</th>
									<th>Keterangan</th>
									<th>Debit</th>
									<th>Kredit</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody>
								<?PHP date_default_timezone_set ("Asia/Jakarta");
								$tgl_cari = date('Y-m-d', strtotime('-1 days', strtotime($this->input->post("tglawal"))));	
								?>
								<?PHP
									//Saldo Awal
									$saldo_semua="0";$debit_semua="0";$kredit_semua="0";
								?>
								<tr>
									<td></td>
									<td></td>
									<td><b>Saldo Awal</b></td>
									<td></td>
									<td></td>
									<td><?PHP $data=mysql_query("SELECT sum(debit-kredit) as hasil,sum(debit) as debit,sum(kredit) as kredit FROM laba_rugi WHERE _cabang='".$this->input->post("cabang")."' AND  _jenis='".$this->input->post("akun")."' AND  tgl BETWEEN '2010-01-01' AND '".$tgl_cari."'");$data1=mysql_fetch_assoc($data);echo number_format($saldo_semua=$data1["hasil"]);$debit_semua=$data1["debit"];$kredit_semua=$data1["kredit"]; ?></td>
								</tr>
								<?PHP
									//Jurnal
									$query = $this->db->query("SELECT idlr,tgl,_jenis.data as jenis,keterangan,debit,kredit
									FROM laba_rugi,_jenis
									WHERE laba_rugi._cabang='".$this->input->post("cabang")."' AND _jenis.code='".$this->input->post("akun")."' AND laba_rugi._jenis=_jenis.code AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tgl ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
										$debit_semua+=$row->debit;
										$kredit_semua+=$row->kredit;
										$saldo_semua=$debit_semua-$kredit_semua;
								?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl)); ?></td>
									<td><?PHP echo $row->jenis; ?></td>
									<td><?PHP echo $row->keterangan; ?></td>
									<td><?PHP echo number_format($row->debit); ?></td>
									<td><?PHP echo number_format($row->kredit); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Harga Setelah Discount // Tanda Jadi
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,tanggalspk,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tanggalspk BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tanggalspk ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") { 
									$debit_semua+=$row->tandajadi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Bank</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") { 
									$kredit_semua+=$row->tandajadi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Tanda Jadi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->tandajadi); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Modal Mobil
									$query = $this->db->query("SELECT idmobil,nopol,tipemobil,hawal,tglbeli
									FROM mobil
									WHERE _deleted=0 AND _cabang='".$this->input->post("cabang")."' AND tglbeli BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' ORDER BY tglbeli ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "7200") {
									$debit_semua+=$row->hawal;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Pembelian</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "1200") { 
									$kredit_semua+=$row->hawal;
									$saldo_semua=$debit_semua-$kredit_semua;?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tglbeli)); ?></td>
									<td>Bank</td>
									<td>Modal mobil, <?PHP echo $row->idmobil; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hawal); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 1
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl2,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp2
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl2 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp2 NOT LIKE 0 ORDER BY tgl2 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {  
									$debit_semua+=$row->dp2;
									$saldo_semua=$debit_semua-$kredit_semua;?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {  
									$kredit_semua+=$row->dp2;
									$saldo_semua=$debit_semua-$kredit_semua;?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl2)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 1, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp2); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 2
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl3,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp3
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl3 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp3 NOT LIKE 0  ORDER BY tgl3 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->dp3;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {   
									$kredit_semua+=$row->dp3;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl3)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 2, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp3); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 3
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl4,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp4
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl4 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp4 NOT LIKE 0  ORDER BY tgl4 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->dp4;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {   
									$kredit_semua+=$row->dp4;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl4)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 3, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp4); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pelunasan DP 4
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl5,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp5
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl5 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp5 NOT LIKE 0 ORDER BY tgl5 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->dp5;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {   
									$kredit_semua+=$row->dp5;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl5)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp5); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Pelunasan DP 5
									$query = $this->db->query("SELECT iddtunai,penjualan.hsdiscount,tgl6,penjualan.pembeli,mobil.nopol,mobil.tipemobil,dp6
									FROM penjualan,mobil,detail_tunai
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND detail_tunai.iddtunai=penjualan.idpenjualan AND penjualan.idpenjualan=mobil.idpenjualan AND tgl6 BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND dp6 NOT LIKE 0  ORDER BY tgl6 ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {    
									$debit_semua+=$row->dp6;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Bank</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2002") {    
									$kredit_semua+=$row->dp6;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl6)); ?></td>
									<td>Cicilan DP / Tanda Jadi</td>
									<td>Pelunasan DP 5, <?PHP echo $row->iddtunai; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->dp6); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Refund Asuransi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_asuransi,tgl_asuransi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_asuransi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_asuransi NOT LIKE '0000-00-00'  ORDER BY tgl_asuransi ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->p_asuransi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Bank</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "7301") {   
									$kredit_semua+=$row->p_asuransi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_asuransi)); ?></td>
									<td>Refund Asuransi</td>
									<td>Refund Asuransi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_asuransi); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								
								<?PHP
									//Refund Bunga
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_refund,tgl_refund,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_refund BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_refund NOT LIKE '0000-00-00'  ORDER BY tgl_refund ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {   
									$debit_semua+=$row->p_refund;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Bank</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "7300") {   
									$kredit_semua+=$row->p_refund;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_refund)); ?></td>
									<td>Refund Bunga</td>
									<td>Refund Bunga, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_refund); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Provisi
									$query = $this->db->query("SELECT penjualan.idpenjualan,p_profisi,tgl_profisi,pembeli,nopol,mobil.tipemobil
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_profisi BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_profisi NOT LIKE '0000-00-00'  ORDER BY tgl_profisi ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") { 
									$debit_semua+=$row->p_profisi; 
									$saldo_semua=$debit_semua-$kredit_semua;  ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Bank</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "7302") {  
									$kredit_semua+=$row->p_profisi;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_profisi)); ?></td>
									<td>Refund Provisi</td>
									<td>Provisi, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->p_profisi); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
								<?PHP
									//Pencairan Leasing
									$query = $this->db->query("SELECT penjualan.idpenjualan,hsdiscount,totaldp,tgl_pelunasan,pembeli,nopol,mobil.tipemobil,tandajadi
									FROM penjualan,mobil
									WHERE penjualan._deleted=0 AND penjualan._cabang='".$this->input->post("cabang")."' AND penjualan.idpenjualan=mobil.idpenjualan AND  penjualan.tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."' AND tgl_pelunasan NOT LIKE '0000-00-00' ORDER BY tgl_pelunasan ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
								?>
								<?PHP if($this->input->post("akun") == "1200") {  
									$debit_semua+=$row->hsdiscount-$row->totaldp; 
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Bank</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td>0</td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP if($this->input->post("akun") == "2001") {  
									$kredit_semua+=$row->hsdiscount-$row->totaldp;
									$saldo_semua=$debit_semua-$kredit_semua; ?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl_pelunasan)); ?></td>
									<td>Pencairan Leasing</td>
									<td>Pencairan Leasing, <?PHP echo $row->idpenjualan; ?>, <?PHP echo $row->pembeli; ?>, <?PHP echo $row->nopol; ?>, <?PHP echo $row->tipemobil; ?></td>
									<td>0</td>
									<td><?PHP echo number_format($row->hsdiscount-$row->totaldp); ?></td>
									<td><?PHP echo number_format($saldo_semua); ?></td>
								</tr>
								<?PHP } else { } ?>
								<?PHP
										}
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th>Total</th>
									<th><?PHP echo number_format($debit_semua); ?></th>
									<th><?PHP echo number_format($kredit_semua); ?></th>
									<th><?PHP echo number_format($saldo_semua); ?></th>
								</tr>
							</tfoot>
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