<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengontrol extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
  }

  public function index(){
    $breadcrumb         = array(
            "Laporan Pengontrol" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Kelola Laporan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $id_user = $this->session->userdata('id');
    $this->db->where("id_pelapor = $id_user");
    $data['laporan_pengontrol'] = $this->db->get('laporan_pengontrol')->result_array();


    $this->form_validation->set_rules('deskripsi_laporan','Deskripsi_laporan', 'required', [
      'required' => "Deskripsi laporan harus diisi"]);
    $this->form_validation->set_rules('jenis_ternak','Jenis_ternak', 'required', [
      'required' => "Jenis ternak harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sebelumnya','Jumlah_ternak_sebelumnya', 'required', [
      'required' => "Jumlah ternak sebelumnya harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sekarang','Jumlah_ternak_sekarang', 'required', [
      'required' => "Jumlah ternak sekarang harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_meninggal','Jumlah_ternak_meninggal', 'required', [
      'required' => "Jumlah ternak meninggal harus diisi"]);
    $this->form_validation->set_rules('keterangan_ternak_meninggal','Keterangan_ternak_meninggal', 'required', [
      'required' => "Keterangan ternak meninggal harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sehat','Jumlah_ternak_sehat', 'required', [
      'required' => "Jumlah ternak sehat harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sakit','Jumlah_ternak_sakit', 'required', [
      'required' => "Jumlah ternak sakit harus diisi"]);
    $this->form_validation->set_rules('keterangan_kesehatan_ternak','Keterangan_kesehatan_ternak', 'required', [
      'required' => "Keterangan kesehatan ernak harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_dikonsumsi','Jumlah_ternak_dikonsumsi', 'required', [
      'required' => "Jumlah ternak dikonsumsi harus diisi"]);
    $this->form_validation->set_rules('keterangan_konsumsi','Keterangan_konsumsi', 'required', [
      'required' => "Keterangan konsumsi harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_dijual','Jumlah_ternak_dijual', 'required', [
      'required' => "Jumlah ternak dijual harus diisi"]);
    $this->form_validation->set_rules('harga_ternak_perekor','Harga_ternak_perekor', 'required', [
      'required' => "Harga ternak perekor harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('pengontrol/index', $data);
      $this->load->view('templates/dash_footer');
    }else {
      $new_img = '';
      $new_vid = '';
      // cek jika ada gambar terupload
      if ($_FILES['image']['size'] != 0) {
        $upload_img = $_FILES['image']['name'];
        if($upload_img){
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size']     = '1024';
          $config['upload_path'] = './assets/img/profile';

          $this->load->library('upload', $config);

          if($this->upload->do_upload('image')){
            $new_img = $this->upload->data('file_name');
          }
        }
      }

      // cek jika ada video terupload
      if ($_FILES['video']['size'] == 0) {
        $upload_vid = $_FILES['video']['name'];
        if($upload_vid){
          $config['allowed_types'] = 'mp4|3gp|avi|flv|webm|wmv';
          $config['max_size']     = '5120';
          $config['upload_path'] = './assets/vid/pengontrol';

          $this->load->library('upload', $config);

          if($this->upload->do_upload('video')){
            $new_vid = $this->upload->data('file_name');
          }
        }
      }


      $data = [
        'id_pelapor' => $this->session->userdata('id'),
        'tanggal_laporan' => time(),
        'deskripsi_laporan' => htmlspecialchars( $this->input->post('deskripsi_laporan')),
        'jenis_ternak' => htmlspecialchars( $this->input->post('jenis_ternak')),
        'jumlah_ternak_sebelumnya' => htmlspecialchars( $this->input->post('jumlah_ternak_sebelumnya')),
        'jumlah_ternak_sekarang' => htmlspecialchars( $this->input->post('jumlah_ternak_sekarang')),
        'jumlah_ternak_meninggal' => htmlspecialchars( $this->input->post('jumlah_ternak_meninggal')),
        'keterangan_ternak_meninggal' => htmlspecialchars( $this->input->post('keterangan_ternak_meninggal')),
        'jumlah_ternak_sehat' => htmlspecialchars( $this->input->post('jumlah_ternak_sehat')),
        'jumlah_ternak_sakit' => htmlspecialchars( $this->input->post('jumlah_ternak_sakit')),
        'keterangan_kesehatan_ternak' => htmlspecialchars( $this->input->post('keterangan_kesehatan_ternak')),
        'jumlah_ternak_dikonsumsi' => htmlspecialchars( $this->input->post('jumlah_ternak_dikonsumsi')),
        'keterangan_konsumsi' => htmlspecialchars( $this->input->post('keterangan_konsumsi')),
        'jumlah_ternak_dijual' => htmlspecialchars( $this->input->post('jumlah_ternak_dijual')),
        'harga_ternak_perekor' => htmlspecialchars( $this->input->post('harga_ternak_perekor')),
        'foto' => $new_img,
        'video' =>$new_vid
      ];
      $this->db->insert('laporan_pengontrol', $data);
      $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Laporan berhasil ditambah. </div>');
      redirect('pengontrol');
    }

  }

  public function edit($id = 0){
    $breadcrumb         = array(
            "Laporan Pengontrol" => "pengontrol",
            "Ubah" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['laporan'] = $this->db->get_where('laporan_pengontrol', ['id_laporan_pengontrol' => $id])->row_array();

    $this->form_validation->set_rules('deskripsi_laporan','Deskripsi_laporan', 'required', [
      'required' => "Deskripsi laporan harus diisi"]);
    $this->form_validation->set_rules('jenis_ternak','Jenis_ternak', 'required', [
      'required' => "Jenis ternak harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sebelumnya','Jumlah_ternak_sebelumnya', 'required', [
      'required' => "Jumlah ternak sebelumnya harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sekarang','Jumlah_ternak_sekarang', 'required', [
      'required' => "Jumlah ternak sekarang harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_meninggal','Jumlah_ternak_meninggal', 'required', [
      'required' => "Jumlah ternak meninggal harus diisi"]);
    $this->form_validation->set_rules('keterangan_ternak_meninggal','Keterangan_ternak_meninggal', 'required', [
      'required' => "Keterangan ternak meninggal harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sehat','Jumlah_ternak_sehat', 'required', [
      'required' => "Jumlah ternak sehat harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_sakit','Jumlah_ternak_sakit', 'required', [
      'required' => "Jumlah ternak sakit harus diisi"]);
    $this->form_validation->set_rules('keterangan_kesehatan_ternak','Keterangan_kesehatan_ternak', 'required', [
      'required' => "Keterangan kesehatan ernak harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_dikonsumsi','Jumlah_ternak_dikonsumsi', 'required', [
      'required' => "Jumlah ternak dikonsumsi harus diisi"]);
    $this->form_validation->set_rules('keterangan_konsumsi','Keterangan_konsumsi', 'required', [
      'required' => "Keterangan konsumsi harus diisi"]);
    $this->form_validation->set_rules('jumlah_ternak_dijual','Jumlah_ternak_dijual', 'required', [
      'required' => "Jumlah ternak dijual harus diisi"]);
    $this->form_validation->set_rules('harga_ternak_perekor','Harga_ternak_perekor', 'required', [
      'required' => "Harga ternak perekor harus diisi"]);
    if($this->form_validation->run() == false and $id != 0){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('pengontrol/edit', $data);
      $this->load->view('templates/dash_footer');
    }else{
      $new_img = '';
      $new_vid = '';
      // cek jika ada gambar terupload
      $upload_img = $_FILES['image']['name'];

      if($upload_img){
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']     = '1024';
        $config['upload_path'] = './assets/img/pengontrol';

        $this->load->library('upload', $config);

        if($this->upload->do_upload('image')){
          $new_img = $this->upload->data('file_name');
        }else{
          $pesan = '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('forum'); die;
        }
      }

      // cek jika ada video terupload
      $upload_vid = $_FILES['video']['name'];

      if($upload_vid){
        $config['allowed_types'] = 'mp4|3gp|avi|flv|webm|wmv';
        $config['max_size']     = '10240';
        $config['upload_path'] = './assets/vid/pengontrol';

        $this->load->library('upload', $config);

        if($this->upload->do_upload('video')){
          $new_vid = $this->upload->data('file_name');
        }else{
          $pesan = '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('forum'); die;
        }
      }

      $data = [
        'deskripsi_laporan' => htmlspecialchars( $this->input->post('deskripsi_laporan')),
        'jenis_ternak' => htmlspecialchars( $this->input->post('jenis_ternak')),
        'jumlah_ternak_sebelumnya' => htmlspecialchars( $this->input->post('jumlah_ternak_sebelumnya')),
        'jumlah_ternak_sekarang' => htmlspecialchars( $this->input->post('jumlah_ternak_sekarang')),
        'jumlah_ternak_meninggal' => htmlspecialchars( $this->input->post('jumlah_ternak_meninggal')),
        'keterangan_ternak_meninggal' => htmlspecialchars( $this->input->post('keterangan_ternak_meninggal')),
        'jumlah_ternak_sehat' => htmlspecialchars( $this->input->post('jumlah_ternak_sehat')),
        'jumlah_ternak_sakit' => htmlspecialchars( $this->input->post('jumlah_ternak_sakit')),
        'keterangan_kesehatan_ternak' => htmlspecialchars( $this->input->post('keterangan_kesehatan_ternak')),
        'jumlah_ternak_dikonsumsi' => htmlspecialchars( $this->input->post('jumlah_ternak_dikonsumsi')),
        'keterangan_konsumsi' => htmlspecialchars( $this->input->post('keterangan_konsumsi')),
        'jumlah_ternak_dijual' => htmlspecialchars( $this->input->post('jumlah_ternak_dijual')),
        'harga_ternak_perekor' => htmlspecialchars( $this->input->post('harga_ternak_perekor')),
        'foto' => $new_img,
        'video' =>$new_vid

      ];
      $this->db->update('laporan_pengontrol', $data, array('id_laporan_pengontrol' => $id));
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Laporan berhasil diperbarui.</div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('pengontrol');
    }
  }

  public function detail($id = 0){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Laporan_model', 'laporan');
    if ($id == 0) {
      redirect('pengontrol');
    }
      $data['title'] = 'Detail Laporan Pengontrol Lapangan';
      $breadcrumb         = array(
              "Laporan Pengontrol" => "pengontrol",
              "Detail" => ""
          );
      $data['breadcrumb'] = $breadcrumb;
      $data['laporan'] = $this->laporan->getLaporanPengontrolById($id);
      $data['komen'] = $this->laporan->getKomenPengontrol($id);

    $this->form_validation->set_rules('isi_tanggapan','Isi tanggapan', 'required', [
      'required' => "Komentar harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('pengontrol/detail', $data);
      $this->load->view('templates/dash_footer');
    }else {
      $data = [
        'id_penanggap' => $this->session->userdata('id'),
        'id_laporan' => $id,
        'tanggal_tanggapan' => time(),
        'isi_tanggapan' => htmlspecialchars( $this->input->post('isi_tanggapan'))
      ];
      $this->db->insert('tanggapan_pengontrol', $data);
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Komen berhasil ditambah </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('pengontrol/detail/'.$id);
    }

  }

  public function delete_laporan_pengontrol($id){
    $this->db->delete('tanggapan_pengontrol', ['id_laporan' => $id]);
    $this->db->delete('laporan_pengontrol', ['id_laporan_pengontrol' => $id]);
    $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Laporan berhasil dihapus. </div>');
    redirect('pengontrol');
  }
}
