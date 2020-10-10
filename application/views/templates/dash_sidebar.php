<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion m-0" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <div class="container m-0">
    <a class="res sidebar-brand align-items-center justify-content-center " href="<?= base_url('') ?>">
          <img src="<?= base_url('assets/img/');?>logo.png" class="d-block img-fluid m-0" alt="logo">
    </a>
  </div>

  <!-- Divider -->
  <hr class="sidebar-divider">


  <!-- query menu -->
  <?php
  $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu` . `id`, `menu`
                  FROM `user_menu` JOIN `user_access_menu`
                  ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                  WHERE `user_access_menu`.`role_id` = $role_id
                  ORDER BY `user_menu`.`menu` ASC
                  ";

    $menu = $this->db->query($queryMenu)->result_array();

   ?>


  <!-- looping menu -->
  <?php  foreach($menu as $m) :?>

  <div class="sidebar-heading">
    <?=$m['menu']  ?>
  </div>
  <!-- siapkan sub-menu sesuai menu -->
  <?php
    $menuId = $m['id'];
    $querySubMenu = "SELECT *
                    FROM `user_sub_menu`
                    WHERE `menu_id` = $menuId
                    AND `is_active` = 1
                    ";
    $subMenu = $this->db->query($querySubMenu)->result_array();
   ?>

    <?php foreach($subMenu as $sm) : ?>
    <?php if ($title == $sm['title']): ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <?php else : ?>
    <li class="nav-item">
    <?php endif; ?>
      <a class="nav-link pb-0" href="<?= base_url($sm['url']) ?>">
        <i class="<?= $sm['icon'] ?>"></i>
        <span><?= $sm['title'] ?></span></a>
    </li>

  <?php endforeach; ?>
    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
<?php endforeach; ?>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item ">
    <a class="nav-link m-auto" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider mt-3">
</ul>
<!-- End of Sidebar -->
