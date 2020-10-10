<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {
  public function getAllForum(){
     $query = "SELECT `forum`.*, `user`.`name`
              FROM `forum` JOIN `user`
              ON `forum`.`id_pembuat` = `user`.`id`
              ORDER BY `forum`.`tanggal_dibuat` DESC";
      return $this->db->query($query)->result_array();
  }
  public function getSearchForum($keyword){
     $query = "SELECT `forum`.*, `user`.`name`
              FROM `forum` JOIN `user`
              ON `forum`.`id_pembuat` = `user`.`id`
              WHERE `forum`.`keterangan_bahasan` LIKE '%".$keyword."%' OR
              `user`.`name` LIKE '%".$keyword."%' OR
              `forum`.`topik_bahasan` LIKE '%".$keyword."%'
              ORDER BY `forum`.`tanggal_dibuat` DESC";
      return $this->db->query($query)->result_array();
  }
  public function getCertainForum($id){
    $id = htmlspecialchars($id);
     $query = "SELECT `forum`.*, `user`.`name`
              FROM `forum` JOIN `user`
              ON `forum`.`id_pembuat` = `user`.`id`
              WHERE `forum`.`id_forum` = $id";
      return $this->db->query($query)->row_array();
  }
  public function getKomen($id){
    $id = htmlspecialchars($id);
     $query = "SELECT `tanggapan_forum`.*, `user`.`name`,`user`.`image`
              FROM `tanggapan_forum` JOIN `user`
              ON `tanggapan_forum`.`id_penanggap` = `user`.`id`
              WHERE `tanggapan_forum`.`id_forum` = $id
              ORDER BY `tanggapan_forum`.`tanggal_tanggapan` DESC";
      return $this->db->query($query)->result_array();
  }
}
