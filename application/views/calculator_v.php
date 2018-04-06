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
	<link rel="stylesheet" href="<?PHP echo base_url() ?>assets/css/bootstrap-timepicker.min.css" />
	<script src="<?PHP echo base_url() ?>assets/js/jquery-1.10.2.min.js"></script>
	<script src="<?PHP echo base_url() ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?PHP echo base_url() ?>assets/js/bootstrap-timepicker.min.js"></script>
	<script src="<?PHP echo base_url() ?>assets/js/jquery-ui-1.10.3.min.js"></script>
	<div class="mainpanel">
		<div class="headerbar">
		  <a class="menutoggle"><i class="fa fa-bars"></i></a>
		</div>
		<div class="pageheader">
			<h2><i class="fa fa-cog"></i> Calculator</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Calculator</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3>ANGSURAN, TDP ?</h3>
				</div>
				<div class="panel-body">
					<form name="angsurantdp">
					<div class="table-responsive">
						<table border="2">
							<tr>
								<td width="150px"><b>OTR</b></td>
								<td width="150px"></td>
								<td width="150px"><input type="text" id="aotr" onKeyUp="formatAngka(this, ',');HitungTotal();" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td><b>DP</b></td>
								<td><input type="text" id="apersen" onKeyUp="HitungTotal();" value="25" style="background-color:yellow;"></td>
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
								<td><input type="text" id="arate" onKeyUp="HitungTotal();" style="background-color:yellow;"></td>
								<td></td>
							</tr>
							<tr>
								<td><b>TAHUN</b></td>
								<td><input type="text" id="atahun" onKeyUp="HitungTotal();" style="background-color:yellow;"></td>
								<td></td>
							</tr>
							<tr>
								<td><b>BUNGA</b></td>
								<td><input type="text" id="abunga" onKeyUp="HitungTotal();" style="border:0px;" readonly></td>
								<td><input type="text" id="ahasilbunga" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>TENOR</b></td>
								<td><input type="text" id="atenor" onKeyUp="HitungTotal();" style="border:0px;" readonly></td>
								<td></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>ASS</b></td>
								<td><input type="text" id="aass" onKeyUp="HitungTotal();" style="background-color:yellow;"></td>
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
								<td><b>ANGSURAN</b></td>
								<td></td>
								<td><input type="text" id="aangsuran" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>TOTAL DP</b></td>
								<td></td>
								<td><input type="text" id="atdp" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
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
		a = Number(angsurantdp.aotr.value.replace(/[^0-9\.]+/g,""));
		b = Number(angsurantdp.apersen.value.replace(/[^0-9\.]+/g,""));
		c = Number(angsurantdp.arate.value.replace(/[^0-9\.]+/g,""));
		d = Number(angsurantdp.atahun.value.replace(/[^0-9\.]+/g,""));
		e = Number(angsurantdp.aass.value.replace(/[^0-9\.]+/g,""));
		f = Number(angsurantdp.aadmin.value.replace(/[^0-9\.]+/g,""));
		g = Number(angsurantdp.aprovisi.value.replace(/[^0-9\.]+/g,""));
		h = Number(angsurantdp.apolis.value.replace(/[^0-9\.]+/g,""));
		z = a*b/100;
		y = a-z;
		x = c*d;
		w = d*12;
		v = y*x/100;
		u = a*e/100;
		ha = x/100+1;
		t=y*ha/w;
		mi=u+f+g+h;
		s=z+t+mi;
		angsurantdp.ahasildp.value = z.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsurantdp.aph.value = y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsurantdp.abunga.value = x;
		angsurantdp.atenor.value = w;
		angsurantdp.ahasilbunga.value = v.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsurantdp.aasshasil.value = u.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsurantdp.aangsuran.value = t.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsurantdp.atdp.value = s.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
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