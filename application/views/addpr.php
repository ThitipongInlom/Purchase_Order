<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$beta = $this->load->database('bo', TRUE);
$query = $beta->select('vencode, venname1');
$query = $beta->order_by('vencode', 'DESC');
$query = $beta->get('APFA0010');
$result = $query->result_array();
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
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/iCheck/all.css'; ?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'; ?>">
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.css';?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/css/select2.min.css';?>">
    <!-- Alertify -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/alertify/css/alertify.min.css'; ?>" />
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
    <style type="text/css">
    .overlay{
    display: none;
    }
    #loginicon{
      display: none;
    }
    </style>
  </head>
  <body>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        <?php echo $this->lang->line('addpr'); ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
          <li><a href="<?php echo site_url('index.php/Add_Pr/'); ?>"><i class="fa fa-plus"></i> <?php echo $this->lang->line('addpr'); ?></a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><?php echo $this->lang->line('purchase_request_entry'); ?></h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table cellspacing="0" width="100%" class="table table-bordered table-hover responsive">
                        <tr>
                          <td  width="10%" align="center"><h5><?php echo $this->lang->line('vendor'); ?></h5></td>
                          <td width="15%"><input type="text" id="vendor" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                          <td width="25%" align="center"><select class="form-control" id="getvender" width="100%" onchange="setvender(this.value)"></select></td>
                          <td width="50%"><input type="text" id="vendorname" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                        </tr>
                      </table>
                      <table cellspacing="0" width="100%" class="table table-bordered table-hover responsive">
                        <tr>
                          <td  width="10%" align="center"><h5><?php echo $this->lang->line('p/rno'); ?></h5></td>
                          <td width="15%"><input type="text" id="prno" class="form-control" value="<?php echo $newpr; ?>" disabled></td>
                          <td width="10%" align="center"><h5><?php echo $this->lang->line('warehouse'); ?></h5></td>
                          <td width="15%"><input type="text" id="warecode" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                          <td width="20%" align="center"><select class="form-control" id="getwarehouse" width="100%" onchange="setwarehouse(this.value)"></select></td>
                          <td width="25%"><input type="text" id="waredesc" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                        </tr>
                        <tr>
                          <td  width="10%" align="center"><h5><?php echo $this->lang->line('p/r_date'); ?></h5></td>
                          <td width="15%"><input type="text" class="form-control" value="<?php $Newdate = nice_date($prdate, 'd/m/Y'); echo $Newdate; ?>" disabled></td>
                          <td width="10%" align="center"><h5><?php echo $this->lang->line('division'); ?></h5></td>
                          <td width="15%"><input type="text" id="divisioncode" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                          <td width="10%" align="center"><select class="form-control col-md-2" id="getdivision" width="100%" onchange="setdivision(this.value)"></select></td>
                          <td width="45%"><input type="text" id="divisionname" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                        </tr>
                        <tr>
                          <td  width="10%" align="center"><h5><?php echo $this->lang->line('refno'); ?></h5></td>
                          <td width="15%"><input type="text" class="form-control" value="<?php echo $newref; ?>" disabled></td>
                          <td width="10%" align="center"><h5><?php echo $this->lang->line('dep'); ?></h5></td>
                          <td width="15%"><input type="text" id="depcode" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                          <td width="10%" align="center"><select class="form-control col-md-2" id="getdepartment" width="100%" onchange="setdepartment(this.value)"></select></td>
                          <td width="45%"><input type="text" id="depname" class="form-control" placeholder="<?php echo $this->lang->line('displayauto'); ?>" disabled></td>
                        </tr>
                        <tr>
                          <td align="center"><?php echo $this->lang->line('remark'); ?></td>
                          <td colspan="5"><textarea class="form-control" rows="3" placeholder="<?php echo $this->lang->line('remark'); ?>"></textarea></td>
                        </tr>
                        <tr>
                          <td width="10%" align="center"><h5>Discount(%)</h5></td>
                          <td><input type="text" class="form-control" value="0"></td>
                          <td width="10%" align="center"><h5>Discount</h5></td>
                          <td><input type="text" class="form-control" value="0"></td>
                          <td width="10%" align="center"><h5>Vat 7%</h5></td>
                          <td>
                            <div class="form-group" align="center">
                              <label>
                                <input type="radio" name="r2" class="flat-red">
                                Yes
                              </label>
                              <label>
                                <input type="radio" name="r2" class="flat-red" checked>
                                No
                              </label>
                            </div>
                          </td>
                        </tr>
                      </table>
                      <div align="center"><button type="button" class="btn btn-success" id="savepr">บันทึก</button></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
            </div>
            <div class="box box-danger">
              <div class="box-header">
                <h3 class="box-title">เพิ่มไอเท็ม</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <table cellspacing="0" width="100%" class="table table-bordered table-hover responsive">
                      <tr>
                        <td width="5%" align="center"><h5>Item</h5></td>
                        <td width="5%" align="center"><input type="text" id="itemprno" class="form-control"></td>
                        <td width="10%" align="center"><h5>Product Code</h5></td>
                        <td width="10%"><input type="text" id="productcode" class="form-control"></td>
                        <td width="5%"><button type="button" class="btn btn-primary btn-sm" onclick="ajaxopenproduct(this)">ค้นหา</button><input type="hidden" data-toggle="modal" data-target="#productmodel" id="openproduct"></td>
                        <td width="20%"><input type="text" id="itemstname1" class="form-control"></td>
                        <td width="5%"><input type="text" id="itemmdesc1" class="form-control"></td>
                        <td width="10%" align="center"><h5>Quantity</h5></td>
                        <td width="10%"><input type="text" id="itemprqty" class="form-control"></td>
                      </tr>
                      <tr>
                        <td width="10%" align="center"><h5>Last Purchase date</h5></td>
                        <td colspan="2">
                          <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right datepicker" id="itemlastpurdate">
                            </div>
                          </div>
                        </td>
                        <td width="10%" align="center"><h5>Last Unit Price</h5></td>
                        <td colspan="2"><input type="text" class="form-control" id="itemprpriceold"></td>
                        <td width="10%" align="center"><h5>Unit Price</h5></td>
                        <td colspan="2"><input type="text" class="form-control" id="itemprprice"></td>
                      </tr>
                      <tr>
                        <td width="10%" align="center"><h5>Delivery date</h5></td>
                        <td colspan="2">
                          <div class="form-group">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right datepicker" id="itemusedate">
                            </div>
                          </div>
                        </td>
                        <td width="10%" align="center"><h5>Remark</h5></td>
                        <td colspan="2"><input type="text" id="itemiremark" class="form-control"></td>
                        <td width="10%" align="center"><h5>Attach file</h5></td>
                        <td colspan="2"><h5><input type="file" id="itemifileupd" name="itemifileupd"></h5></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div align="center">
                <button type="button" class="btn btn-success" id="additem">เพิ่มไอเท็ม</button>
                </div>
              </div>
              <div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content-wrapper -->
      <!-- Modal -->
      <div id="productmodel" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">ค้นหา</h4>
            </div>
            <div class="modal-body" id="showlistitem">
            </div>
            <div class="modal-footer">
              <div align="center">
                <button type="button" class="btn btn-danger" id="closeshowlistitem" data-dismiss="modal">ปิด</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- DataTables -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript" charset="utf-8" ></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'; ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url().'assets/adminlte/plugins/iCheck/icheck.min.js';?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
    <!-- Add Pr Modifiy -->
    <script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/addpr.js'; ?>"></script>
    <script type="text/javascript">
    $(function () {
    $('input[type="radio"].flat-red').iCheck({
    radioClass   : 'iradio_flat-blue'
    })
    $('.datepicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy'
    })
    })
    </script>
  </body>
</html>