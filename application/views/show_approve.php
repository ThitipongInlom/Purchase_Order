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
    page-break-after: always;
    }
    #printSection {
    position:absolute;
    left:0;
    top:0;
    margin:auto;
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('approvedprocessing'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
        <li><a href="<?php echo site_url('index.php/Show_data/show_approve'); ?>"><i class="fa fa-handshake-o"></i> <?php echo $this->lang->line('approvedprocessing'); ?></a></li>
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
                <div class="col-md-10 col-xs-8">
                <div class="form-inline">
                <div class="form-group">
                <label for="hsearch">ค้นหาจากวันที่: </label>
                <div class="input-group">
                <input type="text" class="form-control datepicker" id="hsearch" placeholder="วันที่ค้นหาเริ่ม" value="">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                </div>
                <button class="btn btn-primary" onclick="searchapprove(this);">ค้นหา</button>
                <button class="btn btn-success" onclick="blackupapprove(this);">รีเฟรช</button>
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
                <input type="hidden" id="sessionusername" value="<?php echo $this->session->username; ?>">
                <input type="hidden" id="sessiondep" value="<?php echo $this->session->dep; ?>">
                <table id="show_all" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover responsive table-condensed">
                  <thead>
                    <tr align="center">
                      <th>PR No.</th>
                      <th>Vendor</th>
                      <th>PR Date</th>
                      <th>Ref No.</th>
                      <th>Department/Warehouse</th>
                      <th>Comment PR</th>
                      <th>HOD</th>
                      <th>AC</th>
                      <th>GM</th>
                      <th>EFC</th>
                      <th>Action.</th>
                      <th>HodAV</th>
                      <th>HodAC</th>
                      <th>HodGM</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($row as $result) { ?>
                    <tr align="center" id="rowred<?php echo $result['NO']; ?>" class="">
                      <td><?php echo $result['prno']; ?>
                      <?php
                        if ($result['express'] == 'true') {
                          echo "<br><img width='55' src='".base_url().'/assets/icon/express.gif'."'>";
                        }
                      ?>
                      </td>
                      <td><div align="left">
                        <?php echo  $result['Vendor_name'].' - <b>'.$result['Vendor'].'</b>';?>
                        <br>
                        <?php  if ($this->session->dep =='AC') {
                            echo '<button type="button" class="btn btn-xs btn-warning" prid="'.$result['prno'].'" onclick="Setvenderprmodel(this)" venderold="'.$result['Vendor'].'"><i class="fa fa-fw fa-refresh"></i></button></div><input type="hidden" id="Setvenderprmodelshow" data-toggle="modal" data-target="#Setvenderprmodel">';
                          } ?>
                      </div></td>
                      <td valign="top"><?php
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
                      $username = $this->session->username;
                      if ($username=='Somkhit') {
                        echo '<b>ACC: </b>'.$PRApprove.'<br><b>HOD: </b>'.$HdApprove;
                      }elseif ($username=='Nalinee') {
                        echo '<b>GM: </b>'.$GMApprove.'<br><b>ACC:</b>'.$PRApprove;
                      }else{echo '<b>HOD: </b>'.$Newdate;} ?></td>
                      <td><?php echo $result['refno'];  ?></td>
                      <td><?php
                        echo  '<div align="left">[D] '; echo '<b>'.$result['dep'].'</b> => '; echo $result['Dep_name'].'<br>[W] '; echo '<b>'.$result['warecode'].'</b> => '; echo namewarecode($result['warecode']); echo'</div>';?></td>
                        <td><input type="text" onchange="statusapp(this);" style="font-size: 13px; width: 100%; height: 17px;" statusapppr="<?php echo $result['prno']; ?>" deppr="<?php echo$result['Dep_name']; ?>" class="form-control"  <?php
                          if($this->session->dep =='AC' OR $this->session->username =='Somkhit' OR $this->session->username == 'Nalinee'){
                            echo '';
                          }else{
                            echo 'Disabled';
                          }
                        ?> value="<?php echo $result['statusapp'];?>">
                        <?php
                        if ($result['statusdatetime']!='') {
                        echo '<div align="left">'.nice_date($result['statusdatetime'], 'd-m-Y').''.' <b>'.$result['statusby'].'</b></div>';
                        } ?></td>
                        <td><?php if ($result['HdApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x"  aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$HdApprove.'"></i>';
                          }elseif ($result['HdApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['PRApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$PRApprove.'"></i>';
                          }elseif ($result['PRApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['GMApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$GMApprove.'"></i>';
                          }elseif ($result['GMApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['EFCApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$EFCApprove.'"></i>';
                          }elseif ($result['EFCApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td>
                          <button type="button" class="btn btn-xs  btn-primary"  primary="<?php echo $result['prno']; ?>" rowred="<?php echo $result['NO']; ?>" onclick="opendata(this)" data-toggle="tooltip" data-placement="bottom" title="ดูข้อมูล"><i class="fa fa-fw fa-search"></i></button>
                          <?php
                          if ($result['GMApprove']=='Y' OR $result['EFCApprove']=='Y') {
                            if ($this->session->username =='Nalinee') {
                           echo '<button type="button" class="btn btn-xs  btn-warning" primary="'.$result['prno'].'" onclick="edit(this)" data-toggle="tooltip" data-placement="bottom" title="อนุมัติ"><i class="fa fa-fw fa-edit"></i></button>';
                            }
                          if ($this->session->username =='Somkid') {
                          echo '
                          <button type="button" class="btn btn-xs  btn-warning" primary="'.$result['prno'].'" onclick="edit(this)" data-toggle="tooltip" data-placement="bottom" title="แก้ไขข้อมูล"><i class="fa fa-fw fa-edit"></i></button>
                          ';
                          }
                          }else{
                          echo '
                          <button type="button" class="btn btn-xs  btn-warning" primary="'.$result['prno'].'" onclick="edit(this)" data-toggle="tooltip" data-placement="bottom" title="แก้ไขข้อมูล"><i class="fa fa-fw fa-edit"></i></button>
                          ';
                          }
                          ?>
                        </td>
                        <td><?php echo $HdApprove; ?></td>
                        <td><?php echo $PRApprove;  ?></td>
                        <td><?php echo $GMApprove;  ?></td>
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

          <!-- Modal Set-->
    <div id="Setvenderprmodel" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Set Vender ใหม่ <span id="headsetvender"></span><input type="hidden" id="headsetvenderinput"></h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <table class="table table-striped" cellspacing="0" width="100%">
            <tr>
            <div class="col-md-2 col-xs-2">
            <td width="25%"><input type="text" id="vendor" class="form-control input-sm" readonly></td>
            </div>
            <div class="col-md-4 col-xs-4">
            <td width="50%" align="center"><input type="text" id="vendorname" class="form-control input-sm" readonly></td>
            </div>
            <div class="col-md-2 col-xs4">
            <td width="25%"><select class="form-control" style="width:100%;" id="getvender" onchange="setvender(this.value)"></select>
            </td>
            </div>
            </tr>
            </table>
            </div>
            <div align="center">
            <button type="button" class="btn btn-success" onclick="savesetvenderpr(this);">บันทึก</button>
            </div>
          </div>
          <div class="modal-footer">
            <div align="center">
              <button type="button" class="btn btn-danger" id="closeSetvenderpr" data-dismiss="modal">ปิด</button>
            </div>
          </div>
        </div>
      </div>
    </div>

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
    <script type="text/javascript" src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.numFormat.js'; ?>"></script>
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
    "fixedColumns":{  "heightMatch":"auto","leftColumns":"9"},
    "colReorder": "true",
    "aLengthMenu": [[ -1], [ "ทั้งหมด"]],
    "columnDefs": [
    { "width": "8%", "targets": 0 ,"type": 'signed-num'},
    { "width": "17%", "targets": 1 },
    { "width": "11%", "type":"date-eu", "targets": 2 },
    { "width": "5%", "targets": 3 },
    { "width": "20%", "targets": 4 },
    { "width": "20%", "targets": 5 },
    { "width": "1%", "targets": 6 ,"orderData": [ 6, 11 ], "type":"date-eu"},
    { "width": "1%", "targets": 7 ,"orderData": [ 7, 12 ], "type":"date-eu"},
    { "width": "1%", "targets": 8 ,"orderData": [ 8, 13 ], "type":"date-eu"},
    { "width": "1%", "targets": 9 },
    { "width": "6%", "targets": 10 },
    { "width": "10%", "targets": 11 ,"visible": false, "searchable": false, "type":"date-eu"},
    { "width": "10%", "targets": 12 ,"visible": false, "searchable": false, "type":"date-eu"},
    { "width": "10%", "targets": 13 ,"visible": false, "searchable": false, "type":"date-eu"},
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

    if ($.cookie('rowid') != 'undefined') {
        var sessionusername = $("#sessionusername").val();
        var sessiondep      = $("#sessiondep").val();
        if (sessionusername == 'Somkhit' || sessiondep == 'AC') {
        console.log("#rowred"+$.cookie('rowid'));
        $("#rowred"+$.cookie('rowid')).css({"background-color": "rgb(202, 222, 33)"});
        }
      }else{
        var sessionusername = $("#sessionusername").val();
        if (sessionusername == 'Somkhit' || sessiondep == 'AC') {
        console.log($.cookie('rowid'));
        $("#rowred"+$.cookie('rowid')).css({"background-color": "rgb(202, 222, 33)"});
        }
    }

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
