<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model {
  public function getAkun(){
     $query = "SELECT `user`.*, `user_role`.`role`
              FROM `user` JOIN `user_role`
              ON `user`.`role_id` = `user_role`.`id`
              WHERE `user`.`role_id` != 1 AND `user`.`role_id` != 4";
      return $this->db->query($query)->result_array();
  }
  public function getAkunId($id){
    $id = htmlspecialchars($id);
     $query = "SELECT `user`.*, `user_role`.`role`
              FROM `user` JOIN `user_role`
              ON `user`.`role_id` = `user_role`.`id`
              WHERE `user`.`id` = $id";
      return $this->db->query($query)->row_array();
  }
}
