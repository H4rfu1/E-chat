<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct(){
    parent::__construct();
    is_logged_in();
  }

  public function index(){
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('templates/dash_header', $data);
    $this->load->view('templates/dash_sidebar', $data);
    $this->load->view('templates/dash_topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/dash_footer');
  }
  public function role(){
    $data['title'] = 'Role';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['role'] = $this->db->get('user_role')->result_array();

    $this->load->view('templates/dash_header', $data);
    $this->load->view('templates/dash_sidebar', $data);
    $this->load->view('templates/dash_topbar', $data);
    $this->load->view('admin/role', $data);
    $this->load->view('templates/dash_footer');
  }
  public function roleaccess($role_id){
    $data['title'] = 'Role';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['role'] = $this->db->get_where('user_role',['id' => $role_id])->row_array();

    $this->db->where('id != 1');
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->load->view('templates/dash_header', $data);
    $this->load->view('templates/dash_sidebar', $data);
    $this->load->view('templates/dash_topbar', $data);
    $this->load->view('admin/role_access', $data);
    $this->load->view('templates/dash_footer');
  }

  public function changeaccess(){
    $menu_id = $this->input->post('menuId');
    $role_id = $this->input->post('roleId');

    $data = [
      'role_id' => $role_id,
      'menu_id' => $menu_id
    ];

    $result = $this->db->get_where('user_access_menu', $data);

    if($result->num_rows() < 1){
      $this->db->insert('user_access_menu', $data);
      $pesan = '<div class="alert alert-success" role="alert"> Access Changed!, succesful checked</div>';
    }else{
      $this->db->delete('user_access_menu', $data);
      $pesan = '<div class="alert alert-danger" role="alert"> Access Changed!, succesful unchecked</div>';
    }
    $this->session->set_flashdata('message', $pesan);
  }
  public function delete_role($id){
    $this->db->delete('user_role', ['id' => $id]);
    $this->session-> set_flashdata('message', '<div class="alert alert-success" role="alert"> Menu has been delete </div>');
    redirect('admin/role');
  }
}
