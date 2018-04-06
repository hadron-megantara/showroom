<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekapan_Proses extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('rekapan_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('Pdf');
			$this->load->library('newphpexcel');

		}
	public function index()
	{
		$this->load->view('rekapan_proses_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('rekapan_proses_edit_v',$data);
	}
	public function edit_data(){
		$data = array(
          'ket'=>$this->input->post('data'),
        );
		$this->db->where('idpenjualan',$this->input->post('code'));
		$this->db->update('penjualan',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Rekapan Proses dengan Nomor Penjualan - ".$this->input->post("code")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
		
		redirect("rekapan_proses","refresh");
	}
	function all(){
		$arrdata = $this->rekapan_m->get_all();
		echo $arrdata;
	}
	function cash(){
		$arrdata = $this->rekapan_m->get_cash();
		echo $arrdata;
	}
	function spo(){
		$arrdata = $this->rekapan_m->get_spo();
		echo $arrdata;
	}
	function bpo(){
		$arrdata = $this->rekapan_m->get_bpo();
		echo $arrdata;
	}
}