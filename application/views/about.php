<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo $this->lang->line('titlev'); echo ' '.$this->lang->line('numberv'); ?>
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive.bootstrap4.css'; ?>">
    <!-- Css Modifly -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css_modifly/css_show_all.css'; ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php echo $this->lang->line('about'); ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('index.php/Dashboard/About'); ?>"><i class="fa fa-user-md"
                            aria-hidden="true"></i>
                        <?php echo $this->lang->line('about'); ?></a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #ea5e30 !important;"><div class="widget-user-image"><img class="direct-chat-img" style="width: 80px; height: 80px; float: unset;" src="<?php echo base_url().'assets/icon/thezignhotel.gif'; ?>"></div></span>
                        <div class="info-box-content">
                            <span class="info-box-number">TheZign Hotel</span>
                            <span class="info-box-text">Continuous support !</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color:#b51c1f;"><div class="widget-user-image"><img class="direct-chat-img" style="width: 80px; height: 80px; float: unset;" src="<?php echo base_url().'assets/icon/gardenhotel.gif'; ?>"></div></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Garden Seaview Hotel</span>
                            <span class="info-box-text">Coming soon !</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>    
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color:#be036f;"><div class="widget-user-image"><img class="direct-chat-img" style="width: 80px; height: 80px; float: unset;" src="<?php echo base_url().'assets/icon/wayhotel.gif'; ?>"></div></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Way Hotel</span>
                            <span class="info-box-text">Coming soon !</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>                                         
                </div>
                <div class="col-md-4">
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header" style="background-color: #ea5e30 !important;">
                            <div class="widget-user-image">
                                <img class="img-circle" src="<?php echo base_url().'assets/icon/thitiponginlom.jpg'; ?>"
                                    alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Thitipong Inlom</h3>
                            <h5 class="widget-user-desc">IT Support</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">สถานที่ทำงาน <span class="pull-right badge bg-aqua">TheZign
                                            Hotel</span></a></li>
                                <li><a href="#">เบอร์ติดต่อ <span class="pull-right badge bg-green">086 -
                                            4633160</span></a></li>
                                <li><a href="#">Copyright © <span class="pull-right badge bg-red">2017 - 2019</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content-wrapper -->
    </div>
    <!-- DataTables -->
    <script
        src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>">
    </script>
    <script
        src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>">
    </script>
    <script
        src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap4.js'; ?>"
        type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript"
        src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.dateFormat.js'; ?>">
    </script>
    <!-- SlimScroll -->
    <script
        src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>">
    </script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/Chart.js/Chart.js';?>"></script>
    <!-- Dashboard Modifiy -->
    <script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/dashdoard.js'; ?>"></script>
</body>

</html>