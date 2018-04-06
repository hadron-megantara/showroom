<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('supplier_v');
	}
	public function tambah_supplier()
	{
		$this->load->view('supplier_tambah_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('supplier_edit_v',$data);
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('supplier_detail_v',$data);
	}
	public function insert_data(){
		$this->db->set('nama', $this->input->post("nama"));
		$this->db->set('telp', $this->input->post("telepon"));
		$this->db->set('alamat', $this->input->post("alamat"));
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('supplier'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Supplier dengan Nama - ".$this->input->post("nama")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user'); 
		
		redirect("supplier","refresh");
	}
	public function edit_data(){
		$data = array(
          'nama'=>$this->input->post('nama'),
          'telp'=>$this->input->post('telepon'),
          'alamat'=>$this->input->post('alamat'),
          'updated'=>$this->input->post('iduser'),
        );
		$this->db->where('idsupplier',$this->input->post('iddata'));
		$this->db->update('supplier',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Supplier dengan Nama - ".$this->input->post("nama")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
			
		redirect("supplier","refresh");
	}
	public function delete_data(){
		$data = array(
          '_deleted'=>"1",
        );
		$this->db->where('idsupplier',$this->input->post('iddata'));
		$this->db->update('supplier',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Supplier dengan Nama - ".$this->input->post("nama")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "2");
		$this->db->insert('log_user'); 
		
		redirect("supplier","refresh");
	}
}