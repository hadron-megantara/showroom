<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Via_Kredit extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('via_kredit_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('via_kredit_edit_v',$data);
	}
	public function edit_data(){
		$data = array(
          'data'=>$this->input->post('data'),
        );
		$this->db->where('code',$this->input->post('code'));
		$this->db->update('_kredit',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Via Kredit dengan Nama - ".$this->input->post("data")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
		
		redirect("via_kredit","refresh");
	}
	public function delete_data(){
		$data = array(
          '_deleted'=>"1",
        );
		$this->db->where('code',$this->input->post('code'));
		$this->db->update('_kredit',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Via Kredit dengan Nama - ".$this->input->post("data")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "2");
		$this->db->insert('log_user'); 
		
		redirect("via_kredit","refresh");
	}
	public function tambah_data(){
		$this->db->set('data', $this->input->post("nama"));
		$this->db->insert('_kredit'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Via Kredit dengan Nama - ".$this->input->post("nama")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
			
		redirect("via_kredit","refresh");
	}
}