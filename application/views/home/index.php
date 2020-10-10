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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $title; ?></title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="<?= base_url('assets/') ?>favicon.ico" type="image/x-icon">
      	<link rel="icon" href="<?= base_url('assets/') ?>favicon.ico" type="image/x-icon">
        <!-- Font Awesome icons (free version)-->
        <!-- <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script> -->
        <script src="<?php echo base_url('assets/') ?>vendor/fontawesome-free/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&display=swap" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= base_url('assets/') ?>css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
      <div id="wrapper">
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Navigation-->
        <nav class="navbar navbar-expand bg-white text-uppercase fixed-top shadow" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="<?= base_url('') ?>">
                  <img src="<?= base_url('assets/img/');?>logo.png" class="d-inline-block align-top img-fluid " width="60" height="60" alt="logo">
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
                      <li class="nav-item dropdown no-arrow" style="color ">
                        <a class="nav-link dropdown-toggle" href="'. base_url('user').'" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="mr-2 d-none d-lg-inline text-gray-600 small">'. $user['name'] .'</span>
                          <img class="img-profile rounded-circle img-fluid" src="'. base_url('assets/img/profile/'). $user['image'] .'" width="60" height="60">
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
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center">
            <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Heading-->
                <!-- <h1 class="masthead-heading text-uppercase mb-0">E-KSTM</h1> -->
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <img src="<?= base_url('assets/img/');?>logo.png" alt="logo" height="270" >
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0">
                  Platform Pengembangan dan Pengawasan <br>
                  Program Kelompok Santri Tani Milenial (KSTM)</p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Kegiatan</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star fa-sm fa-fw"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- slider-->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="<?= base_url('assets/img/slider/') ?>slide.svg" alt="First slide">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>Judul kegiatan</h5>
                        <p>Keterangan tambahan lainnya.</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url('assets/img/slider/') ?>slide.svg" alt="Second slide">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>Judul kegiatan</h5>
                        <p>Keterangan tambahan lainnya.</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url('assets/img/slider/') ?>slide.svg" alt="Third slide">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>Judul kegiatan</h5>
                        <p>Keterangan tambahan lainnya.</p>
                      </div>
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </div>
        </section>
        <!-- About Section-->
        <section class="page-section bg-primary text-white mb-0" id="about">
            <div class="container">
                <!-- About Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-white">Tentang E-KSTM</h2>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star fa-sm fa-fw"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- About Section Content-->
                <div class="row">
                    <div style="text-align: justify; text-justify: inter-word; text-indent: 2.0em;" class="col-lg-4 ml-auto"><p class="lead">Website “E-KSTM” ini akan sangat bermanfaat menjembatani pusat informasi antara KSTM dengan Dinas Ketahanan Pangan dan Peternakan serta dapat mempermudah pengawasan (monitoring) berkala terhadap jalannya program KSTM.</p></div>
                    <div class="col-lg-4 mr-auto"><p class="lead" style="text-align: justify; text-justify: inter-word;text-indent: 2.0em;">Terutama di era pandemi COVID-19 sekarang ini. Proses transparansi menjadi keunggulan utama aplikasi kami ini, karena semua terawasi dan terintegrasi di dalam satu sistem (secara waktu langsung)!</p></div>
                </div>
                <!-- About Section Button-->
                <!-- <div class="text-center mt-4">
                    <a class="btn btn-xl btn-outline-light" target="_blank" href="https://github.com/H4rfu1/E-KSTM">
                        <i class="fab fa-github mr-2"></i>
                        Lihat kode di github!
                    </a>
                </div> -->
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Mitra</h4>
                        <p class="lead mb-0">
                          Dinas Ketahanan Pangan
                          <br />
                          dan Peternakan
                          <br/>
                          Kabupaten Jember
                            <!-- <img src="<base_url('assets/img/') ;?>dinas_logo.png" height="50" alt=""> -->
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Tim PKM E-KSTM</h4>
                        <p class="lead mb-0">
                            Ketua Tim: <br>
                            Alif Aditya Rahman  <br>
                            Anggota Tim: <br>
														Firra Andriani  <br>
                            Agung Dewantara  <br>
														Moh. Fahrul Hafidh  <br>
                            Aditya Novan Firmansyah  <br>
                        </p>
                    </div>
                </div>
            </div>
        </footer>

        </div>
        <!-- end content wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; E-KSTM <?= date('Y'); ?></small></div>
        </div>
        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
        <div class="scroll-to-top d-lg-none position-fixed">
            <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mau keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih "Logout" dibawah jika ingin keluar sesi ini.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
            <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
          </div>
        </div>
        </div>
        </div>

        <!-- Bootstrap core JS-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
        <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="<?= base_url('assets/') ?>mail/jqBootstrapValidation.js"></script>
        <script src="<?= base_url('assets/') ?>mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="<?= base_url('assets/') ?>js/scripts.js"></script>
    </body>
</html>
