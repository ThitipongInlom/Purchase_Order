<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->lang->line('titlev'); echo ' '.$this->lang->line('numberv'); ?></title>
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
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive1.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive2.css'; ?>">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .centered {
      position: fixed;
      top: 50%;
      left: 50%;
      /* bring your own prefixes */
      transform: translate(-50%, -50%);
    }
    </style>
  </head>
  <body>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row centered" align="center">
          <i class="fa fa-fw fa-archive fa-5x"></i>
          <h3>ขออภัยกำลังปรับปรุงระบบ</h3>
          <h3>ติดต่อIT โทร 7367 หรือ 7368</h3>
        </div>
      </section>
        <!-- /.content-wrapper -->
        </div>
    <!-- DataTables -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive1.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive2.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive3.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive4.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.dateFormat.js'; ?>"></script>
      <!-- SlimScroll -->
      <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
      <!-- FastClick -->
      <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
      <!-- Morris.js charts -->
      <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
      <script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
    </body>
  </html>