<!doctype html>
<html lang="">
<head>
  <title>Travel Algoritma Genetika</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Blank Page | Propeller - Admin Dashboard">
  <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
  <title></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>template/themes/images/favicon.ico">
  <!-- Google icon -->
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/fonts/material-icons/material-icons.css">
  <!-- Bootstrap css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/assets/css/bootstrap.min.css">
  <!-- Propeller css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/assets/css/propeller.min.css">
  <!-- Propeller theme css-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/themes/css/propeller-theme.css" />
  <!-- Propeller admin theme css-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/themes/css/propeller-admin.css">
<script src="<?php echo base_url('template/') ?>assets/js/jquery-1.12.2.min.js"></script>
<script src="<?php echo base_url('template/') ?>assets/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiDdGyp6n2hKHPECuB6JZIT-8dVHCpwI0&language=id&region=pekanbaru&libraries=places"></script>
</head>
<body>
  <!-- Header Starts -->
  <!--Start Nav bar -->
  <nav class="navbar navbar-inverse navbar-fixed-top pmd-navbar pmd-z-depth">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a href="javascript:void(0);" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect pull-left margin-r8 pmd-sidebar-toggle"><i class="material-icons">menu</i></a> 
        <a href="#" class="navbar-brand">
      </a>
    </div>
  </div>
</nav>
<!-- Left sidebar -->
<aside class="pmd-sidebar sidebar-default pmd-sidebar-slide-push pmd-sidebar-left pmd-sidebar-open bg-fill-darkblue sidebar-with-icons" role="navigation">
  <ul class="nav pmd-sidebar-nav">
    <!-- User info -->
    <!-- End user info -->
    <li> 
      <a class="pmd-ripple-effect" href="<?php echo base_url('induk/tampil_data') ?>"> 
        <i class="media-left media-middle"><svg version="1.1" x="0px" y="0px" width="19.83px" height="18px" viewBox="287.725 407.535 19.83 18" enable-background="new 287.725 407.535 19.83 18"
         xml:space="preserve">
         <g>
          <path fill="#C9C8C8" d="M307.555,407.535h-9.108v10.264h9.108V407.535z M287.725,407.535v6.232h9.109v-6.232H287.725z
          M296.834,415.271h-9.109v10.264h9.109V415.271z M307.555,419.303h-9.108v6.232h9.108V419.303z"/>
        </g>
      </svg></i>
      <span class="media-body">Master Data</span>
    </a> 
  </li>
  <li> 
    <a class="pmd-ripple-effect" href="<?php echo base_url('induk/tampil_bobot') ?>"> 
      <i class="media-left media-middle"></i>
      <span class="media-body">Bobot</span>
    </a> 
  </li>
  <li> 
    <a class="pmd-ripple-effect" href="<?php echo base_url('induk/tampil_hitung') ?>"> 
      <i class="media-left media-middle"></i>
      <span class="media-body">Perhitungan</span>
    </a> 
  </li>
</ul>
</aside>
<div id="content" class="pmd-content content-area dashboard">
  <div class="container-fluid">
    <?php echo $template['body']; ?>
</div>
</div>  
<script>
  $(document).ready(function() {
    var sPath=window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $(".pmd-sidebar-nav").each(function(){
      $(this).find("a[href='"+sPage+"']").parents(".dropdown").addClass("open");
      $(this).find("a[href='"+sPage+"']").parents(".dropdown").find('.dropdown-menu').css("display", "block");
      $(this).find("a[href='"+sPage+"']").parents(".dropdown").find('a.dropdown-toggle').addClass("active");
      $(this).find("a[href='"+sPage+"']").addClass("active");
    });
  });
</script>
</body>
</html>