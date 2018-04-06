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
			<h2><i class="fa fa-cog"></i> Upping OTR</h2>
			<div class="breadcrumb-wrapper">
				<ol class="breadcrumb">
					<li><a href="<?PHP echo base_url() ?>home">Sentral Group</a></li>
					<li><a href="<?PHP echo base_url() ?>home">Home</a></li>
					<li class="active">Upping OTR</li>
				</ol>
			</div>
		</div>
		<div class="contentpanel">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3>UPPING MRP</h3>
				</div>
				<div class="panel-body">
					<form name="angsuran">
					<div class="table-responsive">
					<br>
						<table border="1" class="table table-striped mb30">
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td width="100px" align="right"><b>MRP LEASING</b></td>
								<td width="100px"><input type="text" id="amrp" onKeyUp="formatAngka(this, ',');HitungTotal();" style="background-color:yellow;"></td>
								<td width="100px"><input type="text" id="apersen" onKeyUp="formatAngka(this, ',');HitungTotal();" style="width:50px;background-color:yellow;">%</td>
								<td width="100px"><input type="text" id="ahasil" onKeyUp="formatAngka(this, ',');HitungTotal();" style="border:0px;" readonly></td>
							</tr>
							<tr>
								<td width="100px"><b>OTR</b></td>
								<td width="100px"></td>
								<td width="100px"><input type="text" id="aotr" onKeyUp="formatAngka(this, ',');HitungTotal();" style="background-color:yellow;"></td>
								<td width="100px" align="center"><b>Diskon</b></td>
								<td width="100px"><b>OTR</b></td>
								<td width="100px"></td>
								<td width="100px"><input type="text" id="botr" onKeyUp="formatAngka(this, ',');HitungTotal();" style="border:0px;"></td>
							</tr>
							<tr>
								<td><b>DP</b></td>
								<td><input type="text" id="apersendp" onKeyUp="HitungTotal();" value="25" style="background-color:yellow;width:50px;">%</td>
								<td><input type="text" id="ahasildp" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
								<td><input type="text" id="adiskon" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
								<td><b>DP</b></td>
								<td><input type="text" id="bpersendp" onKeyUp="HitungTotal();" value="25" style="background-color:yellow;width:50px;">%</td>
								<td><input type="text" id="bhasildp" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>PH</b></td>
								<td></td>
								<td><input type="text" id="aph" onKeyUp="formatAngka(this, ',');HitungTotal();" style="border:0px;" readonly></td>
								<td></td>
								<td><b>PH</b></td>
								<td></td>
								<td><input type="text" id="bph" onKeyUp="formatAngka(this, ',');HitungTotal();" style="border:0px;" readonly></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>RATE</b></td>
								<td><input type="text" id="arate" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="10.75">%</td>
								<td></td>
								<td></td>
								<td><b>RATE</b></td>
								<td><input type="text" id="brate" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="10.75">%</td>
								<td></td>
							</tr>
							<tr>
								<td><b>TAHUN</b></td>
								<td><input type="text" id="atahun" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="4"> Tahun</td>
								<td></td>
								<td></td>
								<td><b>TAHUN</b></td>
								<td><input type="text" id="btahun" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="4"> Tahun</td>
								<td></td>
							</tr>
							<tr>
								<td><b>BUNGA</b></td>
								<td><input type="text" id="abunga" onKeyUp="HitungTotal();" style="border:0px;width:50px;" readonly>%</td>
								<td><input type="text" id="ahasilbunga" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
								<td></td>
								<td><b>BUNGA</b></td>
								<td><input type="text" id="bbunga" onKeyUp="HitungTotal();" style="border:0px;width:50px;" readonly>%</td>
								<td><input type="text" id="bhasilbunga" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>TENOR</b></td>
								<td><input type="text" id="atenor" onKeyUp="HitungTotal();" style="border:0px;width:50px;" readonly> Bulan</td>
								<td></td>
								<td></td>
								<td><b>TENOR</b></td>
								<td><input type="text" id="btenor" onKeyUp="HitungTotal();" style="border:0px;width:50px;" readonly> Bulan</td>
								<td></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>ASS</b></td>
								<td><input type="text" id="aass" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="2.75">%</td>
								<td><input type="text" id="aasshasil" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
								<td></td>
								<td><b>ASS</b></td>
								<td><input type="text" id="bass" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="2.75">%</td>
								<td><input type="text" id="basshasil" onBlur="HitungTotal();" style="border:0px;" readonly ></td>
							</tr>
							<tr>
								<td><b>ADMIN</b></td>
								<td></td>
								<td><input type="text" id="aadmin" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
								<td></td>
								<td><b>ADMIN</b></td>
								<td></td>
								<td><input type="text" id="badmin" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td><b>PROVISI</b></td>
								<td><input type="text" id="apersenprovisi" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="2">%</td>
								<td><input type="text" id="aprovisi" onKeyUp="HitungTotal();formatAngka(this, ',')" style="border:0px;" readonly></td>
								<td></td>
								<td><b>PROVISI</b></td>
								<td><input type="text" id="bpersenprovisi" onKeyUp="HitungTotal();" style="background-color:yellow;width:50px;" value="1">%</td>
								<td><input type="text" id="bprovisi" onKeyUp="HitungTotal();formatAngka(this, ',')" style="border:0px;" readonly></td>
							</tr>
							<tr>
								<td><b>POLIS</b></td>
								<td></td>
								<td><input type="text" id="apolis" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
								<td></td>
								<td><b>POLIS</b></td>
								<td></td>
								<td><input type="text" id="bpolis" onKeyUp="HitungTotal();formatAngka(this, ',')" style="background-color:yellow;"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>ANGSURAN</b></td>
								<td></td>
								<td><input type="text" id="aangsuran" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
								<td></td>
								<td><b>ANGSURAN</b></td>
								<td></td>
								<td><input type="text" id="bangsuran" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td><b>TDP</b></td>
								<td></td>
								<td><input type="text" id="atdp" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
								<td></td>
								<td><b>TDP</b></td>
								<td></td>
								<td><input type="text" id="btdp" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td><b>DP Bayar</b></td>
								<td></td>
								<td><input type="text" id="dpbayar" onKeyUp="HitungTotal();" style="border-color:red;border:0px;" readonly></td>
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
		a = Number(angsuran.amrp.value.replace(/[^0-9\.]+/g,""));
		b = Number(angsuran.apersen.value.replace(/[^0-9\.]+/g,""));
		c = Number(angsuran.aotr.value.replace(/[^0-9\.]+/g,""));
		d = Number(angsuran.apersendp.value.replace(/[^0-9\.]+/g,""));
		e = Number(angsuran.arate.value.replace(/[^0-9\.]+/g,""));
		f = Number(angsuran.atahun.value.replace(/[^0-9\.]+/g,""));
		g = Number(angsuran.aass.value.replace(/[^0-9\.]+/g,""));
		h = Number(angsuran.aadmin.value.replace(/[^0-9\.]+/g,""));
		i = Number(angsuran.apersenprovisi.value.replace(/[^0-9\.]+/g,""));
		j = Number(angsuran.apolis.value.replace(/[^0-9\.]+/g,""));
		z=a+(a*b/100);
		y=c*d/100;
		w=c-y;
		v=e*f;
		u=f*12;
		t=w*v/100;
		s=c*g/100;
		r=w*i/100;
		q=w*(v/100+1)/u;
		p=y+s+h+j+q+r;
		angsuran.ahasil.value = z.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.ahasildp.value = y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.aph.value = w.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.abunga.value = v.toFixed(2).replace(/\d(?=(\d{2})+\.)/g, '$&,');
		angsuran.atenor.value = u;
		angsuran.ahasilbunga.value = t.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.aasshasil.value = s.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.aprovisi.value = r.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.aangsuran.value = q.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.atdp.value = p.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		
		aa = Number(angsuran.bpersendp.value.replace(/[^0-9\.]+/g,""));
		bb = Number(angsuran.brate.value.replace(/[^0-9\.]+/g,""));
		cc = Number(angsuran.btahun.value.replace(/[^0-9\.]+/g,""));
		dd = Number(angsuran.bass.value.replace(/[^0-9\.]+/g,""));
		ee = Number(angsuran.badmin.value.replace(/[^0-9\.]+/g,""));
		ff = Number(angsuran.bpersenprovisi.value.replace(/[^0-9\.]+/g,""));
		gg = Number(angsuran.bprovisi.value.replace(/[^0-9\.]+/g,""));
		hh = Number(angsuran.bpolis.value.replace(/[^0-9\.]+/g,""));
		hh = Number(angsuran.bpolis.value.replace(/[^0-9\.]+/g,""));
		zz=z-c;
		yy=aa*z/100;
		xx=z-yy;
		ww=bb*cc;
		vv=cc*12;
		uu=xx*ww/100;
		tt=z*dd/100;
		ss=(xx*(ww/100+1))/vv;
		po=xx*ff/100;
		rr=yy+tt+ee+hh+ss+po;
		qq=rr-zz;
		angsuran.botr.value = z.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.adiskon.value = zz.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.bhasildp.value = yy.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.bph.value = xx.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.bbunga.value = ww.toFixed(2).replace(/\d(?=(\d{2})+\.)/g, '$&,');
		angsuran.btenor.value = vv;
		angsuran.bhasilbunga.value = uu.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.basshasil.value = tt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.bangsuran.value = ss.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.bprovisi.value = po.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.btdp.value = rr.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
		angsuran.dpbayar.value = qq.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
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