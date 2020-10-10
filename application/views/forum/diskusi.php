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
      <?= form_error('diskusi', '<div class="alert alert-danger" role="alert">','</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
    </div>
    <!-- Post Content Column -->
      <div class="col-lg-12">

        <!-- Title -->
        <h1 style="color: black;" class="mt-4"><?= $forum['topik_bahasan'] ?></h1>

        <!-- Author -->
        <p class="lead" style="color: black;">
          Oleh
          <a><?= $forum['name'] ?></a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Di muat pada <?= date('d F Y, h:i:s A', $forum['tanggal_dibuat']); ?></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded mx-auto d-block" src="<?= base_url('assets/img/forum/') . $forum['foto']; ?>" alt="gambar post" style="max-height:300px;">

        <hr>

        <!-- Post Content -->
        <p style="white-space: pre-line"><?= $forum['keterangan_bahasan'] ?></p>

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Tinggalkan Komentar:</h5>
          <div class="card-body">
            <form action="<?= base_url('forum/diskusi/');echo $forum['id_forum']; ?>" method="post">
              <div class="form-group">
                <textarea class="form-control" rows="3" name="isi_tanggapan"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <?php
          $i = 1;
         foreach($komen as $k) :
        ?>
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="<?= base_url('assets/img/profile/') . $k['image']; ?>" alt="foto" width="50" height="50">
          <div class="media-body">
            <h5 style="color: black;" class="mt-0"><?= $k['name'] ?></h5>
            <p style="white-space: pre-line"><?= $k['isi_tanggapan'] ?></p>
          </div>
        </div>
        <?php $i++; endforeach; ?>


        <!-- Comment with nested comments -->
        <!-- <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Commenter Name</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

            <div class="media mt-4">
              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
              <div class="media-body">
                <h5 class="mt-0">Commenter Name</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </div>

          </div>
        </div> -->

      </div>

      <!-- Sidebar Widgets Column -->
      <!-- <div class="col-md-4"> -->

        <!-- Search Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div> -->

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
          </div> -->
        <!-- </div> -->

        <!-- Side Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div> -->

      <!-- </div> -->

  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
