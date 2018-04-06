<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ubah_Password extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('ubah_password_v');
	}
	public function edit_data(){
		$data = array(
          'password'=>md5($this->input->post("password")),
        );
		$this->db->where('username',$this->input->post('iduser'));
		$this->db->update('user',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Ubah Password dengan Username - ".$this->input->post("iduser")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
			
		redirect("home","refresh");
	}
}