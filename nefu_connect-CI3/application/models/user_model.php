<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
    public function save($name,$password,$portrait){
        $this->db->insert("t_user",array(
            "username"=>$name,
            "password"=>$password,
            "portrait"=>$portrait
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
    public function get_comment_count($user_id){
        $sql="select count(*) num from t_comment where msg_id in (select msg_id from t_message where user_id=$user_id)";
        return $this->db->query($sql)->result();
    }
}