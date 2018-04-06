<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekapan_Spk extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('Pdf');

		}
	public function index()
	{
		$this->load->view('rekapan_spk_v');
	}
	public function cari()
	{
		$this->load->view('rekapan_spk_cari_v');
	}
}