<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('form_validation');
  }
  public function index(){
    if($this->session->userdata('id')){
      redirect('user');
    }
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
      'required' => "Email harus diisi",
      'valid_email' => "Email tidak dikenal"]);
    $this->form_validation->set_rules('password', 'Password', 'trim|required', [
      'required' => "Password harus diisi"]);
    if($this->form_validation->run() == false){
      $data['title'] = 'E-KSTM - Masuk';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    }else{
      //validation succeess
      $this->_login();
    }

  }

  private function _login(){
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    //jika user ada
    if($user){
      //jika usernya ada
      if($user['is_active'] == 1){
        // cek password
        if(password_verify($password, $user['password'])){
          $data = [
            'email' => $user['email'],
            'id' => $user['id'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata($data);
          if($user['role_id'] == 1){
            redirect('admin');
          } else{
            redirect('user');
          }
        } else {
          $this->session-> set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password kurang tepat. </div>');
          redirect('auth');
        }
      } else{
        $this->session-> set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email anda belum teraktivasi. Silakan cek email untuk proses aktivasi. (Cek folder spam bila tiak ada).</div>');
        redirect('auth');
      }
    } else {
      $this->session-> set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email anda belum terdaftar.</div>');
      redirect('auth');
    }
  }

  public function registration(){
    if($this->session->userdata('id')){
      redirect('user');
    }
    $this->form_validation->set_rules('fullname','Name', 'required|trim', [
      'required' => "Nama harus diisi"]);
    $this->form_validation->set_rules('email','Email', 'required|trim|valid_email|is_unique[user.email]',[
      'required' => "Email harus diisi",
      'is_unique' => 'Email sudah terdaftar'
    ]);
    $this->form_validation->set_rules('password1','Password','trim|min_length[3]|matches[password2]', [
      'matches' => "Password tidak sama",
      'min_length' => 'Password terlalu pendek'
    ]);
    $this->form_validation->set_rules('password2','Password2','trim|matches[password1]');
    if($this->form_validation->run() == false){

      $data['title'] = 'E-KSTM - Daftar';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registration');
      $this->load->view('templates/auth_footer');
    } else {
      $email = $this->input->post('email', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('fullname', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 0,
        'date_create' => time()

      ];
      $pesan = '<div class="alert alert-success" role="alert"> Yey, Selamat '.$this->input->post('fullname').'!! akun kamu sudah terdaftar, email aktivasi sudah terkirim dan akan valid selama a24 jam. Coba cek pada bagian spam bila belum muncul. </div>';

      //siapkan token
      $token = base64_encode(random_bytes(32));
      $user_token =[
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];
      $this->db->insert('user',$data);
      $this->db->insert('user_token',$user_token);
      $this->_sendEmail($token, 'verify');

      $this->session-> set_flashdata('message', $pesan);
      redirect('auth');
    }
  }

  public function lupaPassword($token = ''){
    $CI = get_instance();
    if($this->session->userdata('id')){
      redirect('auth');
    }
    if ($token == 'token') {
      if ($email = $this->input->get('email')) {
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
      } else {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      }
      $tokenGet = $this->input->get('token');
      if($user) {
        $user_token = $this->db->get_where('user_token', ['token' => $tokenGet])->row_array();
        if($user_token) {
          if(time()-$user_token['date_created'] < (60*60*24)) {
            $this->db->delete('user_token', ['email' => $email]);
            $data = [
              'email' => $user['email'],
              'token' => 'benar'
            ];
            $this->session->set_userdata($data);
          }else {
            $this->db->delete('user_token', ['email' => $email]);
            $pesan = '<div class="alert alert-danger" role="alert"> Password gagal direset, token aktivasi sudah kadaluarsa.</div>';
            $this->session-> set_flashdata('message', $pesan);
            redirect('auth');
          }
        } else {
          if(!$CI->session->userdata('token')){
            $pesan = '<div class="alert alert-danger" role="alert"> Password gagal direset, token tidak dikenali.</div>';
            $this->session-> set_flashdata('message', $pesan);
            redirect('auth');
          }
        }
      } else {
        $pesan = '<div class="alert alert-danger" role="alert">Tindakan ilegal terdeteksi.</div>';
        $this->session-> set_flashdata('message', $pesan);
        redirect('auth');
      }
      if(!$CI->session->userdata('token')){
          redirect('auth/lupapassword');
      }else {
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]', [
          'required' => "Passsword harus diisi",
          'matches' => "Password tidak sama",
          'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        $data['form'] = 'ganti password';
        $data['title'] = 'E-KSTM - Lupa Password';
        if($this->form_validation->run() == false){
          $this->load->view('templates/auth_header', $data);
          $this->load->view('auth/lupapassword');
          $this->load->view('templates/auth_footer');
        }else {
          $new_password = $this->input->post('new_password1');
          //password baru
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          if ($this->db->affected_rows() > 0) {
            $pesan = '<div class="alert alert-success" role="alert"> Password berhasil direset.</div>';
            $this->session-> set_flashdata('message', $pesan);
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('token');
          }else {
            $pesan = '<div class="alert alert-success" role="alert"> Password gagal direset.</div>';
            $this->session-> set_flashdata('message', $pesan);
          }
          redirect('auth');

        }

      }

    } else {

      $this->form_validation->set_rules('email','Email', 'required|trim|valid_email',[
        'required' => "Email harus diisi"
      ]);

      if($this->form_validation->run() == false){
        $data['title'] = 'E-KSTM - Lupa Password';
        $data['form'] = 'isi email';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/lupapassword');
        $this->load->view('templates/auth_footer');
      }else {
        $email = $this->input->post('email', true);
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        //jika user ada
        if($user){
          //jika usernya ada dan aktif
          if($user['is_active'] == 1){
            // beri email berisi token
            $pesan = '<div class="alert alert-success" role="alert"> Yey, Selamat '.$this->input->post('fullname').'!! link ganti password sudah terkirim dan akan valid selama 24 jam. Coba cek pada bagian spam bila belum muncul. </div>';
            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token =[
              'email' => $email,
              'token' => $token,
              'date_created' => time()
            ];
            $this->db->insert('user_token',$user_token);
            $this->_sendEmail($token, 'lupaPassword');

            $this->session-> set_flashdata('message', $pesan);
            redirect('auth/lupapassword');
          } else{
            $this->session-> set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email anda belum teraktivasi. Silakan cek email untuk proses aktivasi. (Cek folder spam bila tiak ada).</div>');
            redirect('auth');
          }
        } else {
          $this->session-> set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email anda belum terdaftar.</div>');
          redirect('auth');
        }
      }
    }


  }

  private function _sendEmail($token, $type){
     $config = [
       'protocol'  => 'smtp',
       'smtp_host' => 'mail.e-kstm.com',
       'smtp_user' => 'no-reply@e-kstm.com',
       'smtp_pass' => 'E-KSTM123',
       'smtp_port' => 465,
       'mailtype'  => 'html',
       'charset' => 'utf-8',
       'newline' => "\r\n",
     ];
     $this->load->library('email', $config);
     $this->email->from('no-reply@e-kstm.com', 'e-kstm');
     $this->email->to($this->input->post('email'));

     if($type == 'verify'){
       $this->email->subject('e-KSTM - Verifikasi Akun');
       $message = '<html><head>';
       $message = '<title>E-KSTM - email verif<title>';
       $message = '<head><body>';
       $message .= '<p>Klik link ini untuk aktivasi akun : <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan</a></p>';
       $message .= '<p>atau salin</p> <p>link: '. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '</p>';
       $message .= '</body></html>';
       $this->email->message($message);
       $this->email->set_mailtype('html');
     } elseif ($type == 'lupaPassword') {
       $this->email->subject('e-KSTM - Lupa Password');
       $message = '<html><head>';
       $message = '<title>E-KSTM - lupa password<title>';
       $message = '<head><body>';
       $message .= '<p>Klik link ini untuk ganti password : <a href="'. base_url() . 'auth/lupapassword/token?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Ganti Password</a></p>';
       $message .= '<p>atau salin</p> <p>link: '. base_url() . 'auth/lupapassword/token?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '</p>';
       $message .= '</body></html>';
       $this->email->message($message);
       $this->email->set_mailtype('html');
     }

     if($this->email->send()){
       return true;
     }else{
       echo $this->email->print_debugger(); die;
     }

  }

  public function verify(){
    $email = $this->input->get('email');
    $token = $this->input->get('token');
    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if($user) {
      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
      if($user_token) {
        if(time()-$user_token['date_created'] < (60*60*24)) {
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user');
          $this->db->delete('user_token', ['email' => $email]);

          $pesan = '<div class="alert alert-success" role="alert"> ' . $email .' Akun anda sudah aktif!, silakan login.</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('auth');
        }else {
          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);


          $pesan = '<div class="alert alert-danger" role="alert"> Akun gagal diaktifkan, token aktivasi sudah kadaluarsa.</div>';
          $this->session-> set_flashdata('message', $pesan);
          redirect('auth');
        }
      } else {
        $pesan = '<div class="alert alert-danger" role="alert"> Akun gagal diaktifkan, token tidak dikenali.</div>';
        $this->session-> set_flashdata('message', $pesan);
        redirect('auth');
      }
    } else {
      $pesan = '<div class="alert alert-danger" role="alert">Jangan dibuat mainan, atau akan dilaporkan.</div>';
      $this->session-> set_flashdata('message', $pesan);
      redirect('auth');
    }

  }

  public function logout(){
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');
    $this->session->unset_userdata('id');
    $pesan = '<div class="alert alert-success" role="alert"> Berhasil logout</div>';
    $this->session-> set_flashdata('message', $pesan);
    redirect('auth');

  }
  public function blocked(){
    $this->load->view('auth/blocked');
  }
}
