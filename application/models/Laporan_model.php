<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
  public function getLaporanKSTM(){
     $query = "SELECT `laporan_kstm`.*, `user`.`name`
              FROM `laporan_kstm` JOIN `user`
              ON `laporan_kstm`.`id_pelapor` = `user`.`id`";
      return $this->db->query($query)->result_array();
  }
  public function getLaporanKSTMById($id){
     $query = "SELECT `laporan_kstm`.*, `user`.`name`
              FROM `laporan_kstm` JOIN `user`
              ON `laporan_kstm`.`id_pelapor` = `user`.`id`
              WHERE `laporan_kstm`.`id_laporan_kstm` = $id";
      return $this->db->query($query)->row_array();
  }
  public function getLaporanPengontrol(){
     $query = "SELECT `laporan_pengontrol`.*, `user`.`name`
              FROM `laporan_pengontrol` JOIN `user`
              ON `laporan_pengontrol`.`id_pelapor` = `user`.`id`";
      return $this->db->query($query)->result_array();
  }
  public function getLaporanPengontrolById($id){
     $query = "SELECT `laporan_pengontrol`.*, `user`.`name`
              FROM `laporan_pengontrol` JOIN `user`
              ON `laporan_pengontrol`.`id_pelapor` = `user`.`id`
              WHERE `laporan_pengontrol`.`id_laporan_pengontrol` = $id";
      return $this->db->query($query)->row_array();
  }

  public function getKomenKSTM($id){
     $query = "SELECT `tanggapan_kstm`.*, `user`.`name`,`user`.`image`
              FROM `tanggapan_kstm` JOIN `user`
              ON `tanggapan_kstm`.`id_penanggap` = `user`.`id`
              WHERE `tanggapan_kstm`.`id_laporan` = $id
              ORDER BY `tanggapan_kstm`.`tanggal_tanggapan` DESC";
      return $this->db->query($query)->result_array();
  }

  public function getKomenPengontrol($id){
     $query = "SELECT `tanggapan_pengontrol`.*, `user`.`name`,`user`.`image`
              FROM `tanggapan_pengontrol` JOIN `user`
              ON `tanggapan_pengontrol`.`id_penanggap` = `user`.`id`
              WHERE `tanggapan_pengontrol`.`id_laporan` = $id
              ORDER BY `tanggapan_pengontrol`.`tanggal_tanggapan` DESC";
      return $this->db->query($query)->result_array();
  }
}
