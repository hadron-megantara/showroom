<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_Omset extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('report_omset_v');
	}
	public function cari()
	{
		$this->load->view('report_omset_cari_v');
	}
}