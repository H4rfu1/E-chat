<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
  		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


  			<!-- Logo -->
  			<a class="navbar-brand" href="<?= base_url('') ?>" >
  					<img src="<?= base_url('assets/img/');?>logo.png" class="d-inline-block align-middle mr-2" width="60" alt="logo">
  			</a>



  			<!-- Topbar Navbar -->
  			<?php if (is_logged_in("home")) {
  				echo '
  					<ul class="navbar-nav ml-auto">
  						<li class="nav-item dropdown no-arrow mx-1">
  								<a class="btn btn-primary" href="'. base_url("auth/registration") .'" role="button">Daftar</a>
  						</li>
  						<li class="nav-item dropdown no-arrow mx-1">
  								<a class="btn btn-primary" href="'. base_url("auth") .'" role="button">Masuk</a>
  						</li>
  					</ul>
  				';
  			} else {
  				echo '
  				<ul class="navbar-nav ml-auto">

  					<div class="topbar-divider d-none d-sm-block"></div>

  					<!-- Nav Item - User Information -->
  					<li class="nav-item dropdown no-arrow">
  						<a class="nav-link dropdown-toggle" href="'. base_url('user').'" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  							<span class="mr-2 d-none d-lg-inline text-gray-600 small">'. $user['name'] .'</span>
  							<img class="img-profile rounded-circle" src="'. base_url('assets/img/profile/'). $user['image'] .'">
  						</a>
  						<!-- Dropdown - User Information -->
  						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
  							<a class="dropdown-item" href="'. base_url('user').'">
  								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
  								Profil
  							</a>
  							<div class="dropdown-divider"></div>
  							<a class="dropdown-item" href="'.base_url('auth/logout') .'" data-toggle="modal" data-target="#logoutModal">
  								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
  								Keluar
  							</a>
  						</div>
  					</li>

  				</ul>
  			';
  			}?>

  		</nav>
  		<!-- End of Topbar -->
