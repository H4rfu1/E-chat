<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kstm extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
  }

  public function index(){
    $breadcrumb         = array(
            "Laporan KSTM" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Kelola Laporan';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['role'] = $this->session->userdata('role_id');
    $id_user = $this->session->userdata('id');
    $this->db->where("id_pelapor = $id_user");
    $data['laporan_kstm'] = $this->db->get('laporan_kstm')->result_array();


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
      $this->load->view('kstm/index', $data);
      $this->load->view('templates/dash_footer');
    }else {
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
        'harga_ternak_perekor' => htmlspecialchars( $this->input->post('harga_ternak_perekor'))

      ];
      $this->db->insert('laporan_kstm', $data);
      $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Laporan berhasil ditambah. </div>');
      redirect('kstm');
    }

  }

  public function edit($id = 0){
    $breadcrumb         = array(
            "Laporan KSTM" => "kstm",
            "Ubah" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['laporan'] = $this->db->get_where('laporan_kstm', ['id_laporan_kstm' => $id])->row_array();

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
      $this->load->view('kstm/edit', $data);
      $this->load->view('templates/dash_footer');
    }else{
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
        'harga_ternak_perekor' => htmlspecialchars( $this->input->post('harga_ternak_perekor'))

      ];
      $this->db->update('laporan_kstm', $data, array('id_laporan_kstm' => $id));
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Laporan berhasil diperbarui. </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('kstm');
    }
  }

  public function detail($id = 0){
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Laporan_model', 'laporan');
    if ($id == 0) {
      redirect('kstm');
    }
      $data['title'] = 'Detail Laporan KSTM';
      $breadcrumb         = array(
              "Laporan KSTM" => "kstm",
              "Detail" => ""
          );
      $data['breadcrumb'] = $breadcrumb;
      $data['laporan'] = $this->laporan->getLaporanKSTMById($id);
      $data['komen'] = $this->laporan->getKomenKSTM($id);

    $this->form_validation->set_rules('isi_tanggapan','Isi tanggapan', 'required', [
      'required' => "Komentar harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('kstm/detail', $data);
      $this->load->view('templates/dash_footer');
    }else {
      $data = [
        'id_penanggap' => $this->session->userdata('id'),
        'id_laporan' => $id,
        'tanggal_tanggapan' => time(),
        'isi_tanggapan' => htmlspecialchars( $this->input->post('isi_tanggapan'))
      ];
      $this->db->insert('tanggapan_kstm', $data);
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Komen berhasil ditambah </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('kstm/detail/'.$id);
    }

  }

  public function delete_laporan_kstm($id){
    $this->db->delete('tanggapan_kstm', ['id_laporan' => $id]);
    $this->db->delete('laporan_kstm', ['id_laporan_kstm' => $id]);
    $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Laporan berhasil dihapus. </div>');
    redirect('kstm');
  }
}
