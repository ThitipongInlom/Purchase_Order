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
        <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/css/select2.min.css';?>">
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
    <!-- Alertify -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/alertify/css/alertify.min.css'; ?>" />    
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
                                    <button class="btn btn-sm btn-success" onclick="AddDatavendor();">เพิ่ม
                                        Vendor</button>
                                </div>
                                <table class="table table-condensed table-bordered" id="table_vendor" width="100%">
                                    <thead>
                                    <tr class="bg-primary">
                                        <td align="center">Code</td>
                                        <td>Name Code</td>
                                        <td align="center">Action</td>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div align="right" style="margin-bottom: 10px;">
                                    <button class="btn btn-sm btn-success" onclick="AddDataproduct();">เพิ่ม สินค้า</button>
                                </div>
                                <table class="table table-condensed table-bordered" id="table_product" width="100%">
                                    <thead>
                                        <tr class="bg-primary">
                                            <td align="center">Code</td>
                                            <td>Name Code</td>
                                            <td>Unit</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data -->
            <div class="modal fade" id="EditDatavendor" tabindex="-1" role="dialog" aria-labelledby="EditLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="EditvendorLabel">แก้ไขข้อมูล</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="EditCodeWarehouse">Code</label>
                                    <input type="text" class="form-control" id="EditCodevendor" placeholder="Code">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="EditvendorName">Name Code</label>
                                    <input type="text" class="form-control" id="EditvendorName" placeholder="Name Code">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-success" onclick="SaveEditvendor();">ยืนยัน แก้ไขข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Data -->
            <div class="modal fade" id="AddDatavendor" tabindex="-1" role="dialog"
                aria-labelledby="AddWarehouseLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="AddvendorLabel">เพิ่มข้อมูล Vendor</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="CodeWarehouse">Code</label>
                                    <input type="text" class="form-control" id="Codevendor" placeholder="Code">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="CodeWarehouse">Name Code</label>
                                    <input type="text" class="form-control" id="vendorName" placeholder="Name Code">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-success" onclick="SaveAddvendor();">ยืนยัน
                                เพิ่มข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Data -->
            <div class="modal fade" id="AddDataproduct" tabindex="-1" role="dialog"
                aria-labelledby="AddDataproductLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="AddDataproductLabel">เพิ่มข้อมูล Product</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="product_name">Name Product</label>
                                    <input type="text" class="form-control" id="product_name" placeholder="ชื่อสินค้า">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="product_unit">Product Unit</label>    
                                    <select class="form-control input-sm col-md-2" id="product_unit" width="100%"></select>   
                                </div>                             
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-success" onclick="SaveProduct();">ยืนยัน เพิ่มข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Data -->
            <div class="modal fade" id="EditDataproduct" tabindex="-1" role="dialog"
                aria-labelledby="EditDataproductLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="EditDataproductLabel">แก้ไข Product</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" id="code_product_hide">
                                <div class="form-group col-md-6">
                                    <label for="product_name">Name Product</label>
                                    <input type="text" class="form-control" id="edit_product_name" placeholder="ชื่อสินค้า">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="product_unit">Product Unit</label>    
                                    <select class="form-control input-sm col-md-2" id="edit_product_unit" width="100%"></select>   
                                </div>                             
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-success" onclick="EditSaveProduct();">ยืนยัน เพิ่มข้อมูล</button>
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
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/Chart.js/Chart.js';?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
</body>
<!-- Type Script -->
<script type="text/javascript">
$(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'throw';
    // Product Data Table
    var table_product = $('#table_product').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": "<?php echo site_url('index.php/Dashboard/product_table '); ?>"
        },
        "columns": [{
                "data": 'stcode',
            },
            {
                "data": 'stname1'
            },
            {
                "data": 'stunit1'
            },{
                data:'stcode',
                render:function(data,type,row){
                    var Action = '<button class="btn btn-sm btn-warning" dataid='+ data +' onclick="EditDataproduct(this);">แก้ไข</button>  <button class="btn btn-sm btn-danger" dataid='+ data +' onclick="Deleteproduct(this);">ลบ</button>';
                    return Action;
                },
                orderable: false
            }
        ],
        "columnDefs": [
        { "className": 'text-left', "targets": [] },
        { "className": 'text-center', "targets": [0, ] },
        ],
        "language": {
            "lengthMenu": "แสดง _MENU_ คน",
            "search": "ค้นหา:",
            "info": "แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ คน",
            "infoEmpty": "แสดง 0 ถึง 0 ทั้งหมด 0 คน",
            "infoFiltered": "(จาก ทั้งหมด _MAX_ ทั้งหมด คน)",
            "processing": "กำลังโหลดข้อมูล...",
            "zeroRecords": "ไม่มีข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ต่อไป",
                "previous": "ย้อนกลับ"
            },
        },
    });
    // Vendor Data Table
    var table_vendor = $('#table_vendor').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": "<?php echo site_url('index.php/Dashboard/vendor_table '); ?>"
        },
        "columns": [{
                "data": 'vencode',
            },
            {
                "data": 'venname1'
            },
            {
                data:'vencode',
                render:function(data,type,row){
                    var Action = '<button class="btn btn-sm btn-warning" dataid='+ data +' onclick="EditDatavendor(this);">แก้ไข</button>  <button class="btn btn-sm btn-danger" id="btndel" dataid='+ data +' onclick="Deltevendor(this);">ลบ</button>';
                    return Action;
                },
                orderable: false
            }
        ],
        "columnDefs": [
        { "className": 'text-left', "targets": [] },
        { "className": 'text-center', "targets": [0, ] },
        ],
        "language": {
            "lengthMenu": "แสดง _MENU_ คน",
            "search": "ค้นหา:",
            "info": "แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ คน",
            "infoEmpty": "แสดง 0 ถึง 0 ทั้งหมด 0 คน",
            "infoFiltered": "(จาก ทั้งหมด _MAX_ ทั้งหมด คน)",
            "processing": "กำลังโหลดข้อมูล...",
            "zeroRecords": "ไม่มีข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ต่อไป",
                "previous": "ย้อนกลับ"
            },
        },
    });
    // Model Add vendor Hide Reset Form And Table reset
    $('#AddDatavendor').on('hidden.bs.modal', function (e) {
    $("#Codevendor").val('');
    $("#vendorName").val('');
    table_vendor.draw();
    e.preventDefault();
    });
    // End Add vendor Hide Reset Form And Table reset

    // Model Edit vendor Hide Reset Form And Table reset
    $('#EditDatavendor').on('hidden.bs.modal', function (e) {
    $("#EditCodevendor").val('');
    $("#EditvendorName").val('');
    table_vendor.draw();
    e.preventDefault();
    });    
    // End Edit vendor Hide Reset Form And Table reset   

    // Model Add Product Hide Reset Form And Table reset
    $('#AddDataproduct').on('hidden.bs.modal', function (e) {
    $("#product_name").val('');
    $("#product_unit").val('');
    table_product.draw();
    e.preventDefault();
    });    
    // End Add Product Hide Reset Form And Table reset    

    // Model Edit Product Hide Reset Form And Table reset
    $('#EditDataproduct').on('hidden.bs.modal', function (e) {
    $("#edit_product_name").val('');
    $("#edit_product_unit").val('');
    table_product.draw();
    e.preventDefault();
    });    
    // End Edit Product Hide Reset Form And Table reset    

});
</script>
    <!-- Dashboard Modifiy -->
    <script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/dashdoard.js'; ?>"></script>
</html>