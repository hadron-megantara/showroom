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
			<h2><i class="fa fa-cog"></i> TDP</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">TDP</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3>ANGSURAN</h3>
				</div>
				<div class="panel-body">
					<form name="angsuran">
					<div class="table-responsive">
						<table border="2" class="table table-striped mb30">
							<tr>
								<td width="150px"><b>ANGSURAN</b></td>
								<td width="150px"></td>
								<td width="150px"><input type="text" id="aangsuran" onKeyUp="formatAngka(this, ',');HitungTotal();" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>OTR</b></td>
								<td></td>
								<td><input type="text" id="aotr" onKeyUp="formatAngka(this, ',');HitungTotal();" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td><b>DP</b></td>
								<td><input type="text" id="apersen" onKeyUp="HitungTotal();" value="25" style="width:50px;background-color:yellow;">%</td>
								<td><input type="text" id="ahasildp" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>PH</b></td>
								<td></td>
								<td><input type="text" id="aph" onBlur="HitungTotal();" style="border:0px;"readonly ></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>RATE</b></td>
								<td><input type="text" id="arate" onKeyUp="HitungTotal();" style="width:50px;background-color:yellow;" value="11.75">%</td>
								<td></td>
							</tr>
							<tr>
								<td><b>TAHUN</b></td>
								<td><input type="text" id="atahun" onKeyUp="HitungTotal();" style="width:50px;background-color:yellow;" value="3" > Tahun</td>
								<td></td>
							</tr>
							<tr>
								<td><b>BUNGA</b></td>
								<td><input type="text" id="abunga" onKeyUp="HitungTotal();" style="width:50px;border:0px;" readonly>%</td>
								<td><input type="text" id="ahasilbunga" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>TENOR</b></td>
								<td><input type="text" id="atenor" onKeyUp="HitungTotal();" style="width:50px;border:0px;" readonly> Bulan</td>
								<td></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>ASS</b></td>
								<td><input type="text" id="aass" onKeyUp="HitungTotal();" style="width:50px;background-color:yellow;" value="1.32">%</td>
								<td><input type="text" id="aasshasil" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>ADMIN</b></td>
								<td></td>
								<td><input type="text" id="aadmin" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td><b>PROVISI</b></td>
								<td></td>
								<td><input type="text" id="aprovisi" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td><b>POLIS</b></td>
								<td></td>
								<td><input type="text" id="apolis" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>TDP</b></td>
								<td></td>
								<td><input type="text" id="atdp" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
						</table>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	function HitungTotal() 
	{
		a = Number(angsuran.aangsuran.value.replace(/[^0-9\.]+/g,""));
		b = Number(angsuran.aotr.value.replace(/[^0-9\.]+/g,""));
		c = Number(angsuran.apersen.value.replace(/[^0-9\.]+/g,""));
		d = Number(angsuran.arate.value.replace(/[^0-9\.]+/g,""));
		e = Number(angsuran.atahun.value.replace(/[^0-9\.]+/g,""));
		f = Number(angsuran.aass.value.replace(/[^0-9\.]+/g,""));
		g = Number(angsuran.aadmin.value.replace(/[^0-9\.]+/g,""));
		h = Number(angsuran.aprovisi.value.replace(/[^0-9\.]+/g,""));
		i = Number(angsuran.apolis.value.replace(/[^0-9\.]+/g,""));
		z=c*b/100;
		y=d*e;
		aa=e*12;
		bb=a*aa;
		cc = y/100+1;
		x=bb/cc;
		w=x*y/100;
		v=b*f/100;
		u=(b-x)+v+g+i+a+h;
		angsuran.ahasildp.value = z.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.aph.value = x.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.abunga.value = y.toFixed(2).replace(/\d(?=(\d{2})+\.)/g, '$&,');
		angsuran.atenor.value = aa;
		angsuran.ahasilbunga.value = w.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.aasshasil.value = v.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.atdp.value = u.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	}
function formatAngka(objek, separator) 
{
  a = objek.value;
  b = a.replace(/[^\d]/g,"");
  c = "";
  panjang = b.length;
  j = 0;
  for (i = panjang; i > 0; i--) {
    j = j + 1;
    if (((j % 3) == 1) && (j != 1)) {
      c = b.substr(i-1,1) + separator + c;
    } else {
      c = b.substr(i-1,1) + c;
    }
  }
  objek.value = c;
}
</script>
<?PHP
	}
?>