<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekapan_Omset extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('rekapan_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('Pdf');
			$this->load->library('newphpexcel');

		}
	public function index()
	{
		$this->load->view('rekapan_omset_v');
	}
	public function cari()
	{
		$this->load->view('rekapan_omset_cari_v');
	}
	function omset(){
		$arrdata = $this->rekapan_m->get_omset();
		echo $arrdata;
	}
	function omset_cabang(){
		$arrdata = $this->rekapan_m->get_omset_cabang();
		echo $arrdata;
	}
}