<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?=  $title; ?></h1>

<div class="row">
  <div class="col-lg-12 table-responsive">
    <?php if(validation_errors()) : ?>
    <div class="alert alert-danger" role="alert">
      <?= validation_errors(); ?>
    </div>
    <?php endif; ?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">','</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <a href="#" class="btn btn-success mb-3"  data-toggle="modal" data-target="#newSubmenu">Add New Submenu</a>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Menu</th>
          <th scope="col">Url</th>
          <th scope="col">Icon</th>
          <th scope="col">Active</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
         foreach($subMenu as $sm) :
        ?>
        <tr>
          <th scope="row"><?= $i ?></th>
            <td><?= $sm['title'] ?></td>
            <td><?= $sm['menu'] ?></td>
            <td><?= $sm['url'] ?></td>
            <td><?= $sm['icon'] ?></td>
            <td><?= $sm['is_active'] ?></td>
          <td>
            <a href="<?= base_url('menu/edit/'); echo $sm['id']; ?>" class="badge badge-primary">Edit</a>
            <a class="badge badge-danger" style="color:white;" onclick="conDelete('<?= base_url("menu/delete_subMenu/"); echo $sm['id']; ?>'); ">Delete</a>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubmenuLabel">Add New Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="<?= base_url('menu/submenu') ?>" method="post">
      <div class="modal-body">
      <div class="form-group">
        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu name">
      </div>
      <div class="form-group">
        <select class="form-cotrol" name="menu_id" id='menu_id'>
          <option value="">Select MENU</option>
          <?php foreach($menu as $m) : ?>
            <option value="<?= $m['id'] ?>"><?= $m['menu']  ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="icon" name="icon" placeholder="icon">
      </div>
      <div class="form-group">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" value="1" id="is_active" name="is_active" checked>
          <label class="form-check-label" for="is_active">Is active?</label>
        </div>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
