<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Peminjaman extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('cart');

		}
	public function index()
	{
		$this->load->view('peminjaman_v');
	}
	public function tambah_peminjaman()
	{
		$this->load->view('peminjaman_tambah_v');
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('peminjaman_detail_v',$data);
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('peminjaman_edit_v',$data);
	}
	function bayar($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('peminjaman_bayar_v',$data);
	}
	public function insert_data(){
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		
		$this->db->set('_idkaryawan', $this->input->post("karyawan"));
		$this->db->set('jatuhtempo', $this->input->post("jatuhtempo"));
		$this->db->set('jumlah', $jumlah);
		$this->db->set('catatan', $this->input->post("catatan"));
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('detail_peminjaman'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Peminjaman dengan Kode Peminjaman - ".$this->input->post("idpeminjaman")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
			
		redirect("peminjaman","refresh");
	}
	public function edit_data(){
		$jumlah = str_replace(",", "", $this->input->post('jumlah'));
		
		$data = array(
          '_idkaryawan'=>$this->input->post('karyawan'),
          'jatuhtempo'=>$this->input->post('jatuhtempo'),
          'jumlah'=>$jumlah,
          'catatan'=>$this->input->post('catatan'),
          'updated'=>$this->input->post('iduser'),
        );
		$this->db->where('idpeminjaman',$this->input->post('iddata'));
		$this->db->update('detail_peminjaman',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Peminjaman dengan Kode Peminjaman - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("peminjaman","refresh");
	}
	public function delete_data(){
		$data = array(
          '_deleted'=>"1",
        );
		$this->db->where('idpeminjaman',$this->input->post('iddata'));
		$this->db->update('detail_peminjaman',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Peminjaman dengan Kode Peminjaman - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "2");
		$this->db->insert('log_user');
		
		redirect("peminjaman","refresh");
	}
	public function bayar_data(){
		$dibayar = str_replace(",", "", $this->input->post('dibayar'));
		
		$data = array(
          'dibayar'=>$dibayar+ $this->input->post('sebelum'),
        );
		$this->db->where('idpeminjaman',$this->input->post('iddata'));
		$this->db->update('detail_peminjaman',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Peminjaman dengan Kode Peminjaman - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("peminjaman","refresh");
	}
}