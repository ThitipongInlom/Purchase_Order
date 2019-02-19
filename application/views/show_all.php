<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$beta = $this->load->database('bo', TRUE);
function namewarecode($warecode)
{
$CI =& get_instance();
$beta = $CI->load->database('bo', TRUE);
$query = $beta->get_where('STFC0070', array('warecode' => $warecode));
$result = $query->result_array();
$waredesc1 = $result[0]['waredesc1'];
return $waredesc1;
}
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
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'; ?>">
    <!-- daterange picker -->
  	<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css';?>">
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.css';?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/css/select2.min.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive1.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive2.css'; ?>">
    <!-- Css Modifly -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css_modifly/css_show_all.css'; ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    @media screen {
    #printSection {
    display: none;
    }
    }
    @media print {
    body * {
    visibility:hidden;
    }
    #printSection, #printSection * {
    visibility:visible;
    }
    #printSection {
    position:absolute;
    left:0;
    top:0;
    font-size: 10px;
    }
    }
    .table-stripedstyle > tbody > tr:nth-child(2n+1) > td, .table-stripedstyle > tbody > tr:nth-child(2n+1) > th {
    background-color: #D4E6F1;
    background-repeat: no-repeat;
	  }
    #loginicon{
      display: none;
    }
    div {
      font-size: 13px;
    }
    td {
      font-size: 13px;
    }
    </style>
  </head>
  <body>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        <?php echo $this->lang->line('showallorders'); ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
          <li><a href="<?php echo site_url('index.php/Show_data/show_all'); ?>"><i class="fa fa-book"></i> <?php echo $this->lang->line('showallorders'); ?></a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row non-printable">
          <div class="col-md-12">
            <div class="spinner">
              <div class="bounce1"></div>
              <div class="bounce2"></div>
              <div class="bounce3"></div>
            </div>
            <button type="button" id="btnopendata" data-toggle="modal" data-target="#opendata"></button>
            <div class="box box-primary" id="tabledata">
              <div class="box-body">
              	<div class="row">
              	<div  class="col-md-10 col-xs-8">
              	<div class="form-inline">
						    <div class="form-group">
						  	<label for="hsearch">ค้นหาจากวันที่: </label>
						  	<div class="input-group">
						    <input type="text" class="form-control datepicker" id="hsearch" placeholder="วันที่ค้นหาเริ่ม" value="">
						    <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
							  </div>
							  <button class="btn btn-primary" onclick="searchpr(this);">ค้นหา</button>
							  <button class="btn btn-success" onclick="blackupallpr(this);">รีเฟรช</button>
						    </div>
                </div>
                </div>
              	<div class="col-md-2 col-xs-4">
                  <div align="right">
              			<button class="btn btn-primary btn-sm" onclick="accajaxopenproduct2(this)">ค้นหาProduct</button><input type="hidden" data-toggle="modal" data-target="#productmodel" id="openproduct">
                    <button class="btn btn-warning btn-sm" onclick="accajaxopenproductv(this)">ค้นหาVendor</button><input type="hidden" data-toggle="modal" data-target="#vendormodel" id="openvendor">
                  </div>
              	</div>
              	</div>
                <div class="table-responsive">
                  <table id="show_all" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover responsive table-condensed table-stripedstyle">
                    <thead>
                      <tr align="center">
                        <th width="12" align="center">PR No.</th>
                        <th width="28" align="center">Vendor</th>
                        <th width="9" align="center">PR Date</th>
                        <th width="10" align="center">Ref No.</th>
                        <th width="20" align="center">Warehouse</th>
                        <th width="1" align="center">HOD</th>
                        <th width="1" align="center">AC</th>
                        <th width="1" align="center">HM</th>
                        <th width="1" align="center">EFC</th>
                        <th width="6" align="center">Action.</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($row as $result) {
                      $Newdate = nice_date($result['prdate'], 'd-m-Y');
                      if ($result['HdApprove']=='Y') {
                        $HdApprove = nice_date($result['HdApprove_Date'], 'd-m-Y');
                      }else{
                        $HdApprove = '';
                      }
                      if ($result['PRApprove']=='Y') {
                        $PRApprove = nice_date($result['PRApprove_Date'], 'd-m-Y');
                      }else{
                        $HdApprove = '';
                      }
                      if ($result['GMApprove']=='Y') {
                        $GMApprove = nice_date($result['GMApprove_Date'], 'd-m-Y');
                      }else{
                        $GMApprove = '';
                      }
                      if ($result['EFCApprove']=='Y') {
                        $EFCApprove = nice_date($result['EFCApprove_Date'], 'd-m-Y');
                      }else{
                        $EFCApprove = '';
                      }
                      ?>
                      <tr align="center">
                        <td><?php echo $result['prno']; ?></td>
                        <td><div align="left"><?php echo $result['Vendor_name'].' - <b>'.$result['Vendor'].'</b>'; ?>
                        <?php
                        if ($result['express'] == 'true') {
                          echo "  <img width='55' src='".base_url().'/assets/icon/express.gif'."'>";
                        }
                        ?>
                        </div>
                        </td>
                        <td><?php $Newdate = nice_date($result['prdate'], 'd-m-Y'); echo $Newdate; ?></td>
                        <td><?php echo $result['refno'];  ?></td>
                        <td><?php
                          if (empty($result['warecode'])) {
                          echo '';
                          }else{
                          echo  '<div align="left">';print_r(namewarecode($result['warecode'])); echo ' - <b>'.$result['warecode'].'</b></div>';
                        }?></td>
                        <td><?php if ($result['HdApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$HdApprove.'"></i>';
                          }elseif ($result['HdApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['PRApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$PRApprove.'"></i>';
                          }elseif ($result['PRApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td></td>
                        <td></td>
                        <td>
                          <button type="button" class="btn btn-xs  btn-primary"  primary="<?php echo $result['prno']; ?>" onclick="opendata(this)" data-toggle="tooltip" data-placement="bottom" title="ดูข้อมูล"><i class="fa fa-fw fa-search"></i></button>
                          <button type="button" class="btn btn-xs  btn-success" primary="<?php echo $result['prno']; ?>" onclick="btnprint(this)" data-toggle="tooltip" data-placement="bottom" title="พิมพ์ข้อมูล"><i class="fa fa-fw fa-print"></i></button>
                          <button type="button" class="btn btn-xs  btn-warning" primary="<?php echo $result['prno']; ?>" onclick="edit(this)" data-toggle="tooltip" data-placement="bottom" title="แก้ไขข้อมูล"><i class="fa fa-fw fa-edit"></i></button>
                          <button type="button" class="btn btn-xs btn-danger" primary="<?php echo $result['prno']; ?>" onclick="deletedata(this)"  data-toggle="tooltip" data-placement="left" title="ลบข้อมูล"
                          <?php
                          if ($result['HdApprove']=='Y') {
                            echo 'disabled';
                          }
                          ?>><i class="fa fa-fw fa-close"></i></button>
                        </td>
                      </tr>
                      <? } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Modal -->
      <div id="opendata" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">ดูข้อมูล <i id="idprimary"></i></h4>
            </div>
            <div class="modal-body" id="dispayopendata">
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-wrapper -->
	<!-- Modal -->
    <div id="productmodel" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ค้นหา Product</h4>
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
  <!-- Modal -->
    <div id="vendormodel" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ค้นหา Vendor</h4>
          </div>
          <div class="modal-body" id="showlistitemv">
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
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive1.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive2.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive3.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive4.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.dateFormat.js'; ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- bootstrap datepicker -->
	<script src="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'; ?>"></script>
	<!-- date-range-picker -->
	<script src="<?php echo base_url().'/assets/adminlte/bower_components/moment/min/moment.min.js'; ?>"></script>
	<script src="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js'; ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
    <!-- JS Modal  -->
    <script src="<?php echo base_url().'/assets/js_modifly/modal_show_all.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/js_modifly/addpr.js'; ?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $('.datepicker').daterangepicker();
    $(".spinner").hide();
    $("#tabledata").show();
    $('#show_all').DataTable({
    "lengthChange": false,
    "searching": true,
    "responsive": "true",
    "paging": "false",
    "colReorder": "true",
    "aLengthMenu": [[ -1], [ "ทั้งหมด"]],
    "columnDefs": [
    { "width": "8%", "targets": 0 },
    { "width": "32%", "targets": 1 },
    { "width": "7%", "type":"date-eu", "targets": 2 },
    { "width": "6%", "targets": 3 },
    { "width": "24%", "targets": 4 },
    { "width": "1%", "targets": 5 },
    { "width": "1%", "targets": 6 },
    { "width": "1%", "targets": 7 },
    { "width": "1%", "targets": 8 },
    { "width": "12%", "targets": 9 }
    ],
    "language": {
    "lengthMenu":"แสดง _MENU_ แถว",
    "search":"ค้นหา:",
    "info":"แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ แถว",
    "infoEmpty":"แสดง 0 ถึง 0 ทั้งหมด 0 แถว",
    "infoFiltered":"(จาก ทั้งหมด _MAX_ ทั้งหมด แถว)",
    "processing": "กำลังโหลดข้อมูล...",
    "zeroRecords": "ไม่มีข้อมูล",
    "paginate": {
    "first": "หน้าแรก",
    "last": "หน้าสุดท้าย",
    "next": "ต่อไป",
    "previous": "ย้อนกลับ"
    },
    },
    "order":[[3,'desc']],
    //"ordering": false,
    "initComplete": function(settings, json) {
    setTimeout(function(){ $(".overlay").fadeOut('3000', function() {
    }); }, 1000);
    }
    });
    });
    </script>
  </body>
</html>
