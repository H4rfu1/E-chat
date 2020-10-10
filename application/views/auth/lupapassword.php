  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
              </div>
              <?= $this->session->flashdata('message'); ?>
              <?php if ($form == 'isi email'): ?>
                <form class="user" method="post" action="<?php echo base_url('auth/lupapassword/'); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                    <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Reset
                  </button>

                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?php echo base_url("auth/registration"); ?>">Belum punya akun? Daftar</a>
                </div>
                <div class="text-center">
                  <a class="small" href="<?php echo base_url("auth"); ?>">Sudah punya akun? Masuk!</a>
                </div>
              <?php endif; ?>
              <?php if ($form == 'ganti password'): ?>
                <form class="" action="<?= base_url('auth/lupapassword/token'); ?>" method="post">
                  <div class="form-group">
                    <label for="new_password1">Pasword baru</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <?= form_error('new_password1','<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label for="new_password2">Ulangi pasword baru</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                  </div>
                  <div class="form-group">
                    <button type="submit" name="button" class="btn btn-primary">Reset Password</button>
                  </div>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
