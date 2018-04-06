<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Batal_Penjualan extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('batal_penjualan_v');
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('detail_penjualan_detail_v',$data);
	}
	function batal($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('batal_penjualan_batal_v',$data);
	}
	public function delete_data(){
		if($this->input->post('Batal'))
		{
			$data = array(
			  '_deleted'=>"1",
			  'ket'=>$this->input->post('ketnya'),
			);
			$this->db->where('idpenjualan',$this->input->post('iddata'));
			$this->db->update('penjualan',$data); 
			
			$data = array(
			  'idpenjualan'=>"0",
			  'status'=>"Tersedia",
			  'tglspk'=>"0000-00-00",
			);
			$this->db->where('idpenjualan',$this->input->post('iddata'));
			$this->db->update('mobil',$data); 
			
			$this->db->set('username', $this->input->post("iduser"));
			$this->db->set('aktifitas', "Cancel Penjualan dengan Kode Penjualan - ".$this->input->post("iddata")."");
			$this->db->set('tanggal', $this->input->post("tanggaluser"));
			$this->db->set('jam', $this->input->post("jamuser"));
			$this->db->set('tipe', "2");
			$this->db->insert('log_user'); 
		}
		else
		{
			$data = array(
			  '_deleted'=>"2",
			  'ket'=>$this->input->post('ketnya'),
			);
			$this->db->where('idpenjualan',$this->input->post('iddata'));
			$this->db->update('penjualan',$data); 
			
			$data = array(
			  'idpenjualan'=>"0",
			  'status'=>"Tersedia",
			  'tglspk'=>"0000-00-00",
			);
			$this->db->where('idpenjualan',$this->input->post('iddata'));
			$this->db->update('mobil',$data); 
			
			$this->db->set('username', $this->input->post("iduser"));
			$this->db->set('aktifitas', "Cancel Penjualan dengan Kode Penjualan - ".$this->input->post("iddata")."");
			$this->db->set('tanggal', $this->input->post("tanggaluser"));
			$this->db->set('jam', $this->input->post("jamuser"));
			$this->db->set('tipe', "2");
			$this->db->insert('log_user'); 
		}
		
		redirect("batal_penjualan","refresh");
	}
}