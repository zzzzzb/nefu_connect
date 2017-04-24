<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
