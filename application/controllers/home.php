<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->dbutil();
			$this->load->helper('download');
		}
	public function index()
	{
		$this->load->view('home_v');
	}
}