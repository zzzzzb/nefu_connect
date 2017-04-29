<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 13:13
 */
class Like_model extends CI_Model{

    public function get_msgId_by_user($user_id){
        $sql = "select * from t_like WHERE user_id = $user_id";
        return $this -> db -> query($sql) -> result();
    }
    public function save_like($msg_id,$user_id){
        $sql = "INSERT INTO t_like (msg_id, user_id) VALUES ($msg_id, $user_id)";
        return $this -> db -> query($sql) -> affect_rows();
    }

}