<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/3
 * Time: 18:04
 */
class Upload extends CI_Controller {
    public function upload_portrait(){
        $loginedUser=$this->session->userdata("loginedUser");
        $config['upload_path']='./assets/img/user_portrait/';//设置上传路径
        $config['allowed_types']='gif|jpg|png|jpeg';//设置上传文件的格式
        $config['max-size']='3072';//设置文件的大小
        $config['file_name']=date("YmdHis").'_'.rand(10000,99999);//设置文件的文件名
        $this->load->library('upload',$config);
        $this->upload->do_upload('up_portrait');//表单里的name属性值
        $upload_data=$this->upload->data();

        if($upload_data['file_size']>0){
            $photo_url="assets/img/user_portrait/".$upload_data['file_name'];
            $this->load->model("user_model");
            $rows=$this->user_model->update_portrait($photo_url,$loginedUser->user_id);
            if($rows>0){
                redirect("welcome/user");
            }
        }
    }
}