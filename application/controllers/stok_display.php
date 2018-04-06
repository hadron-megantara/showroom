<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stok_Display extends CI_Controller {

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
		$this->load->view('stok_display_v');
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('stok_display_detail_v',$data);
	}
	public function tambah_mobil()
	{
		$this->load->view('stok_display_tambah_v');
	}
	function edit($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('stok_display_edit_v',$data);
	}
	public function insert_data(){
		$hbeli = str_replace(",", "", $this->input->post('hbeli'));
		$hbengkel = str_replace(",", "", $this->input->post('hbengkel'));
		$hcat = str_replace(",", "", $this->input->post('hcat'));
		$hacc = str_replace(",", "", $this->input->post('hacc'));
		$hbbn = str_replace(",", "", $this->input->post('hbbn'));
		$hkomisi = str_replace(",", "", $this->input->post('hkomisi'));
		$hawal = str_replace(",", "", $this->input->post('hawal'));
		$hjual = str_replace(",", "", $this->input->post('hjual'));
		$hstnk = str_replace(",", "", $this->input->post('hstnk'));
		$hcash = str_replace(",", "", $this->input->post('hcash'));
		$hkredit = str_replace(",", "", $this->input->post('hkredit'));
		$bcasd = str_replace(",", "", $this->input->post('bcasd'));
		$blain = str_replace(",", "", $this->input->post('blain'));
		
		$this->db->set('idmobil', $this->input->post("nomormobil"));
		$this->db->set('_jenismobil', $this->input->post("jenis"));
		$this->db->set('tipemobil', $this->input->post("tipe"));
		$this->db->set('nopol', $this->input->post("nopol"));
		$this->db->set('tahun', $this->input->post("tahun"));
		$this->db->set('warna', $this->input->post("warna"));
		$this->db->set('tglmp', $this->input->post("tglmp"));
		$this->db->set('domisili', $this->input->post("domisili"));
		$this->db->set('bbn', $this->input->post("bbn"));
		$this->db->set('keterangan', $this->input->post("keterangan"));
		$this->db->set('hbeli', $hbeli);
		$this->db->set('hbengkel', $hbengkel);
		$this->db->set('hcat', $hcat);
		$this->db->set('hacc', $hacc);
		$this->db->set('hbbn', $hbbn);
		$this->db->set('hkomisi', $hkomisi);
		$this->db->set('hawal', $hawal);
		$this->db->set('hmax', $hjual);
		$this->db->set('hstnk', $hstnk);
		$this->db->set('hcash', $hcash);
		$this->db->set('hkredit', $hkredit);
		$this->db->set('hdealer', $bcasd);
		$this->db->set('hlain', $blain);
		$this->db->set('tglbeli', $this->input->post("tglbeli"));
		$this->db->set('_idsupplier', $this->input->post("supplier"));
		$this->db->set('_cabang', $this->input->post("cabang"));
		$this->db->set('ketbengkel', $this->input->post("ketbengkel"));
		$this->db->set('ketacc', $this->input->post("ketaksesoris"));
		$this->db->set('entry', $this->input->post("entry"));
		$this->db->set('updated', $this->input->post("iduser"));
		$this->db->insert('mobil'); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Mobil dengan Nomor Polisi - ".$this->input->post("nopol")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "0");
		$this->db->insert('log_user');
			
		redirect("stok_display","refresh");
	}
	public function edit_data(){
		$hbeli = str_replace(",", "", $this->input->post('hbeli'));
		$hbengkel = str_replace(",", "", $this->input->post('hbengkel'));
		$hcat = str_replace(",", "", $this->input->post('hcat'));
		$hacc = str_replace(",", "", $this->input->post('hacc'));
		$hbbn = str_replace(",", "", $this->input->post('hbbn'));
		$hkomisi = str_replace(",", "", $this->input->post('hkomisi'));
		$hawal = str_replace(",", "", $this->input->post('hawal'));
		$hjual = str_replace(",", "", $this->input->post('hjual'));
		$hstnk = str_replace(",", "", $this->input->post('hstnk'));
		$hcash = str_replace(",", "", $this->input->post('hcash'));
		$hkredit = str_replace(",", "", $this->input->post('hkredit'));
		$bcasd = str_replace(",", "", $this->input->post('bcasd'));
		$blain = str_replace(",", "", $this->input->post('blain'));
		
		$data = array(
          '_jenismobil'=>$this->input->post('jenis'),
          'tipemobil'=>$this->input->post('tipe'),
          'nopol'=>$this->input->post('nopol'),
          'tahun'=>$this->input->post('tahun'),
          'warna'=>$this->input->post('warna'),
          'tglmp'=>$this->input->post('tglmp'),
          'domisili'=>$this->input->post('domisili'),
          'bbn'=>$this->input->post('bbn'),
          'keterangan'=>$this->input->post('keterangan'),
          'hbeli'=>$hbeli,
          'hbengkel'=>$hbengkel,
          'hcat'=>$hcat,
          'hacc'=>$hacc,
          'hbbn'=>$hbbn,
          'hkomisi'=>$hkomisi,
          'hawal'=>$hawal,
          'hmax'=>$hjual,
          'hstnk'=>$hstnk,
          'hcash'=>$hcash,
          'hkredit'=>$hkredit,
          'hdealer'=>$bcasd,
          'hlain'=>$blain,
          'tglbeli'=>$this->input->post('tglbeli'),
          '_idsupplier'=>$this->input->post('supplier'),
          'updated'=>$this->input->post('iduser'),
          '_cabang'=>$this->input->post('cabang'),
          'ketbengkel'=>$this->input->post('ketbengkel'),
          'ketacc'=>$this->input->post('ketaksesoris'),
        );
		$this->db->where('idmobil',$this->input->post('nomormobil'));
		$this->db->update('mobil',$data); 
		
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Mobil dengan Nomor Polisi - ".$this->input->post("nopol")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("stok_display","refresh");
	}
}