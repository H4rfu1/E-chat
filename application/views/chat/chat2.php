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

    <div class="col-md-12">
      <div id="frame">
      	<div class="content">
      		<div class="contact-profile">
      			<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
      			<p>Harvey Specter</p>
      			<div class="social-media">
      				<i class="fa fa-facebook" aria-hidden="true"></i>
      				<i class="fa fa-twitter" aria-hidden="true"></i>
      				 <i class="fa fa-instagram" aria-hidden="true"></i>
      			</div>
      		</div>
      		<div class="messages">
      			<ul>
      				<li class="sent">
      					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
      					<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
      				</li>
      				<li class="replies">
      					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
      					<p>When you're backed against the wall, break the god damn thing down.</p>
      				</li>
      				<li class="replies">
      					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
      					<p>Excuses don't win championships.</p>
      				</li>
      				<li class="sent">
      					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
      					<p>Oh yeah, did Michael Jordan tell you that?</p>
      				</li>
      				<li class="replies">
      					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
      					<p>No, I told him that.</p>
      				</li>
      				<li class="replies">
      					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
      					<p>What are your choices when someone puts a gun to your head?</p>
      				</li>
      				<li class="sent">
      					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
      					<p>What are you talking about? You do what they say or they shoot you.</p>
      				</li>
      				<li class="replies">
      					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
      					<p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
      				</li>
      			</ul>
      		</div>
      		<div class="message-input">
      			<div class="wrap">
      			<input type="text" placeholder="Write your message..." />
      			<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
      			<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
      			</div>
      		</div>
      	</div>
      </div>
    </div>
      <!-- end col 8 -->
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
