<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Detail_Penjualan extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
			$this->load->library('cart');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('detail_penjualan_v');
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('detail_penjualan_detail_v',$data);
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('detail_penjualan_edit_v',$data);
	}
	public function edit_cash(){
		$hargajual = str_replace(",", "", $this->input->post('hargajual'));
		$discount = str_replace(",", "", $this->input->post('discount'));
		$hsdiscount = str_replace(",", "", $this->input->post('hsdiscount'));
		
		$data = array(
          'tipebarang'=>$this->input->post('jenisbarang'),
          'hargajual'=>$hargajual,
          'discount'=>$discount,
          'hsdiscount'=>$hsdiscount,
          'tanggalspk'=>$this->input->post('tglspk'),
          '_cabang'=>$this->input->post('cabang'),
          'catatan'=>$this->input->post('catatan'),
          'updated'=>$this->input->post('iduser'),
        );
		$this->db->where('idpenjualan',$this->input->post('iddata'));
		$this->db->update('penjualan',$data);
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Detail Penjualan dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("detail_penjualan","refresh");
	}
	public function edit_kredit(){
		$hargajual = str_replace(",", "", $this->input->post('hargajual'));
		$discount = str_replace(",", "", $this->input->post('discount'));
		$hsdiscount = str_replace(",", "", $this->input->post('hsdiscount'));
		
		$angsuran = str_replace(",", "", $this->input->post('angsuran'));
		$dp = str_replace(",", "", $this->input->post('dp'));
		$biayaadm = str_replace(",", "", $this->input->post('biayaadm'));
		$asuransi = str_replace(",", "", $this->input->post('asuransi'));
		$profisi = str_replace(",", "", $this->input->post('profisi'));
		$biayaasuransi = str_replace(",", "", $this->input->post('biayaasuransi'));
		$totaldp = str_replace(",", "", $this->input->post('thdp'));
		$discountdp = str_replace(",", "", $this->input->post('discountdp'));
		$uangmuka = str_replace(",", "", $this->input->post('totaldp'));
		
		$data = array(
          'tipebarang'=>$this->input->post('jenisbarang'),
          'jangkawaktubunga'=>$this->input->post('jangkawaktubunga'),
          'hargajual'=>$hargajual,
          'discount'=>$discount,
          'hsdiscount'=>$hsdiscount,
          'angsuran'=>$angsuran,
          'dp'=>$dp,
          'biayaadm'=>$biayaadm,
          'asuransi'=>$asuransi,
          'profisi'=>$profisi,
          'biayaasuransi'=>$biayaasuransi,
          'totaldp'=>$totaldp,
          'discountdp'=>$discountdp,
          'uangmuka'=>$uangmuka,
          'totaldp'=>$totaldp,
          'tanggalspk'=>$this->input->post('tglspk'),
          '_kredit'=>$this->input->post('viakredit'),
          '_cabang'=>$this->input->post('cabang'),
          'catatan'=>$this->input->post('catatan'),
          'updated'=>$this->input->post('iduser'),
        );
		$this->db->where('idpenjualan',$this->input->post('iddata'));
		$this->db->update('penjualan',$data);
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Detail Penjualan dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("detail_penjualan","refresh");
	}
	public function deal_pelunasan(){
		$asuransi = str_replace(",", "", $this->input->post('asuransi'));
		$pelunasan = str_replace(",", "", $this->input->post('pelunasan'));
		$refund = str_replace(",", "", $this->input->post('refund'));
		$profisi = str_replace(",", "", $this->input->post('profisi'));
		
		$data = array(
          'p_asuransi'=>$asuransi,
          'p_pelunasan'=>$pelunasan,
          'p_refund'=>$refund,
          'p_profisi'=>$profisi,
          'tgl_asuransi'=>$this->input->post('tglasuransi'),
          'tgl_pelunasan'=>$this->input->post('tglpelunasan'),
          'tgl_refund'=>$this->input->post('tglrefund'),
          'tgl_profisi'=>$this->input->post('tglprofisi'),
        );
		$this->db->where('idpenjualan',$this->input->post('iddata'));
		$this->db->update('penjualan',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Detail Penjualan dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("detail_penjualan","refresh");
	}
	public function deal_po(){
		$nominalpo = str_replace(",", "", $this->input->post('nominalpo'));
		$data = array(
          'nopo'=>$this->input->post('nopo'),
          'tglpo'=>$this->input->post('tglpo'),
          'nominalpo'=>$nominalpo,
        );
		$this->db->where('idpenjualan',$this->input->post('iddata'));
		$this->db->update('penjualan',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Detail Penjualan dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("detail_penjualan","refresh");
	}	
	public function edit_data(){
		$dp1 = str_replace(",", "", $this->input->post('dp1'));
		$dp2 = str_replace(",", "", $this->input->post('dp2'));
		$dp3 = str_replace(",", "", $this->input->post('dp3'));
		$dp4 = str_replace(",", "", $this->input->post('dp4'));
		$dp5 = str_replace(",", "", $this->input->post('dp5'));
		$totalnya1 = str_replace(",", "", $this->input->post('totalnya1'));
		
		$data = array(
          'dp2'=>$dp1,
          'tgl2'=>$this->input->post('tgl1'),
          'dp3'=>$dp2,
          'tgl3'=>$this->input->post('tgl2'),
          'dp4'=>$dp3,
          'tgl4'=>$this->input->post('tgl3'),
          'dp5'=>$dp4,
          'tgl5'=>$this->input->post('tgl4'),
          'dp6'=>$dp5,
          'tgl6'=>$this->input->post('tgl5'),
        );
		$this->db->where('iddtunai',$this->input->post('iddata'));
		$this->db->update('detail_tunai',$data); 
		
			
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Detail Penjualan dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("detail_penjualan","refresh");
	}
	
	
}