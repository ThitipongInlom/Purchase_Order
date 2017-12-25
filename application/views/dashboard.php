<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        หน้ารวมสินค้า 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('Dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    <!-- Main content -->
<section class="content">   
       <div class="row">
        <div class="col-md-8">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
       </div>  
       <div class="row">
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Messages</span>
              <span class="info-box-number">1,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
       </div>
    </section>
  <!-- /.content-wrapper -->
  </div>
<!-- DataTables -->
<script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
<script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript" charset="utf-8" ></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
<script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
<script type="text/javascript">
  $(function () {
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: [
        {d: '2560', item1: 2666, item2: 2666},
        {d: '2561', item1: 2778, item2: 2294},
        {d: '2562', item1: 4912, item2: 1969},
        {d: '2563', item1: 3767, item2: 3597},
        {d: '2564', item1: 6810, item2: 1914},
        {d: '2565', item1: 5670, item2: 4293},
        {d: '2566', item1: 4820, item2: 3795},
        {d: '2567', item1: 15073, item2: 5967},
        {d: '2568', item1: 10687, item2: 4460},
        {d: '2569', item1: 8432, item2: 5713}
      ],
      xkey: 'd',
      ykeys: ['item1', 'item2'],
      labels: ['สินค้าทั้งหมด', 'สินค้าที่เบิก'],
      lineColors: ['#a0d0e0', '#3c8dbc'],
      hideHover: 'auto'
    });
  });
</script>
</body>
</html>