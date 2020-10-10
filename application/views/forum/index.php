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

  <div class="row">
    <div class="col-lg-12">
      <?php if(validation_errors()) : ?>
      <div class="alert alert-danger" role="alert">
        <?= validation_errors(); ?>
      </div>
      <?php endif; ?>
      <?= form_error('forum', '<div class="alert alert-danger" role="alert">','</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
      <a href="#" class="btn btn-success mb-3"  data-toggle="modal" data-target="#newSubmenu">Tambah Diskusi</a>
    </div>

    <div class="col-md-8">
        <h1 style="color: black;" class="my-4">Forum
          <small>diskusi E-KSTM</small>
        </h1>
        <br>
        <?php if ($cari != ''): ?>
          <p>Hasil pencarian untuk keyword `<?= $cari ?>`</p>
        <?php endif; ?>

        <?php
          $count = count($forum);
          $perPage = 4;
          $numberOfPages = ceil($count / $perPage);
          $offset = $page * $perPage;
          $sliceForum = array_slice($forum, $offset, $perPage);
         foreach($sliceForum as $f) :
        ?>
        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="<?= base_url('assets/img/forum/') . $f['foto']; ?>" alt="Card image cap" style="max-height:300px;">
          <div class="card-body">
            <h2 class="card-title" style="color: black;"><?= $f['topik_bahasan'] ?></h2>
            <p class="card-text"><?= substr($f['keterangan_bahasan'], 0, 200) ?>...</p>
            <a href="<?= base_url('forum/diskusi/');echo $f['id_forum']; ?>" class="btn btn-primary">Baca lebih &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Di muat pada <?= date('d F Y, h:i:s A', $f['tanggal_dibuat']); ?>
            <p style="color: black;">Oleh <?= $f['name'] ?></p>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Pagination -->
        <?php $paget = $page+1; $pagel =  $page-1;?>
        <?php if (  $count > $perPage+1): ?>
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item <?= $page+1 >= $numberOfPages ?'disabled':''; ?>" >
              <a class="page-link" href="<?= base_url('forum/index/' . $paget); ?>">&larr; Lebih Lama</a>
            </li>
            <li class="page-item <?= $page-1 < 0 ?'disabled':''; ?>" >
              <a class="page-link" href="<?= base_url('forum/index/' . $pagel);?>">Lebih baru &rarr;</a>
            </li>
          </ul>
        <?php endif; ?>




      </div>
      <!-- end col 8 -->

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <form class="" action="<?= base_url('forum') ?>" method="post">
          <div class="card my-4">
            <h5 class="card-header">Pencarian</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" name="cari" placeholder="Cari...">
                <span class="input-group-append">
                  <button class="btn btn-secondary" type="submit" name="search" value="terpencet">Cari!</button>
                </span>
              </div>
            </div>
          </div>
        </form>


        <!-- Categories Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->

        <!-- Side Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div> -->
      </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<div class="modal fade" id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="newSubmenuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuLabel">Tambah Diskusi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('forum'); ?>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" id="topik_bahasan" name="topik_bahasan" placeholder="Judul">
        </div>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Isi pembahasan</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="keterangan_bahasan"></textarea>
        </div>
        <div class="form-group custom-file">
          <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
          <label class="custom-file-label" for="foto">Pilih gambar</label>
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
