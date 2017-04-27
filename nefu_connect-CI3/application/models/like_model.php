<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 13:13
 */
class Like_model extends CI_Model{

    public function get_msgId_by_user(){
        $sql = "select * from t_like";
        return $this -> db -> query($sql) -> result();
    }

}