<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penjualan_Cash extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('cart');

		}
	function deal($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('penjualan_cash_deal_v',$data);
	}
	public function index()
	{
		$this->load->view('penjualan_cash_v');
	}
	public function edit_data(){
		$dp1 = str_replace(",", "", $this->input->post('dp1'));
		$dp2 = str_replace(",", "", $this->input->post('dp2'));
		$dp3 = str_replace(",", "", $this->input->post('dp3'));
		$dp4 = str_replace(",", "", $this->input->post('dp4'));
		$dp5 = str_replace(",", "", $this->input->post('dp5'));
		$totalnya1 = str_replace(",", "", $this->input->post('totalnya1'));
		
		$data = array(
          'dp2'=>$dp1,
          'tgl2'=>$this->input->post('tgl1'),
          'ket2'=>$this->input->post('ket1'),
          'dp3'=>$dp2,
          'tgl3'=>$this->input->post('tgl2'),
          'ket3'=>$this->input->post('ket2'),
          'dp4'=>$dp3,
          'tgl4'=>$this->input->post('tgl3'),
          'ket4'=>$this->input->post('ket3'),
          'dp5'=>$dp4,
          'tgl5'=>$this->input->post('tgl4'),
          'ket5'=>$this->input->post('ket4'),
          'dp6'=>$dp5,
          'tgl6'=>$this->input->post('tgl5'),
          'ket6'=>$this->input->post('ket5'),
        );
		$this->db->where('iddtunai',$this->input->post('iddata'));
		$this->db->update('detail_tunai',$data); 
		
		$data = $this->db->query("
		SELECT hsdiscount
		FROM penjualan
		WHERE idpenjualan='".$this->input->post('iddata')."'
		")->result_array();	
			foreach($data as $row)
			{
				if($row['hsdiscount'] == $totalnya1)
				{
					$this->admin_m->ubahstatus_cash();
					$data = array(
					  'statjual'=>"Omset",
					  'tgl_pelunasan'=>$this->input->post('tgl5'),
					);
					$this->db->where('idpenjualan',$this->input->post('iddata'));
					$this->db->update('penjualan',$data); 
				}
			}
		if($this->input->post('dp1') == "0")
		{
		
		}
		else
		{
		
		}
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Pelunasan Cash dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("penjualan_cash","refresh");
	}
}