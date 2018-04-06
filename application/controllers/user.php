<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('user_v');
	}
	public function tambah_user()
	{
		$this->load->view('user_tambah_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('user_edit_v',$data);
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('user_detail_v',$data);
	}
	function log($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('user_log_v',$data);
	}
	public function insert_data(){
		$data['query'] = $this->admin_m->validate_user();
		if($data['query'] == null)
		{
			$this->db->set('username', $this->input->post("username"));
			$this->db->set('password', md5($this->input->post("password")));
			$this->db->set('nama', $this->input->post("nama"));
			$this->db->set('email', $this->input->post("email"));
			$this->db->set('telepon', $this->input->post("telepon"));
			$this->db->set('alamat', $this->input->post("alamat"));
			$this->db->set('_jabatan', $this->input->post("jabatan"));
			$this->db->set('_cabang', $this->input->post("cabang"));
			$this->db->set('entry', $this->input->post("entry"));
			$this->db->insert('user'); 
			
			redirect("user","refresh");
		}
		else
		{
			$this->load->view('user_tambah_v');
		}
	}
	public function edit_data(){
		$data = array(
          'nama'=>$this->input->post('nama'),
          'email'=>$this->input->post('email'),
          'telepon'=>$this->input->post('telepon'),
          'alamat'=>$this->input->post('alamat'),
          '_jabatan'=>$this->input->post('jabatan'),
          '_cabang'=>$this->input->post('cabang'),
        );
		$this->db->where('username',$this->input->post('username'));
		$this->db->update('user',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "User dengan Username - ".$this->input->post("username")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
			
		redirect("user","refresh");
	}
	public function delete_data(){
		$data = array(
          '_deleted'=>"1",
        );
		$this->db->where('username',$this->input->post('username'));
		$this->db->update('user',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "User dengan Username - ".$this->input->post("username")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "2");
		$this->db->insert('log_user'); 
		
		redirect("user","refresh");
	}
}