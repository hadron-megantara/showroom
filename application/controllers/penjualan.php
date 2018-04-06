<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penjualan extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('cart');

		}
	public function index()
	{
		$this->load->view('penjualan_v');
	}
	public function item()
	{
		$this->load->view('penjualan_item_v');
	}
	public function input_cart(){
		$idmobil = $this->input->post("cidmobil");
		$merk = $this->input->post("cmerk");
		$tipemobil = $this->input->post("ctipemobil");
		$nopol = $this->input->post("cnopol");
		$warna = $this->input->post("cwarna");
		$harga = $this->input->post("chmax");
		$awal = $this->input->post("chawal");
		$data = array(
               'id'      => 1,
               'qty'     => 1,
               'price'   => $harga,
               'name'    => $tipemobil,
               'merk'    => $merk,
               'nopol'    => $nopol,
               'warna'    => $warna,
               'awal'    => $awal,
               'idmobil'    => $idmobil,
			   'types'	 => 'penjualan'
            );

		$this->cart->insert($data);
		redirect("penjualan",'refresh');
	}
	public function delete_cart(){
		$id = $this->input->post("cidmobil");
		$data = array(
				   'id'      => $id,
				   'qty'     => 1,
				   'price'   => 1,
				   'name'    => "-",
				   'merk'    => "-",
				   'nopol'    => "-",
				   'warna'    => "-",
				   'awal'    => "-",
               'idmobil'    => "-",
				   'types'	 => 'trash'
			   );
			$this->cart->insert($data);
		redirect("penjualan",'refresh');
	}
	
	public function insert_data_cash(){
		$hargatotal = str_replace(",", "", $this->input->post('hargatotal'));
		$hargajual = str_replace(",", "", $this->input->post('hargajual'));
		$hargamodal = str_replace(",", "", $this->input->post('hargamodal'));
		$tandajadi = str_replace(",", "", $this->input->post('tandajadi'));
		$discount = str_replace(",", "", $this->input->post('discount'));
		$hsdiscount = str_replace(",", "", $this->input->post('hsdiscount'));
		$hargamodal = str_replace(",", "", $this->input->post('hargamodal'));
		
		
		$this->db->set('pembeli', $this->input->post("pembeli"));
		$this->db->set('telepon', $this->input->post("telepon"));
		$this->db->set('alamat', $this->input->post("alamat"));
		$this->db->set('tipebayar', "Cash");
		$this->db->set('tipebarang', $this->input->post("jenisbarang"));
		$this->db->set('totalharga', $hargatotal);
		$this->db->set('hargajual', $hargajual);
		$this->db->set('hargamodal', $hargamodal);
		$this->db->set('tandajadi', $tandajadi);
		$this->db->set('discount', $discount);
		$this->db->set('hsdiscount', $hsdiscount);
		$this->db->set('tanggalspk', $this->input->post("tglspk"));
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('jangkawaktubunga', "0");
		$this->db->set('_kredit', "1");
		$this->db->set('angsuran', "0");
		$this->db->set('dp', "0");
		$this->db->set('biayaadm', "0");
		$this->db->set('asuransi', "0");
		$this->db->set('profisi', "0");
		$this->db->set('biayaasuransi', "0");
		$this->db->set('totaldp', "0");
		$this->db->set('discountdp', "0");
		$this->db->set('uangmuka', "0");
		$this->db->set('catatan', $this->input->post("catatan"));
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('penjualan'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Penjualan dengan Nomor Penjualan - ".$this->input->post("countid")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
		
		$this->db->set('nama', $this->input->post("pembeli"));
		$this->db->set('telp', $this->input->post("telepon"));
		$this->db->set('alamat', $this->input->post("alamat"));
		$this->db->insert('pembeli'); 
		
		foreach ( $this->cart->contents() as $cart )
		{
			if($cart['types'] == 'penjualan')
			{
				$insert['d_idpenjualan'] = $this->input->post("countid");
				$insert['d_idmobil'] = $cart['idmobil'];
				$insert['d_merk'] = $cart['merk'];
				$insert['d_tipemobil'] = $cart['name'];
				$insert['d_nopol'] = $cart['nopol'];
				$insert['d_warna'] = $cart['warna'];
				$insert['d_jual'] = $cart['price'];
				$insert['d_dasar'] = $cart['awal'];
				$insert['d_cabang'] = $this->input->post("cabang");
				$insert['d_tgl'] = $this->input->post("tglspk");
				$this->db->insert('detail_penjualan', $insert);
				
				$data = array(
				  'idpenjualan'=>$this->input->post("countid"),
				  'status'=>"Terjual-Cash",
				  'tglspk'=>$this->input->post("tglspk"),
				);
				$this->db->where('idmobil',$cart['idmobil']);
				$this->db->update('mobil',$data); 
				
				if($hsdiscount == $tandajadi)
				{
					$data = array(
					  'status'=>"Sold Out"
					);
					$this->db->where('idmobil',$cart['idmobil']);
					$this->db->update('mobil',$data); 
				}
				
			}
		} 
		$this->db->set('iddtunai', $this->input->post("countid"));
		$this->db->set('dp1', $tandajadi);
		$this->db->set('tgl1', $this->input->post("tglspk"));
		$this->db->insert('detail_tunai'); 
		
		if($hsdiscount == $tandajadi)
		{
				$data = array(
				  'statjual'=>"Omset",
				  'tgl_pelunasan'=>$this->input->post("tglspk"),
				);
				$this->db->where('idpenjualan',$this->input->post("countid"));
				$this->db->update('penjualan',$data); 
		}
		$data = $this->cart->destroy();
		redirect("penjualan","refresh");
	}
	public function insert_data_kredit(){
		$hargatotal = str_replace(",", "", $this->input->post('hargatotal'));
		$hargajual = str_replace(",", "", $this->input->post('hargajual'));
		$hargamodal = str_replace(",", "", $this->input->post('hargamodal'));
		$tandajadi = str_replace(",", "", $this->input->post('tandajadi'));
		$discount = str_replace(",", "", $this->input->post('discount'));
		$hsdiscount = str_replace(",", "", $this->input->post('hsdiscount'));
		$hargamodal = str_replace(",", "", $this->input->post('hargamodal'));
		
		$angsuran = str_replace(",", "", $this->input->post('angsuran'));
		$dp = str_replace(",", "", $this->input->post('dp'));
		$biayaadm = str_replace(",", "", $this->input->post('biayaadm'));
		$asuransi = str_replace(",", "", $this->input->post('asuransi'));
		$profisi = str_replace(",", "", $this->input->post('profisi'));
		$biayaasuransi = str_replace(",", "", $this->input->post('biayaasuransi'));
		$totaldp = str_replace(",", "", $this->input->post('thdp'));
		$discountdp = str_replace(",", "", $this->input->post('discountdp'));
		$uangmuka = str_replace(",", "", $this->input->post('totaldp'));
		
		
		$this->db->set('pembeli', $this->input->post("pembeli"));
		$this->db->set('telepon', $this->input->post("telepon"));
		$this->db->set('alamat', $this->input->post("alamat"));
		$this->db->set('tipebayar', "Kredit");
		$this->db->set('tipebarang', $this->input->post("jenisbarang"));
		$this->db->set('totalharga', $hargatotal);
		$this->db->set('hargajual', $hargajual);
		$this->db->set('hargamodal', $hargamodal);
		$this->db->set('tandajadi', $tandajadi);
		$this->db->set('discount', $discount);
		$this->db->set('hsdiscount', $hsdiscount);
		$this->db->set('tanggalspk', $this->input->post("tglspk"));
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('jangkawaktubunga', $this->input->post("jangkawaktubunga"));
		$this->db->set('_kredit', $this->input->post("viakredit"));
		$this->db->set('angsuran', $angsuran);
		$this->db->set('dp', $dp);
		$this->db->set('biayaadm', $biayaadm);
		$this->db->set('asuransi', $asuransi);
		$this->db->set('profisi', $profisi);
		$this->db->set('biayaasuransi', $biayaasuransi);
		$this->db->set('totaldp', $totaldp);
		$this->db->set('discountdp', $discountdp);
		$this->db->set('uangmuka', $uangmuka);
		$this->db->set('catatan', $this->input->post("catatan"));
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('penjualan'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Penjualan dengan Nomor Penjualan - ".$this->input->post("countid")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
		
		$this->db->set('nama', $this->input->post("pembeli"));
		$this->db->set('telp', $this->input->post("telepon"));
		$this->db->set('alamat', $this->input->post("alamat"));
		$this->db->insert('pembeli'); 
		
		foreach ( $this->cart->contents() as $cart )
		{
			if($cart['types'] == 'penjualan')
			{
				$insert['d_idpenjualan'] = $this->input->post("countid");
				$insert['d_idmobil'] = $cart['idmobil'];
				$insert['d_merk'] = $cart['merk'];
				$insert['d_tipemobil'] = $cart['name'];
				$insert['d_nopol'] = $cart['nopol'];
				$insert['d_warna'] = $cart['warna'];
				$insert['d_jual'] = $cart['price'];
				$insert['d_dasar'] = $cart['awal'];
				$insert['d_cabang'] = $this->input->post("cabang");
				$insert['d_tgl'] = $this->input->post("tglspk");
				$this->db->insert('detail_penjualan', $insert);
				
				$data = array(
				  'idpenjualan'=>$this->input->post("countid"),
				  'status'=>"Terjual-Kredit",
				  'tglspk'=>$this->input->post("tglspk"),
				);
				$this->db->where('idmobil',$cart['idmobil']);
				$this->db->update('mobil',$data); 
				
			}
		} 
		$this->db->set('iddtunai', $this->input->post("countid"));
		$this->db->set('dp1', $tandajadi);
		$this->db->set('tgl1', $this->input->post("tglspk"));
		$this->db->insert('detail_tunai'); 
		
		$data = $this->cart->destroy();
		redirect("penjualan","refresh");
	}
}