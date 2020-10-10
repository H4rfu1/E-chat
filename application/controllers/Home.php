<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index(){
		$data['title'] = 'Home E-KSTM';
		if (!is_logged_in("home")) {
    	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		}
		// $this->load->view('templates/home_header', $data);
    // $this->load->view('templates/home_topbar', $data);
    $this->load->view('home/index', $data);
    // $this->load->view('templates/home_footer');
	}
}
