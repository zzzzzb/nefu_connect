<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/23
 * Time: 16:53
 */
class Message_model extends CI_Model{

    public function get_message(){
        $sql = "select m.*,u.username,u.sex,u.portrait from t_message m,t_user u where m.user_id = u.user_id";
        return $this -> db -> query($sql) -> result();
    }
    public function save_message(){

    }
}