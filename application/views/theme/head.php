<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

if (empty($this->session->username)) {
  redirect('', 'refresh');
}
if ($this->session->lang == 'english') {
  $this->lang->load('message','english');
}else{
  $this->lang->load('message','thai');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-purple fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('Dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>O</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Purchase</b> <b>Order</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-gears"></i>
            </a>
             <ul class="dropdown-menu" style="right: 0;">
               <li>
                  <a href="<?php echo site_url('Profile'); ?>">
                  <button type="button" class="btn btn-primary  btn-block" >โปรไฟล์</button>
                  </a>
              </li>
              <li>
                  <a data-toggle="modal" data-target="#modal-default">  
                  <button type="button" class="btn btn-danger  btn-block">ออกจากระบบ</button>
                  </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><?php echo $this->lang->line('mainmenu');?></li>
        <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Dashboard/Dashboard') 
            {echo 'active';}?>">
          <a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?>
          </a>
        </li>
        <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_all') 
            {echo 'active';}?>">
          <a href="<?php echo site_url('index.php/Show_data/show_all'); ?>">
            <i class="fa fa-television"></i> <?php echo $this->lang->line('showallorders'); ?>
          </a>
        </li>
        <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_approve') 
            {echo 'active';}?>">
          <a href="<?php echo site_url('index.php/Show_data/show_approve'); ?>">
            <i class="fa fa-television"></i> <?php echo $this->lang->line('approvedprocessing'); ?>
          </a>
        </li>
        <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_completed') 
            {echo 'active';}?>">
          <a href="<?php echo site_url('index.php/Show_data/show_completed'); ?>">
            <i class="fa fa-television"></i> <?php echo $this->lang->line('completed'); ?>
          </a>
        </li>
        <li class="treeview <?php 
            if(
              $this->input->server('REQUEST_URI') == '/PO/index.php/Dashboard/Dashboard2' 
              
            ){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-cog"></i> <span>ระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Dashboard/Dashboard2') 
            {echo 'active';}?>"><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- =============================================== -->
<div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ยืนยันการออกจากระบบ</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left " data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-success " id="logout">ยืนยัน <i class="fa fa-refresh fa-spin fa-fw" id="logouticon" style="margin-right: 2px;"></i> </button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery/dist/jquery.min.js'; ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url().'/assets/adminlte//bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/adminlte/dist/js/adminlte.min.js'; ?>"></script>
<!-- Logout -->
<script src="<?php echo base_url().'assets/js_modifly/logout.js'; ?>"></script>
</body>
</html>