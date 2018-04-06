<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terjual_Cash extends CI_Controller {

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
		$this->load->view('terjual_cash_v');
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('terjual_cash_detail_v',$data);
	}
}