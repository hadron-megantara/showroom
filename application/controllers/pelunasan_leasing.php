<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pelunasan_Leasing extends CI_Controller {

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
		$this->load->view('pelunasan_leasing_deal_v',$data);
	}
	public function index()
	{
		$this->load->view('pelunasan_leasing_v');
	}
	public function deal_pelunasan(){
		$asuransi = str_replace(",", "", $this->input->post('asuransi'));
		$pelunasan = str_replace(",", "", $this->input->post('pelunasan'));
		$refund = str_replace(",", "", $this->input->post('refund'));
		$profisi = str_replace(",", "", $this->input->post('profisi'));
		
		$data = array(
          'p_asuransi'=>$asuransi,
          'p_pelunasan'=>$pelunasan,
          'p_refund'=>$refund,
          'p_profisi'=>$profisi,
          'tgl_asuransi'=>$this->input->post('tglasuransi'),
          'tgl_pelunasan'=>$this->input->post('tglpelunasan'),
          'tgl_refund'=>$this->input->post('tglrefund'),
          'tgl_profisi'=>$this->input->post('tglprofisi'),
        );
		$this->db->where('idpenjualan',$this->input->post('iddata'));
		$this->db->update('penjualan',$data); 
		
		$data = $this->db->query("
		SELECT *
		FROM penjualan
		WHERE idpenjualan='".$this->input->post('iddata')."'
		")->result_array();	
			foreach($data as $row)
			{
				if($this->input->post('tgl_asuransi') != '0000-00-00' && $this->input->post('tgl_pelunasan') != '0000-00-00' && $this->input->post('tgl_refund') != '0000-00-00' && $this->input->post('tglprofisi') != '0000-00-00')
				{
					$this->admin_m->ubahstatus_cash();
					$data = array(
					  'statjual'=>"Omset",
					);
					$this->db->where('idpenjualan',$this->input->post('iddata'));
					$this->db->update('penjualan',$data); 
				}
			}
		$this->db->set('username', $this->input->post("iduser"));
		$this->db->set('aktifitas', "Pelunasan Kredit dengan Id Penjualan - ".$this->input->post("iddata")."");
		$this->db->set('tanggal', $this->input->post("tanggaluser"));
		$this->db->set('jam', $this->input->post("jamuser"));
		$this->db->set('tipe', "1");
		$this->db->insert('log_user');
		
		redirect("pelunasan_leasing","refresh");
	}
}