<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stok_All extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
			$this->load->library('cart');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('newphpexcel');

		}
	public function index()
	{
		$this->load->view('stok_all_v');
	}
	function detail($iddata){
		$data["iddata"] = $iddata;
		$this->load->view('stok_all_detail_v',$data);
	}
	function keseluruhan(){
		$arrdata = $this->admin_m->get_keseluruhan();
		echo $arrdata;
	}
	function keseluruhan2(){
		$arrdata = $this->admin_m->get_keseluruhan2();
		echo $arrdata;
	}
}