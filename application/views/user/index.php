
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div>
             <ul class="breadcrumb">
                <?php
                  foreach ($breadcrumb as $key=>$value) {
                  if($value!=''){
                   ?>
                    <li><a href="<?=base_url($value); ?>"><?=$key; ?></a> <span class="divider">></span></li>
                <?php }else{?>
                    <li class="active"><?=$key; ?></li>
                <?php }
                   }
                   ?>
             </ul>
          </div>

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>

          <div class="row">
            <div class="col-lg-8">
              <?= $this->session->flashdata('message') ?>
            </div>
          </div>
          <div class="card mb-3" style="max-width: 540px;">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img" alt="profile image">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?= $user['name']; ?></h5>
                <p class="card-text"><?= $user['role']; ?></p>
                <p class="card-text"><?= $user['email']; ?></p>
                <p class="card-text"><small class="text-muted">Terdaftar sejak <?= date('d F Y', $user['date_create']); ?></small></p>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
