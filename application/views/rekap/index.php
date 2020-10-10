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
  <div class="col-lg-6">
    <div class="btn-group dropright mb-5">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Laporan
      </button>
      <div class="dropdown-menu" >
        <a class="dropdown-item" href="<?= base_url('rekap/kstm') ?>">Laporan KSTM</a>
        <a class="dropdown-item" href="<?= base_url('rekap/pengontrol') ?>">Laporan Pengontrol Lapangan</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="float-right">
      <?php if ($tipe == "pengontrol"): ?>
        <a href="<?= base_url('rekap/exportCSV/pengontrol'); ?>" class="btn btn-success">Download CSV - Pengontrol</a>
      <?php else: ?>
        <a href="<?= base_url('rekap/exportCSV/kstm'); ?>" class="btn btn-success">Download CSV - KSTM</a>
      <?php endif; ?>
    </div>
  </div>

  <div class="col-lg-12 table-responsive">
    <?php if(validation_errors()) : ?>
    <div class="alert alert-danger" role="alert">
      <?= validation_errors(); ?>
    </div>
    <?php endif; ?>
    <?= form_error('akun', '<div class="alert alert-danger" role="alert">','</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Pelapor</th>
          <th scope="col">Tanggal Laporan</th>
          <th scope="col">Deskripsi Laporan</th>
          <th scope="col">Jenis Ternal</th>
          <th scope="col">Jumlah Ternak Sebelumnya</th>
          <th scope="col">Jumlah Ternak Sekarang</th>
          <th scope="col">Jumlah Ternak Meninggal</th>
          <th scope="col">Keterangan Ternak Meninggal</th>
          <th scope="col">Jumlah Ternak Sehat</th>
          <th scope="col">Jumlah Ternak Sakit</th>
          <th scope="col">Keterangan Kesehatan Ternak</th>
          <th scope="col">Jumlah Ternak Dikonsumsi</th>
          <th scope="col">Keterangan Konsumsi</th>
          <th scope="col">Jumlah Ternak Diual</th>
          <th scope="col">Harga Ternak Perekor</th>
          <?php if ($tipe == "pengontrol") {
            echo "
            <td> Foto </td>
            <td> Video </td>
            ";
          } ?>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
         foreach($laporan as $r) :
        ?>
        <tr>
          <th scope="row"><?= $i ?></th>
          <td><?= $r['name'] ?></td>
          <td><?= date('d F Y', $r['tanggal_laporan']); ?></td>
          <td><?= $r['deskripsi_laporan'] ?></td>
          <td><?= $r['jenis_ternak'] ?></td>
          <td><?= $r['jumlah_ternak_sebelumnya'] ?></td>
          <td><?= $r['jumlah_ternak_sekarang'] ?></td>
          <td><?= $r['jumlah_ternak_meninggal'] ?></td>
          <td><?= $r['keterangan_ternak_meninggal'] ?></td>
          <td><?= $r['jumlah_ternak_sehat'] ?></td>
          <td><?= $r['jumlah_ternak_sakit'] ?></td>
          <td><?= $r['keterangan_kesehatan_ternak'] ?></td>
          <td><?= $r['jumlah_ternak_dikonsumsi'] ?></td>
          <td><?= $r['keterangan_konsumsi'] ?></td>
          <td><?= $r['jumlah_ternak_dijual'] ?></td>
          <td><?= $r['harga_ternak_perekor'] ?></td>
          <?php if ($tipe == "kstm"): ?>
            <td>
              <a href="<?= base_url('rekap/detail/kstm/'); echo $r['id_laporan_kstm']; ?>" class="badge badge-info">Detail</a>
            </td>
          <?php endif; ?>
          <?php if ($tipe == "pengontrol"): ?>
            <td> <?= $r['foto'] ?> </td>
            <td> <?= $r['video'] ?> </td>
            <td>
              <a href="<?= base_url('rekap/detail/pengontrol/'); echo $r['id_laporan_pengontrol']; ?>" class="badge badge-info">Detail</a>
            </td>
          <?php endif; ?>


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
