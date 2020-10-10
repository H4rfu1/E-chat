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
<h1 class="h3 mb-4 text-gray-800">Ubah Akun</h1>

<div class="row">
  <div class="col-lg-8">
    <?= form_open_multipart('akun/edit/'.$user['id']); ?>
    <div class="form-group row">
      <label for="email" class="col-sm-3 col-form-label" >Email</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
      <div class="col-md-9">
        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
        <?= form_error('name','<small class="text-danger pl-3">', '</small>'); ?>

      </div>
    </div>
    <div class="form-group row">
      <label for="name" class="col-sm-3 col-form-label">Wewenang Pengguna</label>
      <div class="col-md-9">
        <select class="browser-default custom-select" name="role_id" id='role_id'>
          <option value="">pilih wewenang</option>
          <?php foreach($role as $m) : ?>
            <option value="<?= $m['id'] ?>" <?= $user['role_id']==$m['id'] ? 'selected' : '' ; ?>><?= $m['role']  ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>


    <div class="form-group row justify-content-end">
      <div class="col-md-9">
        <br>
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
