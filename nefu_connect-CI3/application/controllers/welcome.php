<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this -> load -> model('message_model');
		$message = $this -> message_model -> get_message();
		$this->load->helper('url');
		$this->load->view('index',array(
			'messages' => $message
		));
	}
	public function save_message(){
		$this -> load -> model('message_model');
	}
	public function user()
	{
		$this->load->helper('url');
		$this->load->view('user');
	}
	public function login()
	{
		$this->load->helper('url');
		$this->load->view('login');
	}
}
