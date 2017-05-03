<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function test(){
		$this->load->view('test');
	}
	/*首页功能开始*/
	public function index()
	{
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser){
			$this -> load -> model('message_model');
			$this -> load -> model('like_model');
			$message = $this -> message_model -> get_message();
			$result = $this -> like_model -> get_msgId_by_user($loginedUser->user_id);
			$this->load->view('index',array(
					'messages' => $message,
					'results' => $result,
					'is_login' => 'yes'
			));
		}else{
			$this -> load -> model('message_model');
			$message = $this -> message_model -> get_message();
			$this->load->view('index',array(
					'messages' => $message,
					'results' => '',
					'is_login' => 'no'
			));
		}

	}
	public function save_message(){
		$this->load->helper('security');
		$loginedUser=$this->session->userdata("loginedUser");
		$content=xss_clean($this->input->post("content"));
		$anonymity=$this->input->post("anonymity");
		$this -> load -> model('message_model');
		$results=$this->message_model->save_message($content,$anonymity,$loginedUser->user_id);
		if($results>0){
			redirect("welcome/index");
		}
	}
	public function details(){
		$loginedUser=$this->session->userdata("loginedUser");
		$msg_id=$this->input->get("msg_id");
		$this->load->model('message_model');
		$this->load->model('comment_model');
		$detail=$this->message_model->get_message_details($msg_id);
		$comment=$this->comment_model->get_comment_details($msg_id);
		if($loginedUser){
			$is_login=1;
		}else{
			$is_login=0;
		}
		$this->load->view("details",array(
				'detail'=>$detail,
				'comments'=>$comment,
				'is_login'=>$is_login
		));
	}
	public function add_like(){
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser){
			$ids = $this->input->get('ids');
			$this -> load -> model('message_model');
			$this -> load -> model('like_model');
			$rows_1 = $this->message_model->add_like($ids);
			$rows_2 = $this->like_model->save_like($ids,$loginedUser->user_id);
			if($rows_1 && $rows_2){
				echo 'success';
			}else{
				echo 'fail';
			}
		}else{
			echo 'fail';
		}
	}
	public function reduce_like(){
		$loginedUser=$this->session->userdata("loginedUser");
		$ids = $this->input->get('ids');
		$this -> load -> model('message_model');
		$this -> load -> model('like_model');
		$rows_1 = $this->message_model->reduce_like($ids);
		$rows_2 = $this->like_model->delete_like($ids,$loginedUser->user_id);
		$rows = $rows_1 && $rows_2;
		if($rows){
			echo 'success';
		}else{
			echo 'fail';
		}
	}
	public function add_comment(){
		$this->load->helper('security');
		$loginedUser=$this->session->userdata("loginedUser");
		$content=xss_clean($this->input->post("comment"));
		$msg_id=$this->input->post("hid_msg_id");
		$this->load->model("comment_model");
		$this->comment_model->add_com_num($msg_id);
		$this->comment_model->add_com($content,$msg_id,$loginedUser->user_id);
		redirect("welcome/details?msg_id=$msg_id");
	}
	/*首页功能结束*/
	/*用户页功能开始*/
	public function user()
	{
		$loginedUser=$this->session->userdata("loginedUser");
		if($loginedUser) {
			$this->load->model('user_model');
			$msg_count = $this->user_model->get_message_count($loginedUser->user_id);
			$com_count = $this->user_model->get_love_count($loginedUser->user_id);
			$this->load->view('user', array(
					"msg_counts" => $msg_count,
					"com_counts" => $com_count
			));
		}else{
			redirect("welcome/login");
		}
	}
	public function login()
	{
		$this->load->view('login',array(
				'is_logined'=>true
		));
	}
	public function no_login(){
		$this->load->view('login',array(
				'is_logined'=>false
		));
	}
	public function check_reg_name(){
		$name=$this->input->get("str");
		$this->load->model('user_model');
		if($name){
			$row = $this->user_model->get_name($name);
			if($name == ''){
				echo 'blank_fail';
			}else if(strstr($name,"<")){
				echo 'fail';
			}else if(strstr($name,"=")){
				echo 'fail';
			}else if(strstr($name,"'")){
				echo 'fail';
			}else if($row){
				echo 'repeat_fail';
			}else if(strstr($name," ")){
				echo 'none_fail';
			}else{
				echo 'success';
			}
		}
	}
	public function check_reg_realname(){
		$realname =$this->input->get("str");
		if($realname){
			if(strstr($realname,"<")){
				echo 'fail';
			}else if(strstr($realname,"=")){
				echo 'none_fail';
			}else if(strstr($realname,"'")){
				echo 'fail';
			}else if(strstr($realname,"or")){
				echo 'fail';
			}else{
				echo "success";
			}
		}
	}
	public function check_reg_pass(){
		$pass =$this->input->get("str");
		$low_pass = array('asdfgh',123456,666666,333333,222222,111111,999999,888888,'qwerty','zxcvbn',123456789,1234567);
		if(strstr($pass," ")){
			echo 'none_fail';
		}else{
			$flag = 'fail';
			foreach($low_pass as $pas){
				if($pass == $pas){
					$flag = 'fail';
					break;
				}else{
					$flag = 'success';
				}
			}
			echo $flag;
		}
	}
	public function reg(){
		$name=$this->input->post("name");
		$realname =$this->input->post("realname");
		$password=$this->input->post("password");
		$md5_pass = md5($password);
		$portrait="assets/img/default.jpg";
		$sex=$this->input->post("sex");
		$this->load->model("user_model");
		$results=$this->user_model->save($name,$realname,$md5_pass,$portrait,$sex);
		if($name=='' or $realname=='' or $password==''){
			echo '<script>alert("抱歉，发生未知错误，注册失败");top.location=\'login\';</script>';
		}else if($results>0){
			echo '<script>alert("注册成功！");top.location=\'login\';</script>';
		}
	}
	public function do_login(){
		$name=$this->input->post("name");
		$password=$this->input->post("password");
		$md5_pass=md5($password);
		$this->load->model('user_model');
		$row=$this->user_model->get_by_name_pwd($name,$md5_pass);
		if($row){
			$this->session->set_userdata("loginedUser",$row);
			redirect("welcome/user");
		}else{
			redirect("welcome/no_login");
		}
	}
	public function exit_login(){
		$this->session->unset_userdata("loginedUser");
		$this->load->view('login',array(
				'is_logined'=>true
		));
	}
	public function your_msg(){
		$loginedUser=$this->session->userdata("loginedUser");
		$this->load->model('message_model');
		$this -> load -> model('like_model');
		$message=$this->message_model->get_your_msg($loginedUser->user_id);
		$result = $this -> like_model -> get_msgId_by_user($loginedUser->user_id);
		$this->load->view('page',array(
				'messages'=>$message,
				'results'=>$result
		));
	}
	public function your_love(){
		$loginedUser=$this->session->userdata("loginedUser");
		$this->load->model('message_model');
		$this -> load -> model('like_model');
		$message=$this->message_model->get_your_love($loginedUser->user_id);
		$result = $this -> like_model -> get_msgId_by_user($loginedUser->user_id);
		$this->load->view('love',array(
				'messages'=>$message,
				'results'=>$result
		));
	}
	/*用户页功能结束*/
	/*修改资料，密码功能开始*/
	public function update_info(){
		$loginedUser=$this->session->userdata("loginedUser");
		$this->load->view('update_info',array(
				'loginedUser'=>$loginedUser
		));
	}
	public function update_realname(){
		$loginedUser=$this->session->userdata("loginedUser");
		$realname=$this->input->post('realname');
		$this->load->model('user_model');
		$rows = $this->user_model->update_realname($loginedUser->user_id,$realname);
		$row = $this -> user_model -> get_by_user_id($loginedUser->user_id);
		if($rows){
			$this -> session -> set_userdata('loginedUser',$row);
			echo '<script>alert("修改成功！");top.location=\'user\';</script>';
		}
	}

	public function update_pass(){
		$this->load->view('update_pass');
	}
	public function new_pass(){
		$old_pass=md5($this->input->post('old_pass'));
		$this->load->model('user_model');
		$loginedUser=$this->session->userdata("loginedUser");
		$row=$this->user_model->get_by_Id_pwd($loginedUser->user_id,$old_pass);
		if($row){
			$new_pass=md5($this->input->post('password'));
			$result = $this->user_model->new_pass($loginedUser->user_id,$new_pass);
			if($result){
				$this->session->unset_userdata("loginedUser");
				echo '<script>alert("修改成功！");top.location=\'login\';</script>';
			}else{
				echo '<script>alert("修改失败！");top.location=\'user\';</script>';
			}

		}else{
			echo '<script>alert("当前密码错误！");top.location=\'update_pass\';</script>';
		}

	}
	/*修改资料，密码功能结束*/

}
