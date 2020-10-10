<!-- untuk membuat pagenya terus https -->
<?php
	if($_SERVER['HTTPS']!="on")
	{
		 $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 header("Location:$redirect");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title; ?></title>

	<link rel="shortcut icon" href="<?= base_url('assets/') ?>favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?= base_url('assets/') ?>favicon.ico" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/')  ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/')  ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

		<!-- Topbar mb-4 -->
		<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">


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
