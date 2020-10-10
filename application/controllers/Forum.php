<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
  }

  public function index($page = 0){
    $breadcrumb         = array(
            "Forum" => ""
        );
    $data['breadcrumb'] = $breadcrumb;

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = 'Forum';
    $data['page'] = $page;

    $this->load->model('Forum_model', 'forum');
    $data['cari'] = '';
    if($this->input->post('search')!= null){
      $this->form_validation->set_rules('cari','Cari', 'required',[
        'required' => "Kata kunci pencarian harus diisi"]);
      $data['forum'] = $this->forum->getSearchForum(htmlspecialchars($this->input->post('cari'), ENT_QUOTES, 'UTF-8'));
      $data['cari'] = $this->input->post('cari');
    }else {
      $data['forum'] = $this->forum->getAllForum();
      $this->form_validation->set_rules('topik_bahasan','Judul','required', [
        'required' => "Judul harus diisi"]);
      $this->form_validation->set_rules('keterangan_bahasan','Isi bahasan','required', [
        'required' => "Keterangan Bahasan harus diisi"]);
    }

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('forum/index', $data);
      $this->load->view('templates/dash_footer');
    }else {
      if ($this->input->post('search')!= null) {
        $this->load->view('templates/dash_header', $data);
        $this->load->view('templates/dash_sidebar', $data);
        $this->load->view('templates/dash_topbar', $data);
        $this->load->view('forum/index', $data);
        $this->load->view('templates/dash_footer');
      } else {
        $new_img = 'default.png';
        // cek jika ada gambar terupload
        $upload_img = $_FILES['image']['name'];

        if($upload_img){
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['max_size']     = '1024';
          $config['upload_path'] = './assets/img/forum';

          $this->load->library('upload', $config);

          if($this->upload->do_upload('image')){
            $new_img = $this->upload->data('file_name');
          }else{
            $pesan = '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>';
            $this->session-> set_flashdata('message', $pesan);
            redirect('forum'); die;
          }
        }
        $data = [
          'id_pembuat' => $this->session->userdata('id'),
          'tanggal_dibuat' => time(),
          'topik_bahasan' => htmlspecialchars( $this->input->post('topik_bahasan')),
          'keterangan_bahasan' => htmlspecialchars( $this->input->post('keterangan_bahasan')),
          'foto' => $new_img,
        ];
        $this->db->insert('forum', $data);
        if ($this->db->affected_rows() > 0) {
          $pesan = '<div class="alert alert-success" role="alert"> Forum diskusi berhasil ditambah. </div>';
          $this->session-> set_flashdata('message', $pesan);
        }
        redirect('forum');
      }
    }

  }

  public function diskusi($id = 0){
    $breadcrumb         = array(
            "Forum" => "forum",
            "Diskusi" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = 'Forum';

    $this->load->model('Forum_model', 'forum');
    $data['forum'] = $this->forum->getCertainForum($id);
    $data['komen'] = $this->forum->getKomen($id);


    $this->form_validation->set_rules('isi_tanggapan','Isi tanggapan', 'required', [
      'required' => "Komentar harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('forum/diskusi', $data);
      $this->load->view('templates/dash_footer');
    }else {
      $data = [
        'id_penanggap' => $this->session->userdata('id'),
        'id_forum' => $id,
        'tanggal_tanggapan' => time(),
        'isi_tanggapan' => htmlspecialchars( $this->input->post('isi_tanggapan'))
      ];
      $this->db->insert('tanggapan_forum', $data);
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Komen berhasil ditambah </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('forum/diskusi/'.$id);
    }

  }
}
