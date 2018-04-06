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
			<h2><i class="fa fa-tasks"></i> Cabang</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Detail Laba Cabang</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
		<?PHP
										$otrbulan="0";$modalbulan="0";$bungabulan="0";$asuransibulan="0";$provisibulan="0";$unit=0;
										$query = $this->db->query("
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$this->input->post("iddata")."
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
										UNION
										SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
														,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp,a.hargamodal,
														a.p_refund,a.p_asuransi,a.p_profisi
														FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
														INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
														WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang=".$this->input->post("iddata")."
														AND tgl_pelunasan  BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
														AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
										ORDER BY idpenjualan DESC");
										if($query->num_rows())
										{
											foreach($query->result() as $hbulan)
											{	
												$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$hbulan->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
													if ($hbulan->tipebayar == 'Cash') 
													{
														if ($hbulan->hsdiscount == $uang1["data"]) 
														{
															$otrbulan+=$hbulan->hsdiscount;
															$modalbulan+=$hbulan->hargamodal;
															$bungabulan+=$hbulan->p_refund;
															$asuransibulan+=$hbulan->p_asuransi;
															$provisibulan+=$hbulan->p_profisi;
															$unit++;
														}	
													} 
													else if ($hbulan->tipebayar == 'Kredit') 
													{
														if ($hbulan->totaldp == $uang1["data"] && $hbulan->tgl_pelunasan != '0000-00-00') 
														{
															$otrbulan+=$hbulan->hsdiscount;
															$modalbulan+=$hbulan->hargamodal;
															$bungabulan+=$hbulan->p_refund;
															$asuransibulan+=$hbulan->p_asuransi;
															$provisibulan+=$hbulan->p_profisi;
															$unit++;
														}
													}
											}
										}
		
		?>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Laba Rugi</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Nama Cabang</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP $result=mysql_query("SELECT data as data from _cabang WHERE code='".$this->input->post("iddata")."'");$data=mysql_fetch_assoc($result);echo $data['data'];?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Jual</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($otrbulan);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Mobil Terjual</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo $unit;?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Harga Modal</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($modalbulan);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Profit OTR</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($otrbulan-$modalbulan);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Bunga</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($bungabulan);?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Refund Asuransi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($asuransibulan);?>" readonly />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Provisi</label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($provisibulan);?>" readonly />
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label"><b>Total Profit</b></label>
								<input type="text" autocomplete="off" name="" class="form-control" value="<?PHP echo number_format($otrbulan-$modalbulan+$bungabulan+$asuransibulan+$provisibulan);?>" readonly />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Penjualan</h4>
				</div>
				<div class="panel-body">
						<table class="table table-striped mb30" id="table-responsive">
						<thead>
							<th>Kode Penjualan</th>
							<th>Pembeli</th>
							<th>Harga Jual</th>
							<th>Harga Modal</th>
							<th>Tanggal SPK</th>
							<th>Option</th>
						</thead>
						<tbody>
							<?PHP
								$query = $this->db->query("
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,a._deleted as deleted,totaldp
													,totalharga,hargamodal
													FROM penjualan a INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$this->input->post("iddata")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
									UNION
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,a._deleted as deleted,totaldp
													,totalharga,hargamodal
													FROM penjualan a INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$this->input->post("iddata")."'
													AND tgl_pelunasan BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
													");
								if($query->num_rows())
								{
									foreach($query->result() as $row)
									{
									$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
										if ($row->tipebayar == 'Cash') 
										{
											if ($row->hsdiscount == $uang1["data"]) 
											{ 
							?>
											
											
								<tr>
									<td><?PHP echo $row->idpenjualan; ?></td>
									<td><?PHP echo $row->pembeli; ?></td>
									<td><?PHP echo number_format($row->hsdiscount); ?></td>
									<td><?PHP echo number_format($row->hargamodal); ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a></td>
								</tr>
							<?PHP
											}	
										} 
										else if ($row->tipebayar == 'Kredit') 
										{
											if ($row->totaldp == $uang1["data"] && $row->tgl_pelunasan != '0000-00-00') 
											{ 
							?>
											
								<tr>
									<td><?PHP echo $row->idpenjualan; ?></td>
									<td><?PHP echo $row->pembeli; ?></td>
									<td><?PHP echo number_format($row->totalharga); ?></td>
									<td><?PHP echo number_format($row->hsdiscount); ?></td>
									<td><?PHP echo number_format($row->hargamodal); ?></td>
									<td><?PHP echo date("d M Y", strtotime($row->tanggalspk)); ?></td>
									<td><a href="<?PHP echo base_url() ?>detail_penjualan/detail/<?PHP echo $row->idpenjualan; ?>" ><i class="fa fa-search"></i></a></td>
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
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title">Detail Keperluan</h4>
				</div>
				<div class="panel-body">
						<table class="table table-striped mb30" id="table-responsive2">
						<thead>
							<th>Tanggal</th>
							<th>Voucher</th>
							<th>Jenis</th>
							<th>Keterangan</th>
							<th>Debit</th>
							<th>Kredit</th>
						</thead>
						<tbody>
							<?PHP
								$query = $this->db->query("SELECT voucher,tgl,_jenis.data as jenis,keterangan,kredit,debit
											FROM laba_rugi,_jenis
											WHERE laba_rugi._jenis=_jenis.code AND laba_rugi._cabang='".$this->input->post("iddata")."' AND tgl BETWEEN '".$this->input->post("tglawal")."' AND '".$this->input->post("tglakhir")."'
											ORDER BY tgl DESC");
								if($query->num_rows())
								{
									foreach($query->result() as $row)
									{	
							?>
								<tr>
									<td><?PHP echo date("d M Y", strtotime($row->tgl)); ?></td>
									<td><?PHP echo $row->voucher; ?></td>
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
<script type="text/javascript">
    jQuery('#table-responsive').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
    jQuery('#table-responsive2').dataTable({
      "sPaginationType": "full_numbers","bSort": false,"bAutoWidth": false
    });
</script>
<?PHP } else { }?>
<?PHP
	}
?>