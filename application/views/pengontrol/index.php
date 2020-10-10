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
    <?= form_error('laporan', '<div class="alert alert-danger" role="alert">','</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <a href="#" class="btn btn-success mb-3"  data-toggle="modal" data-target="#newSubmenu">Tambah Laporan</a>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
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
          <th scope="col">foto</th>
          <th scope="col">video</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
         foreach($laporan_pengontrol as $r) :
        ?>
        <tr>
          <th scope="row"><?= $i ?></th>
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
            <td><?= $r['foto'] ?></td>
            <td><?= $r['video'] ?></td>
          <td>
            <a href="<?= base_url('pengontrol/edit/'); echo $r['id_laporan_pengontrol']; ?>" class="badge badge-primary">Ubah</a>
            <a class="badge badge-danger" style="color:white;" onclick="conDelete('<?= base_url("pengontrol/delete_laporan_pengontrol/"); echo $r['id_laporan_pengontrol']; ?>'); ">Hapus</a>
            <a href="<?= base_url('pengontrol/detail/'); echo $r['id_laporan_pengontrol']; ?>" class="badge badge-info">Detail</a>
          </td>
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

<div class="modal fade" id="newSubmenu" tabindex="-1" role="dialog" aria-labelledby="newSubmenuLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuLabel">Tambah Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('pengontrol'); ?>
      <div class="modal-body">
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Deskripsi Laporan</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="deskripsi_laporan"></textarea>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="jenis_ternak" name="jenis_ternak" placeholder="Jenis Ternak">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_sebelumnya" name="jumlah_ternak_sebelumnya" placeholder="Jumlah ternak sebelumnya">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_sekarang" name="jumlah_ternak_sekarang" placeholder="Jumlah ternak sekarang">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_meninggal" name="jumlah_ternak_meninggal" placeholder="Jumlah ternak meninggal">
        </div>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Keterangan ternak meninggal</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="keterangan_ternak_meninggal"></textarea>
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_sehat" name="jumlah_ternak_sehat" placeholder="Jumlah ternak sehat">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_sakit" name="jumlah_ternak_sakit" placeholder="Jumlah ternak sakit">
        </div>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Keterangan kesehatan ternak</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="keterangan_kesehatan_ternak"></textarea>
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_dikonsumsi" name="jumlah_ternak_dikonsumsi" placeholder="Jumlah ternak dikonsumsi">
        </div>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Keterangan konsumsi ternak</span>
          </div>
          <textarea class="form-control" aria-label="With textarea" name="keterangan_konsumsi"></textarea>
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="jumlah_ternak_dijual" name="jumlah_ternak_dijual" placeholder="Jumlah ternak dijual">
        </div>
        <div class="form-group">
          <input type="number" class="form-control" id="harga_ternak_perekor" name="harga_ternak_perekor" placeholder="Harga ternak perekor">
        </div>
        <div class="form-group custom-file">
          <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
          <label class="custom-file-label" for="image">Pilih image</label>
        </div>
        <div class="form-group custom-file">
          <input type="file" class="custom-file-input" id="image" name="video" accept="video/*">
          <label class="custom-file-label" for="image">Pilih video</label>
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
