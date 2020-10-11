<!-- query menu -->
<?php
$role_id = $this->session->userdata('role_id');
  $queryMenu = "SELECT `user_menu` . `id`, `menu`
                FROM `user_menu` JOIN `user_access_menu`
                ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_menu`.`menu` ASC
                ";

  $menu = $this->db->query($queryMenu)->result_array();

 ?>

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
      <?= form_error('ngobrol', '<div class="alert alert-danger" role="alert">','</div>'); ?>
      <?= $this->session->flashdata('message'); ?>
    </div>
    <!-- Post Content Column -->
      <div class="col-lg-12">
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

  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
