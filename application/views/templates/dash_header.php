<!-- untuk membuat pagenya terus https -->
<?php
	if($_SERVER['HTTPS']!="on")
	{
		 $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 header("Location:$redirect");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=  $title; ?></title>

	<link rel="shortcut icon" href="<?= base_url('assets/') ?>favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?= base_url('assets/') ?>favicon.ico" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>css/blog-home.css" rel="stylesheet">
	<link href="<?= base_url('assets/'); ?>css/blog-post.css" rel="stylesheet">

	<style class="cp-pen-styles">body {
	  -webkit-font-smoothing: antialiased;
	}

	#frame {
	  width: 95%;
	  min-width: 360px;
	  max-width: 1000px;
	  height: 92vh;
	  min-height: 300px;
	  max-height: 720px;
	  background: #E6EAEA;
	}
	@media screen and (max-width: 360px) {
	  #frame {
	    width: 100%;
	    height: 100vh;
	  }
	}
	#frame .content {
	  float: left;
	  width: 100%;
	  height: 100%;
	  overflow: hidden;
	  position: relative;
	}
	@media screen and (max-width: 735px) {
	  #frame .content {
	    width: calc(100%);
	    min-width: 300px !important;
	  }
	}
	@media screen and (min-width: 900px) {
	  #frame .content {
	    width: calc(100%);
	  }
	}
	#frame .content .contact-profile {
	  width: 100%;
	  height: 60px;
	  line-height: 60px;
	  background: #f5f5f5;
	}
	#frame .content .contact-profile img {
	  width: 40px;
	  border-radius: 50%;
	  float: left;
	  margin: 9px 12px 0 9px;
	}
	#frame .content .contact-profile p {
	  float: left;
	}
	#frame .content .contact-profile .social-media {
	  float: right;
	}
	#frame .content .contact-profile .social-media i {
	  margin-left: 14px;
	  cursor: pointer;
	}
	#frame .content .contact-profile .social-media i:nth-last-child(1) {
	  margin-right: 20px;
	}
	#frame .content .contact-profile .social-media i:hover {
	  color: #435f7a;
	}
	#frame .content .messages {
	  height: auto;
	  min-height: calc(100% - 93px);
	  max-height: calc(100% - 93px);
	  overflow-y: scroll;
	  overflow-x: hidden;
	}
	@media screen and (max-width: 735px) {
	  #frame .content .messages {
	    max-height: calc(100% - 105px);
	  }
	}
	#frame .content .messages::-webkit-scrollbar {
	  width: 8px;
	  background: transparent;
	}
	#frame .content .messages::-webkit-scrollbar-thumb {
	  background-color: rgba(0, 0, 0, 0.3);
	}
	#frame .content .messages ul li {
	  display: inline-block;
	  clear: both;
	  float: left;
	  margin: 15px 15px 5px 15px;
	  width: calc(100% - 25px);
	  font-size: 0.9em;
	}
	#frame .content .messages ul li:nth-last-child(1) {
	  margin-bottom: 20px;
	}
	#frame .content .messages ul li.sent img {
	  margin: 6px 8px 0 0;
	}
	#frame .content .messages ul li.sent p {
	  background: #435f7a;
	  color: #f5f5f5;
	}
	#frame .content .messages ul li.replies img {
	  float: right;
	  margin: 6px 0 0 8px;
	}
	#frame .content .messages ul li.replies p {
	  background: #f5f5f5;
	  float: right;
	}
	#frame .content .messages ul li img {
	  width: 22px;
	  border-radius: 50%;
	  float: left;
	}
	#frame .content .messages ul li p {
	  display: inline-block;
	  padding: 10px 15px;
	  border-radius: 20px;
	  max-width: 205px;
	  line-height: 130%;
	}
	@media screen and (min-width: 735px) {
	  #frame .content .messages ul li p {
	    max-width: 300px;
	  }
	}
	#frame .content .message-input {
	  position: absolute;
	  bottom: 0;
	  width: 100%;
	  z-index: 99;
	}
	#frame .content .message-input .wrap {
	  position: relative;
	}
	#frame .content .message-input .wrap input {
	  font-family: "proxima-nova",  "Source Sans Pro", sans-serif;
	  float: left;
	  border: none;
	  width: calc(100% - 90px);
	  padding: 11px 32px 10px 8px;
	  font-size: 0.8em;
	  color: #32465a;
	}
	@media screen and (max-width: 735px) {
	  #frame .content .message-input .wrap input {
	    padding: 15px 32px 16px 8px;
	  }
	}
	#frame .content .message-input .wrap input:focus {
	  outline: none;
	}
	#frame .content .message-input .wrap .attachment {
	  position: absolute;
	  right: 60px;
	  z-index: 4;
	  margin-top: 10px;
	  font-size: 1.1em;
	  color: #435f7a;
	  opacity: .5;
	  cursor: pointer;
	}
	@media screen and (max-width: 735px) {
	  #frame .content .message-input .wrap .attachment {
	    margin-top: 17px;
	    right: 65px;
	  }
	}
	#frame .content .message-input .wrap .attachment:hover {
	  opacity: 1;
	}
	#frame .content .message-input .wrap button {
	  float: right;
	  border: none;
	  width: 50px;
	  padding: 12px 0;
	  cursor: pointer;
	  background: #32465a;
	  color: #f5f5f5;
	}
	@media screen and (max-width: 735px) {
	  #frame .content .message-input .wrap button {
	    padding: 16px 0;
	  }
	}
	#frame .content .message-input .wrap button:hover {
	  background: #435f7a;
	}
	#frame .content .message-input .wrap button:focus {
	  outline: none;
	}
	</style>

	<style type="text/css">
 a:hover {
  cursor:pointer;
 }
 textarea{
	 white-space: pre-wrap;
 }
 @media only screen and (min-width: 650px) {
  .res {
    margin-top: 0;
		margin-bottom: 0;
  }

}
</style>

</head>

<body id="page-top" style="padding:0;">

  <!-- Page Wrapper -->
  <div id="wrapper">
