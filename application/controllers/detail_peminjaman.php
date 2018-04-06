<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Detail_Peminjaman extends CI_Controller {

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
		$this->load->view('detail_peminjaman_v');
	}
}