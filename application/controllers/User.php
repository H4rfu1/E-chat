<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
  }

  public function index(){
    $breadcrumb         = array(
            "Profil" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Profil Saya';
    $this->load->model('Akun_model', 'akun');
    $data['user'] = $this->akun->getAkunId($this->session->userdata('id'));
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('user/index', $data);
      $this->load->view('templates/dash_footer');
  }
  public function edit(){
    $breadcrumb         = array(
            "Profil" => "user",
            "Ubah Profil" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Ubah Profil';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


    $this->form_validation->set_rules('name', 'Full Name', 'required|trim',[
      'required' => "Nama lengkap harus diisi"]);
      $this->form_validation->set_rules('email', 'Email', 'required',[
        'required' => "Email harus diisi"]);
    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('templates/dash_footer');
    }else{
      $name = $this->input->post('name');
      $email = $this->input->post('email');

      // cek jika ada gambar terupload
      $upload_img = $_FILES['image']['name'];

      if($upload_img){
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']     = '1024';
        $config['upload_path'] = './assets/img/profile';

        $this->load->library('upload', $config);

        if($this->upload->do_upload('image')){
          $old_image = $data['user']['image'];
          if($old_image != 'default.jpg'){
            unlink(FCPATH . 'assets/img/profile/' . $old_image);
          }
          $new_img = $this->upload->data('file_name');
          $this->db->set('image', $new_img);
        }else{
          $pesan = '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('user/edit'); die;
        }
      }

      $this->db->set('name',$name);
      $this->db->where('email', $email);
      $this->db->update('user');

      $pesan = '<div class="alert alert-success" role="alert">Profil berhasil diubah</div>';
      $this->session-> set_flashdata('message', $pesan);
      redirect('user');
    }
  }

  public function changePassword(){
    $breadcrumb         = array(
            "Profil" => "user",
            "Ubah Password" => ""
        );
    $data['breadcrumb'] = $breadcrumb;
    $data['title'] = 'Ubah Password';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim', [
      'required' => "Passsword lama harus diisi"]);
    $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]', [
      'required' => "Passsword baru harus diisi",
      'matches' => "Password tidak sama",
      'min_length' => 'Password terlalu pendek'
    ]);
    $this->form_validation->set_rules('new_password2', 'Confirm New Password
    ', 'required|trim|min_length[3]|matches[new_password1]');

    if($this->form_validation->run() == false){
      $this->load->view('templates/dash_header', $data);
      $this->load->view('templates/dash_sidebar', $data);
      $this->load->view('templates/dash_topbar', $data);
      $this->load->view('user/changepassword', $data);
      $this->load->view('templates/dash_footer');
    }else{
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');
      if(!password_verify($current_password, $data['user']['password'])){
        $pesan = '<div class="alert alert-danger" role="alert"> Password lama kurang tepat.</div>';
        $this->session-> set_flashdata('message', $pesan);
        redirect('user/changepassword');
      }else{
        if($current_password == $new_password){
          $pesan = '<div class="alert alert-danger" role="alert"> Password sama dengan yang lama.</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('user/changepassword');
        } else{
          //password baru
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          $pesan = '<div class="alert alert-success" role="alert"> Password berhasil diubah.</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('user/changepassword');
        }
      }
    }
  }
}
