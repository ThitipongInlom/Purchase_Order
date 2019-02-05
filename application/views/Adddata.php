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
                                    Vendor</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">เพิ่มข้อมูล
                                    สินค้า</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div align="right" style="margin-bottom: 10px;">
                                    <button class="btn btn-sm btn-success" onclick="AddDataWarehouse();">เพิ่ม
                                        Vendor</button>
                                </div>
                                <table class="table table-condensed table-bordered">
                                    <tr class="bg-primary">
                                        <td align="center">Code</td>
                                        <td>Name Code</td>
                                        <td align="center">Action</td>
                                    </tr>
                                    <?php foreach ($Getvendor as $key => $row) { ?>
                                    <tr>
                                        <td align="center"><?php echo $row->vencode; ?></td>
                                        <td><?php echo $row->venname1; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#EditData">แก้ไข</button>
                                            <button class="btn btn-sm btn-danger">ลบ</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div align="right" style="margin-bottom: 10px;">
                                    <button class="btn btn-sm btn-success">เพิ่ม สินค้า</button>
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
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#EditData">แก้ไข</button>
                                            <button class="btn btn-sm btn-danger">ลบ</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data -->
            <div class="modal fade" id="EditData" tabindex="-1" role="dialog" aria-labelledby="EditLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditLabel">แก้ไขข้อมูล</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Data -->
            <div class="modal fade" id="AddDataWarehouse" tabindex="-1" role="dialog"
                aria-labelledby="AddWarehouseLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="AddWarehouseLabel">เพิ่มข้อมูล Vendor</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="CodeWarehouse">Code</label>
                                    <input type="text" class="form-control" id="CodeWarehouse" placeholder="Code">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="CodeWarehouse">Name Code</label>
                                    <input type="text" class="form-control" id="WarehouseName" placeholder="Name Code">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-success" onclick="SaveAddWarehouse();">ยืนยัน เพิ่มข้อมูล</button>
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