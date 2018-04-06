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
									<td width="300px"><b>CABANG</b></td>
									<td align="center"><b>CASH</b></td>
									<td align="center"><b>ACC</b></td>
									<td align="center"><b>OTO</b></td>
									<td align="center"><b>ANDALAN</b></td>
									<td align="center"><b>VERENA</b></td>
									<td align="center"><b>CITIVIN</b></td>
									<td align="center"><b>ADIRA</b></td>
									<td align="center"><b>IAF</b></td>
									<td align="center"><b>MITSUI</b></td>
									<td align="center"><b>ASTRIDO</b></td>
									<td align="center"><b>OLYMPINDO</b></td>
									<td align="center"><b>TOTAL</b></td>
								</tr>
							</thead>
							<tbody>
								<?PHP
									$i=1;$tcash=0;$toto=0;$tacc=0;$tverena=0;$tandalan=0;$ttotal=0;
									$tadira=0;$tolympindo=0;$tbfi=0;$tcitivin=0;$tiaf=0;$tmitsui=0;$tastrido=0;
									$query = $this->db->query("SELECT *
											FROM _cabang
											WHERE _deleted=0 AND code not like 1 ORDER BY data ASC");
									if($query->num_rows())
									{
										foreach($query->result() as $rows)
										{	
								?>
								
								<?PHP
									$cash=0;$oto=0;$acc=0;$verena=0;$andalan=0;$total=0;
									$adira=0;$olympindo=0;$bfi=0;$citivin=0;$iaf=0;$mitsui=0;$astrido=0;
									$query = $this->db->query("
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													,a._kredit as kredit
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$rows->code."'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)>=tgl_pelunasan
									UNION
									SELECT DISTINCT iddtunai,GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6) as great,a.tgl_pelunasan,idpenjualan
													,pembeli,tipebayar,hsdiscount,tanggalspk,b.data as cabang,a._deleted as deleted,totaldp
													,a._kredit as kredit
													FROM penjualan a INNER JOIN _cabang b ON a._cabang=b.code
													INNER JOIN detail_tunai c ON a.idpenjualan=c.iddtunai
													WHERE a._deleted=0 AND a.statjual='Omset' AND a._cabang='".$rows->code."'
													AND tgl_pelunasan LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%'
													AND GREATEST(tgl1,tgl2,tgl3,tgl4,tgl5,tgl6)<=tgl_pelunasan
									ORDER BY idpenjualan DESC");
									if($query->num_rows())
									{
										foreach($query->result() as $row)
										{	
											$uang=mysql_query("SELECT sum(dp1+dp2+dp3+dp4+dp5+dp6) as data from detail_tunai WHERE iddtunai='".$row->idpenjualan."'");$uang1=mysql_fetch_assoc($uang);
												if ($row->tipebayar == 'Cash') 
												{
													if ($row->hsdiscount == $uang1["data"]) 
													{
														if($row->kredit == 1) { $cash+=1;$total+=1; }
														else if($row->kredit == 2) { $acc+=1;$total+=1; }
														else if($row->kredit == 3) { $oto+=1;$total+=1; }
														else if($row->kredit == 4) { $andalan+=1;$total+=1; }
														else if($row->kredit == 5) { $verena+=1;$total+=1; }
														else if($row->kredit == 6) { $citivin+=1;$total+=1; }
														else if($row->kredit == 7) { $adira+=1;$total+=1; }
														else if($row->kredit == 8) { $iaf+=1;$total+=1; }
														else if($row->kredit == 9) { $mitsui+=1;$total+=1; }
														else if($row->kredit == 10) { $astrido+=1;$total+=1; }
														else if($row->kredit == 11) { $olympindo+=1;$total+=1; }
														else if($row->kredit == 12) { $adira+=1;$total+=1; }
														else if($row->kredit == 13) { $bfi+=1;$total+=1; }
													}	
												} 
												else if ($row->tipebayar == 'Kredit') 
												{
													if ($row->totaldp == $uang1["data"] ) 
													{
														if($row->kredit == 1) { $cash+=1;$total+=1; }
														else if($row->kredit == 2) { $acc+=1;$total+=1; }
														else if($row->kredit == 3) { $oto+=1;$total+=1; }
														else if($row->kredit == 4) { $andalan+=1;$total+=1; }
														else if($row->kredit == 5) { $verena+=1;$total+=1; }
														else if($row->kredit == 6) { $citivin+=1;$total+=1; }
														else if($row->kredit == 7) { $adira+=1;$total+=1; }
														else if($row->kredit == 8) { $iaf+=1;$total+=1; }
														else if($row->kredit == 9) { $mitsui+=1;$total+=1; }
														else if($row->kredit == 10) { $astrido+=1;$total+=1; }
														else if($row->kredit == 11) { $olympindo+=1;$total+=1; }
														else if($row->kredit == 12) { $adira+=1;$total+=1; }
														else if($row->kredit == 13) { $bfi+=1;$total+=1; }
													}
												}
										}
									}
								?>
								
								<tr>
									<td align="center"><?PHP echo $i; ?></td>
									<td><?PHP echo $rows->data; ?></td>
									<td align="center"><?PHP echo $cash; ?></td>
									<td align="center"><?PHP echo $acc; ?></td>
									<td align="center"><?PHP echo $oto; ?></td>
									<td align="center"><?PHP echo $andalan; ?></td>
									<td align="center"><?PHP echo $verena; ?></td>
									<td align="center"><?PHP echo $citivin; ?></td>
									<td align="center"><?PHP echo $adira; ?></td>
									<td align="center"><?PHP echo $iaf; ?></td>
									<td align="center"><?PHP echo $mitsui; ?></td>
									<td align="center"><?PHP echo $astrido; ?></td>
									<td align="center"><?PHP echo $olympindo; ?></td>
									<td align="center"><?PHP echo $total; ?></td>
								</tr>
								<?PHP
									$i++;$tcash+=$cash;$toto+=$oto;$tacc+=$acc;$tverena+=$verena;$tandalan+=$andalan;
									$ttotal+=$total;$tadira+=$adira;$tolympindo+=$olympindo;$tbfi+=$bfi;
									$tcitivin+=$citivin;$tiaf+=$iaf;$tastrido+=$astrido;$tmitsui+=$mitsui;
									
										}
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td align="center"><?PHP echo $tcash; ?></td>
									<td align="center"><?PHP echo $tacc; ?></td>
									<td align="center"><?PHP echo $toto; ?></td>
									<td align="center"><?PHP echo $tandalan; ?></td>
									<td align="center"><?PHP echo $tverena; ?></td>
									<td align="center"><?PHP echo $tcitivin; ?></td>
									<td align="center"><?PHP echo $tadira; ?></td>
									<td align="center"><?PHP echo $tiaf; ?></td>
									<td align="center"><?PHP echo $tmitsui; ?></td>
									<td align="center"><?PHP echo $tastrido; ?></td>
									<td align="center"><?PHP echo $tolympindo; ?></td>
									<td align="center"><?PHP echo $ttotal; ?></td>
								</tr>
							</tfoot>
						</table>
						<br><br>
						<table class="table table-striped mb30">
							<thead>
								<tr>
									<td>Tanggal</td>
									<td>MM</td>
									<td>MM2</td>
									<td>PM</td>
									<td>PM2</td>
									<td>PM3</td>
									<td>CM</td>
									<td>CM2</td>
									<td>GM</td>
									<td>GM2</td>
									<td>SM</td>
									<td>MTHR</td>
									<td>Total</td>
								</tr>
							</thead>
							<tbody>
							<?PHP
							$i=1;
							for($i;$i<=31;$i++){
							?>
								<tr>
									<td><?PHP echo $i; ?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=3 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=6 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=2 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=5 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=9 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=4 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=11 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=7 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=8 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=10 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=12 AND tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
									<td><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk='".$this->input->post("tahun")."-".$this->input->post("bulan")."-".$i."' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></td>
								</tr>
							<?PHP
							}
							?>
							</tbody>
							<tfoot>
								<tr>
									<th>-</th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=3 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=6 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=2 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=5 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=9 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=4 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=11 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=7 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=8 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=10 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE _cabang=12 AND tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
									<th><?PHP $result=mysql_query("SELECT count(*) as data from penjualan WHERE tanggalspk LIKE '%".$this->input->post("tahun")."-".$this->input->post("bulan")."%' AND _deleted=0");$data=mysql_fetch_assoc($result);echo $data['data'];?></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?PHP
	}
?>