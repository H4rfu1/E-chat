<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {
  public function getAllPengumuman(){
     $query = "SELECT `pemberitahuan`.*, `user_role`.`role`, `user`.`name`
              FROM `pemberitahuan`
              JOIN `user_role`
              ON `pemberitahuan`.`id_role` = `user_role`.`id`
              JOIN `user`
              ON `pemberitahuan`.`id_pengirim` = `user`.`id`";
      return $this->db->query($query)->result_array();
  }
  public function getRolePengumuman($role){
    $role = htmlspecialchars($role);
     $query = "SELECT `pemberitahuan`.*, `user`.`name`
              FROM `pemberitahuan`
              JOIN `user`
              ON `pemberitahuan`.`id_pengirim` = `user`.`id`
              WHERE `pemberitahuan`.`id_role` = $role";
      return $this->db->query($query)->result_array();
  }
}
