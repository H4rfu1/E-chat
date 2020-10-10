<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
  }

  public function index(){
    $breadcrumb         = array(
            "Pengumuman" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Pengumuman';
    $data['role_id'] = $this->session->userdata('role_id');
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Pengumuman_model', 'pengumuman');

    if ($data['role_id'] == 3) {
      $data['pengumuman'] = $this->pengumuman->getAllPengumuman();
    } else {
      $data['pengumuman'] = $this->pengumuman->getRolePengumuman($data['role_id']);
    }

    $this->db->where('id != 1');
    $this->db->where('id != 3');
    $data['role'] = $this->db->get('user_role')->result_array();


    $this->form_validation->set_rules('role_id','Role_id', 'required', [
      'required' => "Wewenang harus diisi"]);
    $this->form_validation->set_rules('isi','Isi', 'required', [
      'required' => "Isi harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('pengumuman/index', $data);
      $this->load->view('templates/dash_footer');
    }elseif ($data['role_id'] == 3){
      $data = [
        'id_pengirim' => $this->session->userdata('id'),
        'id_role' =>  $this->input->post('role_id'),
        'tanggal_pemberitahuan' => time(),
        'isi_pemberitahuan' => $this->input->post('isi')
      ];
      $this->db->insert('pemberitahuan', $data);
      $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Pengumuman berhasil ditambah. </div>');
      redirect('pengumuman');
    }else {
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('pengumuman/index', $data);
      $this->load->view('templates/dash_footer');
    }

  }

  public function edit($id = 0){
    $breadcrumb         = array(
            "Pengumuman" => "pengumuman",
            "Ubah" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Edit Pengumuman';
    $data['pemberitahuan'] = $this->db->get_where('pemberitahuan', ['id_pemberitahuan' => $id])->row_array();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->db->where('id != 1');
    $this->db->where('id != 3');
    $data['role'] = $this->db->get('user_role')->result_array();

    $this->form_validation->set_rules('role_id','Role_id', 'required', [
      'required' => "Wewenang harus diisi"]);
    $this->form_validation->set_rules('isi','Isi', 'required', [
      'required' => "Isi harus diisi"]);
    if($this->form_validation->run() == false and $id != 0){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('pengumuman/edit', $data);
      $this->load->view('templates/dash_footer');
    }else{
      $data = [
        'id_role' =>  $this->input->post('role_id'),
        'isi_pemberitahuan' => $this->input->post('isi')
      ];
      $this->db->update('pemberitahuan', $data, array('id_pemberitahuan' => $id));
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Pengumuman berhasil diperbarui. </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('pengumuman');
    }
  }

  public function delete_pengumuman($id){
    $this->db->delete('pemberitahuan', ['id_pemberitahuan' => $id]);
    $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Pengumuman berhasil dihapus. </div>');
    redirect('pengumuman');
  }
}
