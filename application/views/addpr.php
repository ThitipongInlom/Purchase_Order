<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$beta = $this->load->database('bo', TRUE);
$query = $beta->select('vencode, venname1');
$query = $beta->order_by('vencode', 'DESC');
$query = $beta->get('APFA0010');
$result = $query->result_array();
$dep = $this->session->dep;
if ($pos = strrpos($dep, ",")) {
$dep1 = strstr($dep, ",", true);
}else{
$dep1 = $dep;
} 
$info = $beta->select("*")
  ->from("ZZFC0020")
  ->where("depcode",$dep1)
  ->get()
  ->row();
?>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive1.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive2.css'; ?>">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .overlay{
    display: none;
    }
    #loginicon{
    display: none;
    }
    #updataitem{
    display: none;
    }
    #colseupdate{
    display: none;
    }
    .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    }
    .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .cardnew {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    }
	 .divitemcolor
	 {
    background-color: #5CBB3A;
	 }
   h5{
    font-size: 15px;
   }
   input{
    font-size: 17px;
   }
   input:-moz-read-only { background: #ffffff !important;}
   input:read-only { background: #ffffff !important;}   
  .select2-selection{
  background-color:#b3d1ff !important;
  color:red !important;
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
            <div class="box box-success card">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table cellspacing="0" width="100%" class="table table-bordered table-hover responsive">
                        <form id="formpr" name="formpr">
                        <tr>
                          <td align="center"><h5><b><?php echo $this->lang->line('p/rno'); ?></b></h5></td>
                          <td ><input type="text" id="prno" class="form-control input-sm" style="width:auto;" value="<?php echo $newpr; ?>" readonly></td>
                          <td align="center"><h5><b><?php echo $this->lang->line('p/r_date'); ?></b></h5></td>
                          <td ><input type="text" class="form-control input-sm" style="width:auto;" value="<?php $Newdate = nice_date($prdate, 'd/m/Y'); echo $Newdate; ?>" readonly></td>
                          <td align="center"><h5><b><?php echo $this->lang->line('refno'); ?></b></h5></td>
                          <td><input type="text" class="form-control input-sm" style="width:auto;" value="<?php echo $newref; ?>" readonly></td>
                          <td align="center"><h5><b><?php echo $this->lang->line('p/r_date'); ?></b></h5></td>
                          <td ><input type="text" class="form-control input-sm" style="width:auto;" value="<?php $Newdate = nice_date($prdate, 'd/m/Y'); echo $Newdate; ?>" readonly></td>
                        </tr>
                        <tr>
                          <td align="center"><h5><b><?php echo $this->lang->line('vendor'); ?></b></h5></td>
                          <td><input type="text" id="vendor" class="form-control input-sm" style="width:auto;" readonly></td>
                          <td align="center"><input type="text" id="vendorname" class="form-control input-sm" style="width:auto;" readonly></td>
                          <td><select class="form-control input-sm" id="getvender" width="100%" onchange="setvender(this.value)"></select></td>
                          <td align="center"><h5><b><?php echo $this->lang->line('dep'); ?></b></h5></td>
                          <td><input type="text" id="depcode" class="form-control input-sm" style="width:auto;" value="<?php echo $dep1; ?>" readonly></td>
                          <td align="center"><input type="text" id="depname" class="form-control input-sm" style="width:auto;" value="<?php echo $info->depname1; ?>" readonly></td>
                          <td><select class="form-control input-sm col-md-2" id="getdepartment" width="100%" onchange="setdepartment(this.value)" disabled></select></td>
                        </tr>
                        <tr>
                          <td align="center"><h5><b><?php echo $this->lang->line('warehouse'); ?></b></h5></td>
                          <td ><input type="text" id="warecode" class="form-control input-sm" readonly></td>
                          <td align="center"><input type="text" id="waredesc" class="form-control input-sm" readonly></td>
                          <td ><select class="form-control input-sm" id="getwarehouse" width="100%" onchange="setwarehouse(this.value)"></select></td>
                          <td align="center"><h5><b><?php echo $this->lang->line('division'); ?></b></h5></td>
                          <td><input type="text" id="divisioncode" class="form-control input-sm" readonly></td>
                          <td align="center"><input type="text" id="divisionname" class="form-control input-sm" readonly></td>
                          <td><select class="form-control input-sm col-md-2" id="getdivision" width="100%" onchange="setdivision(this.value)"></select></td>
                        </tr>
                        <tr>
                          <td align="center"><b><?php echo $this->lang->line('remark'); ?></b></td>
                          <td colspan="6"><textarea class="form-control input-sm" rows="2" id="remark"></textarea></td>
                          <td>
                            <div valign="middle">
                              <div class="custom-control custom-checkbox" style="margin-top: 15px;">
                                <input type="checkbox" class="custom-control-input" id="express">
                                <label class="custom-control-label" for="express"><b style="color: red;">สั่งสินค้าแบบด่วน</b></label>
                              </div>
                            </div>
                          </td>                          
                        </tr>
                        </form>
                      </table>
                      </div>
                      <div class="box box-primary card panel panel-default divitemcolor" >
                        <!--
                        <div class="box-header">
                          <h4 class="box-title">ไอเท็ม</h4>
                        </div>-->
                        <div class="box-body">
                          <div class="table-responsive">
                            <div id="showtabledataitem"></div>
                          </div>
                          <div class="table-responsive">
                            <table cellspacing="0" width="100%" class="table table-bordered table-condensed responsive">
                              <tr class="trinfo">
                                <td width="5%" align="center"><h5><?php echo $this->lang->line('item'); ?></h5></td>
                                <td width="5%" align="center"><input type="text" id="itemprno" class="form-control input-sm" style="width:auto;" readonly></td>
                                <form id="formadditem" name="formadditem">
                                  <td width="8%" align="center"><h5><?php echo $this->lang->line('productcode'); ?></h5></td>
                                  <td width="10%"><input type="text" id="productcode" class="form-control input-sm" readonly></td>
                                  <td width="5%"><button type="button" class="btn btn-primary btn-sm input-sm" onclick="ajaxopenproduct(this)"><?php echo $this->lang->line('productsearch'); ?></button><input type="hidden" data-toggle="modal" data-target="#productmodel" id="openproduct"></td>
                                  <td width="25%" colspan="2"><input type="text" id="itemstname1" class="form-control input-sm" readonly></td>
                                  <td width="5%"><input type="text" id="itemmdesc1" class="form-control input-sm" readonly></td>
                                </tr>
                                <tr class="trinfo">
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('lastunitprice'); ?></h5></td>
                                  <td><input type="text" class="form-control input-sm" id="itemprpriceold"></td>
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('unitprice'); ?></h5></td>
                                  <td colspan="2"><input type="text" class="form-control input-sm" id="itemprprice" onchange="checkNumberunitprice();"></td>
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('quantity'); ?></h5></td>
                                  <td width="5%"><input type="text" id="itemprqty" class="form-control input-sm" onchange="checkNumberprqty();"></td>
                                  <td align="center"><h4><b><p id="Newitem" class="text-danger"></p></b></h4></td>                                  
                                </tr>
                                <tr class="trinfo">
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('lastpurchasedate'); ?></h5></td>
                                  <td colspan="2">
                                    <div align="center">
                                    <div class="form-group">
                                      <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker input-sm" id="itemlastpurdate">
                                      </div>
                                    </div>
                                    </div>
                                  </td>  
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('deliverydate'); ?></h5></td>
                                  <td colspan="2">
                                    <div align="center">
                                    <div class="form-group">
                                      <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker input-sm" id="itemusedate">
                                      </div>
                                    </div>
                                  </div>
                                  </td>                                                                  
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('attachfile'); ?></h5></td>
                                  <td><h5><input type="file" id="itemifileupd" name="itemifileupd"></h5></td>
                                </tr>  
                                <tr class="trinfo">
                                  <td width="10%" align="center"><h5><?php echo $this->lang->line('remark'); ?></h5></td>
                                  <td colspan="8"><input type="text" id="itemiremark" class="form-control input-sm"></td>
                                </tr>
                                </form>
                            </table>
                          </div>
                          <div align="center" >
                            <button type="button" class="btn btn-success" id="additem"><?php echo $this->lang->line('additem'); ?></button>
                            <button type="button" class="btn btn-warning" id="updataitem" onclick="updataitem(this);"><?php echo $this->lang->line('update'); ?></button>
                            <button type="button" class="btn btn-danger" id="colseupdate"><?php echo $this->lang->line('cancel'); ?></button>
                          </div>
                        </div>
                      </div>
                  <div class="table-responsive">
                  <table cellspacing="0" width="100%" class="table table-bordered table-hover responsive table-condensed">
                    <tr>
                      <td width="10%" align="center"><span><h5><?php echo $this->lang->line('vat'); ?></h5></span></td>
                      <td>
                        <div class="form-group " align="center">
                          <label>
                            <input type="radio" name="r2" class="flat-red" value="Y">
                            <?php echo $this->lang->line('yes'); ?>
                          </label>
                          <label>
                            <input type="radio" name="r2" class="flat-red" value="N" checked>
                            <?php echo $this->lang->line('no'); ?>
                          </label>
                        </div>
                      </td>
                      <td width="10%" align="center"><h5><?php echo $this->lang->line('discount%'); ?></h5></td>
                      <td><input type="text" class="form-control input-sm" value="0" id="dc" onchange="checkNumberdc();">
                      <span style="color: red;"><b><?php echo $this->lang->line('incaseofdiscountpleaseenterDiscountto0'); ?></b></span>
                    </td>
                    <td width="10%" align="center"><h5><?php echo $this->lang->line('discount'); ?></h5></td>
                    <td><input type="text" class="form-control input-sm" value="0" id="dc_a" onchange="checkNumberdc_a();">
                    <span style="color: red;"><b><?php echo $this->lang->line('incaseofdiscount,pleaseenterDiscount(%)to0'); ?></b></span>
                  </td>
                </tr>
              </table>
              <div align="center"><button type="button" class="btn btn-success" id="savepr"><?php echo $this->lang->line('save'); ?></button></div>
            </div>
            </div>
          </div>
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
        <h4 class="modal-title"><?php echo $this->lang->line('productsearch'); ?></h4>
      </div>
      <div class="modal-body" id="showlistitem">
      </div>
      <div class="modal-footer">
        <div align="center">
          <button type="button" class="btn btn-danger" id="closeshowlistitem" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
    <!-- DataTables -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive1.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive2.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive3.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive4.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.dateFormat.js'; ?>"></script>
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
format: 'mm/dd/yyyy',
clearBtn: true
})
})
</script>
</body>
</html>