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
<h1 class="h3 mb-4 text-gray-800"><?=  $title; ?></h1>

<div class="row">
  <div class="col-lg-12 table-responsive">
    <?php if(validation_errors()) : ?>
    <div class="alert alert-danger" role="alert">
      <?= validation_errors(); ?>
    </div>
    <?php endif; ?>
    <?= form_error('pemberitahuan', '<div class="alert alert-danger" role="alert">','</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <?php if ($role_id == 3) {
      echo '
        <a href="#" class="btn btn-success mb-3"  data-toggle="modal" data-target="#newSubmenu">Tambah Pemberitahuan</a>
      ';
    } ?>


    <table class="table table-hover">
      <thead>

        <tr>
          <?php
          if ($role_id == 3) {
            echo '
            <th scope="col">#</th>
            <th scope="col">Wewenang</th>
            <th scope="col">tanggal Pemberitahuan</th>
            <th scope="col">Isi pemberitahuan</th>
            <th scope="col">Aksi</th>
            ';
          } else {
            echo '
            <th scope="col">#</th>
            <th scope="col">Pengirim</th>
            <th scope="col">tanggal Pemberitahuan</th>
            <th scope="col">Isi pemberitahuan</th>
            ';
          }
           ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
       foreach($pengumuman as $p) :
        ?>
        <tr>
          <th scope="row"><?= $i ?></th>
            <td><?= $role_id == 3 ? $p['role'] : $p['name']; ?></td>
            <td><?= date('d F Y', $user['date_create']); ?></td>
            <td><?= $p['isi_pemberitahuan'] ?></td>
          <?php
          if ($role_id == 3) {
            $m = $p['id_pemberitahuan'];
            echo "
            <td>
              <a href='". base_url("pengumuman/edit/") ."$m' class='badge badge-primary'>Ubah</a>
              <a class='badge badge-danger' style='color:white;' onclick='conDelete('".base_url("pengumuman/delete_pengumuman/") ."$m'); '>Hapus</a>
            </td>
            ";
          } ?>

        </tr>
      <?php $i++; endforeach; ?>
      </tbody>
      </table>
  </div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

 <!-- modal -->


<!-- Modal -->
<div class="modal fade " id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="newSubmenuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuLabel">Tambah Pemberitahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="<?= base_url('pengumuman') ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
          <select class="browser-default custom-select" name="role_id" id='role_id'>
            <option value="">Pilih penerima</option>
            <?php foreach($role as $m) : ?>
              <option value="<?= $m['id'] ?>"><?= $m['role']  ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Pemberitahuan</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="isi"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
