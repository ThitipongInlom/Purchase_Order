<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
/*
if (empty($this->session->user_id)) {
   redirect('', 'refresh');
}
*/
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
  <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
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
<input type="hidden" id="id_alert" value="<?php echo $this->session->user_id; ?>">
<!-- Site wrapper -->
<div class="wrapper">
  <input type="hidden" id="id_alert" value="<?php echo $this->session->user_id; ?>">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('Home'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>QR</span>
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
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="num_alert"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">คุณมีการแจ้งเตือนทั้งหมด<span id="num_alert2" style="padding-left: 2px; padding-right: 2px;"></span>การแจ้งเตือน</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <div id="ceremenu">
                <ul class="menu">
                </ul>
                </div>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-gears"></i>
            </a>
             <ul class="dropdown-menu" style="right: 0;">
               <li>
                  <a href="<?php echo site_url('Profile'); ?>">
                  <button type="button" class="btn btn-primary btn-flat btn-block" >โปรไฟล์</button>
                  </a>
              </li>
              <li>
                  <a data-toggle="modal" data-target="#modal-default">  
                  <button type="button" class="btn btn-danger btn-flat btn-block">ออกจากระบบ</button>
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
        <li class="header">เมนูหลัก</li>
        <li class="treeview <?php 
            if(
              $this->input->server('REQUEST_URI') == '/Home' ||
              $this->input->server('REQUEST_URI') == '/AddType'
            ){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-cog"></i> <span>ระบบ</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/Home') 
            {echo 'active';}?>"><a href="<?php echo site_url('Home'); ?>"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
          <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/AddType') 
            {echo 'active';}?>"><a href="<?php echo site_url('AddType'); ?>"><i class="fa fa-plus"></i> เพิ่มประเภทสินค้า</a></li>
          </ul>
        </li>
        <li class="treeview <?php 
            if(
              $this->input->server('REQUEST_URI') == '/GenItem'
            ){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-folder-open"></i> <span>สร้าง</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
          <ul class="treeview-menu">
            <li class="<?php 
            if($this->input->server('REQUEST_URI') == '/GenItem') 
            {echo 'active';}?>"><a href="<?php echo site_url('GenItem'); ?>"><i class="fa fa-plus-circle"></i> เพิ่มสินค้า</a></li>
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
                <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-success btn-flat" id="logout">ยืนยัน <i class="fa fa-refresh fa-spin fa-fw" id="loginicon" style="margin-right: 2px;"></i> </button>
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
<!-- JS Logout -->
<script src="<?php echo base_url().'/assets/js_modifly/logout.js'; ?>"></script>
<!-- JS Alert Load -->
<script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/alert_load.js'; ?>"></script>
</body>
</html>