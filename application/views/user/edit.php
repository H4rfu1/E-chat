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
  <div class="col-lg-8">
      <?= form_open_multipart('user/edit'); ?>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label" >Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Nama lengkap</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
          <?= form_error('name','<small class="text-danger pl-3">', '</small>'); ?>

        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-2">
          Gambar profil
        </div>
        <div class="col-sm-10">
          <div class="row">
            <div class="col-sm-3">
              <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" alt="" class="img-thumbnail">
            </div>
            <div class="col-sm-9">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                <label class="custom-file-label" for="image">Pilih Gambar</label>
              </div>
              <?= $this->session->flashdata('message') ?>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" name="button" class="float-sm-right btn btn-primary">Ubah</button>
        </div>
      </div>
      </form>
  </div>

</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
