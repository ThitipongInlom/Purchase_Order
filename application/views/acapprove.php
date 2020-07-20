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
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css';?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/css/select2.min.css';?>">           
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
    @page {
    size: A4;
    margin: 0;
    }
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
    page[size="A4"] {
      width: 21cm;
      height: 29.7cm;
      display: block;
      margin: 1cm auto;
      margin-bottom: 0.5cm;
    }     
    </style>
  </head>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('acappovecheck'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
        <li><a href="<?php echo site_url('index.php/Show_data/Fax'); ?>"><i class="fa fa-check"></i> <?php echo $this->lang->line('acappovecheck'); ?></a></li>
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
          <input type="hidden" id="btnopendatafax" data-toggle="modal" data-target="#opendatafax">
          <div class="box box-primary" id="tabledata">
            <div class="box-body">
              <div class="row" style="margin-bottom:10px;">
                <div class="col-md-9 col-xs-8">
                 
                </div>
                <div class="col-md-3 col-xs-4">
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
                      <th>BOX</th>
                      <th>PR No.</th>
                      <th>Vendor</th>
                      <th>PR Date</th>
                      <th>Ref No.</th>
                      <th>Department/Warehouse</th>
                      <th>HOD</th>
                      <th>AC</th>
                      <th>GM</th>
                      <th>EFC</th>
                      <th>Action.</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                  </table>
                    <div align="center">
                      <button class="btn btn-success" onclick="ACappovecheck_submit();" id="btnrcok">OK</button>
                    </div>
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
              <h4 class="modal-title">ดูข้อมูล</h4>
            </div>
            <div class="modal-body" id="dispayopendata">
          
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div id="opendatafax" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">ดูข้อมูล</h4>
            </div>
            <div align="center"><br><button class="btn btn-success" id="savefax">FAX</button></div>
            <hr>
            <div class="modal-body" id="dispayopendatafax">
          
            </div>
          </div>
        </div>
      </div>

    <!-- Modal -->
    <div id="productmodel" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ค้นหาProduct</h4>
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
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>     
    <!-- date-range-picker -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/moment/min/moment.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js'; ?>"></script>     
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
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
    "lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
    "serverSide": true,
    "processing": true,
    "ajax": {
        "url": "<?php echo site_url('index.php/Get_table_data/Show_Table_show_acapprove'); ?>",
        "type": "POST",
    },
    "columnDefs": [
    { "data": 'checkbox', "width": "5%", "targets": 0 , "className": 'text-center' },
    { "data": 'prno', "width": "10%", "targets": 1 },
    { "data": 'vendor', "width": "28%", "targets": 2 },
    { "data": 'prdate', "width": "9%", "type":"date-eu", "targets": 3 },
    { "data": 'refno', "width": "8%", "targets": 4 },
    { "data": 'warecode', "width": "20%", "targets": 5 },
    { "data": 'HdApprove', "width": "1%", "targets": 6 },
    { "data": 'PRApprove', "width": "1%", "targets": 7 },
    { "data": 'GMApprove', "width": "1%", "targets": 8 },
    { "data": 'EFCApprove', "width": "1%", "targets": 9 },
    { "data": 'action', "width": "5%", "targets": 10 , "className": 'text-center' },
    { "orderable": "false"}
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
    "order":[[0,'desc']],
    "initComplete": function(settings, json) {
    setTimeout(function(){ $(".overlay").fadeOut('3000', function() {
    }); }, 1000);
    }
    });
    });

    var linkurl = function linkurl() {
    var url = "../../index.php/URL";
    var Httpreq = new XMLHttpRequest(); 
    Httpreq.open("GET",url,false);
    Httpreq.send(null);
    return Httpreq.responseText; 
    }
    var statusapp = function statusapp(e) {
      var urlresult = JSON.parse(linkurl());
      var prid = $(e).attr('statusapppr');
      var deppr = $(e).attr('deppr');
      var statusappval = $(e).val();
      $.ajax({
        url: urlresult.statusapp,
        type: 'POST',
        data: {prid: prid,statusappval: statusappval,deppr: deppr},
        success: function (callblack) {
        alertify.set('notifier','position', 'อัพเดตเสร็จสิ้น');
        alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
        }
      });
    }      
    </script>
  </html>