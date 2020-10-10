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
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
  <div class="col-lg-6">
    <?= $this->session->flashdata('message') ?>
    <form class="" action="<?= base_url('user/changepassword'); ?>" method="post">
      <div class="form-group">
        <label for="current_password">Pasword lama</label>
        <input type="password" class="form-control" id="current_password" name="current_password">
        <?= form_error('current_password','<small class="text-danger pl-3">', '</small>'); ?>
      </div>
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
        <button type="submit" name="button" class="btn btn-primary">Ubah Password</button>
      </div>
    </form>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
