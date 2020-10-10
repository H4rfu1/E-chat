<?php
  function is_logged_in($da = "auth" ){
    $CI = get_instance();
    if(!$CI->session->userdata('id')){
      if ($da == "auth") {
        redirect('auth');
      }elseif ($da == "home") {
        return true;
      }

    }else{
      if ($da == "auth") {
        $role_id = $CI->session->userdata('role_id');
        $menu = $CI->uri->segment(1);

        $queryMenu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $CI->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
        if($userAccess->num_rows() < 1){
          redirect('auth/blocked');
      }
      }elseif ($da == "home") {
        return false;
      }
    }

  function check_Access($role_id, $menu_id){
    $CI =get_instance();
    $CI->db->where('role_id', $role_id);
    $CI->db->where('menu_id', $menu_id);
    $result = $CI->db->get('user_access_menu');
    if($result->num_rows() > 0){
      return 'checked="checked"';
    }
  }
  }
