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
        <h1 style="color: black;" class="mt-4">Detail Laporan</h1>

        <!-- Author -->
        <p class="lead" style="color: black;">
          Perlapor :
          <a><?= $laporan['name'] ?></a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Di laporkan pada <?= date('d F Y, h:i:s A', $laporan['tanggal_laporan']); ?></p>

        <hr>

        <!-- Preview Image -->
        <?php if ($tipe == 'pengontrol' and $laporan['foto'] != ''): ?>
          <img class="img-fluid rounded mx-auto d-block" src="<?= base_url('assets/img/pengontrol/') . $laporan['foto']; ?>" alt="gambar post" style="max-height:300px;">
          <hr>
        <?php endif; ?>



        <!-- Post Content -->
        <p style="white-space: pre-line">Deskripsi Laporan : <?= $laporan['deskripsi_laporan'] ?></p>

<br>
        <!-- Post Content -->
        <p style="white-space: pre-line">Jenis Ternak : <?= $laporan['jenis_ternak'] ?></p>
        <p style="white-space: pre-line">Jumlah Ternak Sebelumnya : <?= $laporan['jumlah_ternak_sebelumnya'] ?></p>
        <p style="white-space: pre-line">Jumlah Ternak Sekarang : <?= $laporan['jumlah_ternak_sekarang'] ?></p>
        <p style="white-space: pre-line">Jumlah Ternak Meninggal : <?= $laporan['jumlah_ternak_meninggal'] ?></p>
        <p style="white-space: pre-line">Keterangan Ternak Meninggal : <?= $laporan['keterangan_ternak_meninggal'] ?></p>
<br>
        <p style="white-space: pre-line">Jumlah Ternak Sehat : <?= $laporan['jumlah_ternak_sehat'] ?></p>
        <p style="white-space: pre-line">Jumlah Ternak Sakit : <?= $laporan['jumlah_ternak_sakit'] ?></p>
        <p style="white-space: pre-line">Keterangan Kesehatan Ternak : <?= $laporan['keterangan_kesehatan_ternak'] ?></p>
<br>
        <p style="white-space: pre-line">Jumlah Ternak Dikonsumsi : <?= $laporan['jumlah_ternak_dikonsumsi'] ?></p>
        <p style="white-space: pre-line">Keterangan Konsumsi Ternak : <?= $laporan['keterangan_konsumsi'] ?></p>
<br>
        <p style="white-space: pre-line">Jumlah Ternak Dijual : <?= $laporan['jumlah_ternak_dijual'] ?></p>
        <p style="white-space: pre-line">Harga Ternak Perekor : Rp. <?= $laporan['harga_ternak_perekor'] ?></p>

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Tinggalkan Komentar:</h5>
          <div class="card-body">
            <?php if ($tipe == 'kstm'): ?>
            <form action="<?= base_url('rekap/detail/kstm/');echo $laporan['id_laporan_kstm']; ?>" method="post">
            <?php else: ?>
            <form action="<?= base_url('rekap/detail/pengontrol/');echo $laporan['id_laporan_pengontrol']; ?>" method="post">
            <?php endif; ?>
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

      </div>


  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
