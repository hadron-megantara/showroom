<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			$this->load->model('admin_m');
      		$this->load->database();
      		$this->load->helper(array('form', 'url'));
			$this->load->library('session');

		}
	public function index()
	{
		$this->load->view('login_v');
	}
	public function logout()
	{
		$this->session->unset_userdata("sm_username");
		$this->session->sess_destroy();
		redirect("login","refresh");
	}
	public function user_login()
    {
		$data['query'] = $this->admin_m->validate_login();
		if($data['query'] != null)
		{
			$sm_username = $this->input->post('username');
			$sessiondata = array('sm_username'=>$sm_username,'user'=>'TRUE');
			$this->session->set_userdata($sessiondata);
			$this->session->set_userdata('sm_username', $sm_username);
			$data['sm_username']=$this->session->userdata('sm_username');
			redirect("home","refresh");
		}
		else
		{
			redirect("login","refresh");
		}
    }
}