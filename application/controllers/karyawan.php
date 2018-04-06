<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Karyawan extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('karyawan_v');
	}
	public function cari()
	{
		$this->load->view('karyawan_cari_v');
	}
	public function tambah_karyawan()
	{
		$this->load->view('karyawan_tambah_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('karyawan_edit_v',$data);
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('karyawan_detail_v',$data);
	}
	public function insert_data(){
		$uangmakan = str_replace(",", "", $this->input->post('uangmakan'));
		$gaji = str_replace(",", "", $this->input->post('gaji'));
		
		$this->db->set('noktp', $this->input->post("noktp"));
		$this->db->set('jabatan', $this->input->post("jabatan"));
		$this->db->set('nama', $this->input->post("nama"));
		$this->db->set('mulaikerja', $this->input->post("mulaikerja"));
		$this->db->set('tempatlahir', $this->input->post("tempatlahir"));
		$this->db->set('tgllahir', $this->input->post("tgllahir"));
		$this->db->set('alamatktp', $this->input->post("alamatktp"));
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('alamat', $this->input->post("alamat"));
		$this->db->set('gaji', $gaji);
		$this->db->set('telp', $this->input->post("telp"));
		$this->db->set('uangmakan', $uangmakan);
		$this->db->set('gender', $this->input->post("gender"));
		$this->db->set('_deleted', $this->input->post("status"));
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('karyawan'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Karyawan dengan Nama - ".$this->input->post("nama")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user'); 
		
		redirect("karyawan","refresh");
	}
	public function edit_data(){
		$uangmakan = str_replace(",", "", $this->input->post('uangmakan'));
		$gaji = str_replace(",", "", $this->input->post('gaji'));
		$data = array(
          'noktp'=>$this->input->post('noktp'),
          'jabatan'=>$this->input->post('jabatan'),
          'nama'=>$this->input->post('nama'),
          'mulaikerja'=>$this->input->post('mulaikerja'),
          'tempatlahir'=>$this->input->post('tempatlahir'),
          'tgllahir'=>$this->input->post('tgllahir'),
          'alamatktp'=>$this->input->post('alamatktp'),
          '_cabang'=>$this->input->post('cabang'),
          'alamat'=>$this->input->post('alamat'),
          'gaji'=>$gaji,
          'telp'=>$this->input->post('telp'),
          'uangmakan'=>$uangmakan,
          'gender'=>$this->input->post('gender'),
          '_deleted'=>$this->input->post('status'),
        );
		$this->db->where('idkaryawan',$this->input->post('iddata'));
		$this->db->update('karyawan',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Karyawan dengan Nama - ".$this->input->post("nama")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user'); 
			
		redirect("karyawan","refresh");
	}
	public function delete_data(){
		$data = array(
          '_deleted'=>"1",
        );
		$this->db->where('idkaryawan',$this->input->post('iddata'));
		$this->db->update('karyawan',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Karyawan dengan Nama - ".$this->input->post("nama_data")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "2");
		$this->db->insert('log_user'); 
		
		redirect("karyawan","refresh");
	}
}