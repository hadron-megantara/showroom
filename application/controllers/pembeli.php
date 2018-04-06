<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pembeli extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('pembeli_v');
	}
	function detail(){
		$data["iddata"] = $this->input->post("nama");
		$this->load->view('pembeli_detail_v',$data);
	}
}