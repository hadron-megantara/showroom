<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Target extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('target_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('target_edit_v',$data);
	}
	public function edit_data(){
		$data = array(
          'target_po'=>$this->input->post('po'),
          'target_omset'=>$this->input->post('omset'),
        );
		$this->db->where('code',$this->input->post('iddata'));
		$this->db->update('_target',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Target dengan Tanggal - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
		
		redirect("target","refresh");
	}
	public function tambah_data(){
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('tgl', $this->input->post("tahun")."-".$this->input->post("bulan")."-01");
		$this->db->set('target_po', $this->input->post("po"));
		$this->db->set('target_omset', $this->input->post("omset"));
		$this->db->insert('_target'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Target dengan Tanggal - ".$this->input->post("tahun")."-".$this->input->post("bulan")."-01"."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
			
		redirect("target","refresh");
	}
	public function hapus_data(){
		$this->db->where('code',$this->input->post('iddata'));
		$this->db->delete('_target'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Target dengan Tanggal - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "2");
		$this->db->insert('log_user'); 
		
		redirect("target","refresh");
	}
}