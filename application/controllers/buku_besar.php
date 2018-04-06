<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Buku_Besar extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('buku_besar_v');
	}
	public function cari()
	{
		$this->load->view('buku_besar_cari_v');
	}
}