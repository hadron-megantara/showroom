<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Angsurantdp extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));

		}
	public function index()
	{
		$this->load->view('angsurantdp_v');
	}
}