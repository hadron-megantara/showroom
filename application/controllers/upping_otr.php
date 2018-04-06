<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upping_OTR extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('upping_otr_v');
	}
}