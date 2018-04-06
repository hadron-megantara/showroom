<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stok_HO extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('rekapan_m');
			$this->load->library('cart');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('newphpexcel');

		}
	public function index()
	{
		$this->load->view('stok_ho_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('stok_ho_edit_v',$data);
	}
	public function edit_data(){
		
		$data = array(
          'wait'=>$this->input->post('wait'),
          'bengkel'=>$this->input->post('bengkel'),
          'catpoles'=>$this->input->post('catpoles'),
          'variasi'=>$this->input->post('variasi'),
          'salon'=>$this->input->post('salon'),
          'ket'=>$this->input->post('ket'),
          'perkiraan'=>$this->input->post('perkiraan'),
        );
		$this->db->where('idmobil',$this->input->post('nomormobil'));
		$this->db->update('mobil',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Mobil dengan Nomor Mobil - ".$this->input->post("nomormobil")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("stok_ho","refresh");
	}
	function ho(){
		$arrdata = $this->rekapan_m->get_ho();
		echo $arrdata;
	}
}