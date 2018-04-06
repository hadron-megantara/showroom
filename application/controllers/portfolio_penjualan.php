<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Portfolio_Penjualan extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('portfolio_penjualan_v');
	}
	public function cari()
	{
		$this->load->view('portfolio_penjualan_cari_v');
	}
}