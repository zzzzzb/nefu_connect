<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
    public function save($name,$realname,$password,$portrait,$sex){
        $this->db->insert("t_user",array(
            "username"=>$name,
            "realname"=>$realname,
            "password"=>$password,
            "portrait"=>$portrait,
            "sex"=>$sex
        ));
        return $this->db->affected_rows();
    }
    public function get_by_name_pwd($name,$password){
        $query=$this->db->get_where('t_user',array(
            "username"=>$name,
            "password"=>$password
        ));
        return $query->row();
    }
    public function get_message_count($user_id){
        $sql="select count(*) num from t_message where user_id=$user_id";
        return $this->db->query($sql)->result();
    }
    public function get_love_count($user_id){
        $sql="SELECT count(*) num FROM t_like WHERE user_id=1";
        return $this->db->query($sql)->result();
    }
    public function get_name($name){
        $query=$this->db->get_where('t_user', array(
            'username' => $name
        ));
        return $query->row();
    }
}