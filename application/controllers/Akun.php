<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('email')){
      redirect('auth');
    }
  }

  public function index(){
    $breadcrumb         = array(
            "Kelola Akun" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Kelola Akun';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->model('Akun_model', 'akun');

    $data['akun'] = $this->akun->getAkun();

    $this->db->where('id != 1');
    $data['role'] = $this->db->get('user_role')->result_array();


    $this->form_validation->set_rules('name','Nama', 'required', [
      'required' => "Nama harus diisi"]);
    $this->form_validation->set_rules('email','Email', 'required|trim|valid_email|is_unique[user.email]', [
      'required' => "Email harus diisi",
      'valid_email' => "Email tidak dikenal"]);
      $this->form_validation->set_rules('role_id','Role', 'required', [
        'required' => "Role harus diisi"]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('akun/index', $data);
      $this->load->view('templates/dash_footer');
    }else {
      $data = [
        'name' => htmlspecialchars( $this->input->post('name')),
        'email' => htmlspecialchars( $this->input->post('email')),
        'image' => 'default.jpg',
        'password' => password_hash('rahasia', PASSWORD_DEFAULT),
        'role_id' =>  $this->input->post('role_id'),
        'is_active' => $this->input->post('is_active'),
        'date_create' => time()
      ];
      $this->db->insert('user', $data);
      $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Akun berhasil ditambah, password bawaannya adalah "rahasia" tanpa petik.</div>');
      redirect('akun');
    }

  }

  public function edit($id = 0){
    $breadcrumb         = array(
            "Kelola Akun" => "akun",
            "Ubah" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();

    $this->db->where('id != 1');
    $data['role'] = $this->db->get('user_role')->result_array();

    $this->form_validation->set_rules('name','Nama', 'required', [
      'required' => "Nama harus diisi"]);
    $this->form_validation->set_rules('role_id','Role', 'required', [
      'required' => "Wewenang harus diisi"]);
    if($this->form_validation->run() == false and $id != 0){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('akun/edit', $data);
      $this->load->view('templates/dash_footer');
    }else{
      $data = [
        'name' => htmlspecialchars( $this->input->post('name')),
        'email' => htmlspecialchars( $this->input->post('email')),
        'role_id' =>  $this->input->post('role_id')
      ];
      $this->db->update('user', $data, array('id' => $id));
      if ($this->db->affected_rows() > 0) {
        $pesan = '<div class="alert alert-success" role="alert"> Akun berhasil diperbarui. </div>';
        $this->session-> set_flashdata('message', $pesan);
      }
      redirect('akun');
    }
  }

  public function delete_akun($id){
    $this->db->delete('user', ['id' => $id]);
    $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Akun berhasil dihapus. </div>');
    redirect('akun');
  }
}
