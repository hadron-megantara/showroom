<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekap_Spk extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('cart');

		}
	function deal($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('rekap_spk_deal_v',$data);
	}
	public function index()
	{
		$this->load->view('rekap_spk_v');
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
		$this->db->set('aktifitas', "Rekap SPK dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("rekap_spk","refresh");
	}
}