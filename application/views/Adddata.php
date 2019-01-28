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
                <?php echo $this->lang->line('adddata'); ?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('index.php/Dashboard/Adddata'); ?>"><i class="fa fa-dashboard"></i>
                        <?php echo $this->lang->line('adddata'); ?></a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">เพิ่มข้อมูล
                                    Warehouse</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">เพิ่มข้อมูล
                                    ประเภทสินค้า</a></li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Tab 3</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div align="right" style="margin-bottom: 10px;">
                                    <button class="btn btn-sm btn-success">เพิ่ม Warehouse</button>
                                </div>
                                <table class="table table-condensed table-bordered">
                                    <tr class="bg-primary">
                                        <td align="center">Code</td>
                                        <td>Name Code</td>
                                        <td align="center">Action</td>
                                    </tr>
                                    <?php foreach ($warehouse as $key => $row) { ?>
                                    <tr>
                                        <td align="center"><?php echo $row->warecode; ?></td>
                                        <td><?php echo $row->waredesc1; ?></td>
                                        <td><button class="btn btn-sm btn-warning">แก้ไข</button></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div align="right" style="margin-bottom: 10px;">
                                    <button class="btn btn-sm btn-success">เพิ่ม ประเภทสินค้า</button>
                                </div>
                                <table class="table table-condensed table-bordered">
                                    <tr class="bg-primary">
                                        <td align="center">Code</td>
                                        <td>Thai Name</td>
                                        <td>English Name</td>
                                        <td align="center">Action</td>
                                    </tr>
                                    <?php foreach ($unittype as $key => $row) { ?>
                                    <tr>
                                        <td align="center"><?php echo $row->mcode; ?></td>
                                        <td><?php echo $row->mdesc1; ?></td>
                                        <td><?php echo $row->mdesc2; ?></td>
                                        <td><button class="btn btn-sm btn-warning">แก้ไข</button></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen
                                book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing
                                software
                                like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
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