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
    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
    <!-- Css Modifly -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css_modifly/css_show_all.css'; ?>">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
    </style>
  </head>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('reject'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
        <li><a href="<?php echo site_url('index.php/Show_data/show_reject'); ?>"><i class="fa fa-television"></i> <?php echo $this->lang->line('reject'); ?></a></li>
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
              <div class="table-responsive">
                <table id="show_all" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover responsive ">
                  <thead>
                    <tr align="center">
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
                  <tbody>
                    <?php
                    foreach ($row as $result) { ?>
                    <tr align="center">
                      <td><?php echo $result['prno']; ?></td>
                      <td><?php echo  '<div align="left">'.$result['Vendor_name'].'<br><small class="label bg-primary">'.$result['Vendor'].'</small></div>'; ?></td>
                      <td><?php $Newdate = nice_date($result['prdate'], 'd-m-Y'); echo $Newdate; ?></td>
                      <td><?php echo $result['refno'];  ?></td>
                      <td><?php
                        echo  '<div align="left">[D] '; echo '<small class="label bg-primary">'.$result['dep'].'</small> => '; echo $result['Dep_name'].'<br>[W] '; echo '<small class="label bg-primary">'.$result['warecode'].'</small> => '; print_r(namewarecode($result['warecode'])); echo'</div>';?></td>
                        <td><?php if ($result['HdApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i>';
                          }elseif ($result['HdApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['PRApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i>';
                          }elseif ($result['PRApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['GMApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i>';
                          }elseif ($result['GMApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td><?php if ($result['EFCApprove']=='Y') {
                          echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i>';
                          }elseif ($result['EFCApprove']=='N'){
                          echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                        } ?></td>
                        <td>
                          <button type="button" class="btn btn-sm  btn-primary"  primary="<?php echo $result['prno']; ?>" onclick="opendata(this)"><i class="fa fa-fw fa-search"></i></button>
                          <button type="button" class="btn btn-sm  btn-success" primary="<?php echo $result['prno']; ?>" onclick="btnprint(this)"><i class="fa fa-fw fa-print"></i></button>
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
            <div class="modal-footer">
              <div align="center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary"  onclick="printdata(this)"><i class="fa fa-print"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- DataTables -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8" ></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript" charset="utf-8" ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript" charset="utf-8" ></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript" charset="utf-8" ></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
    <!-- JS Modal  -->
    <script src="<?php echo base_url().'/assets/js_modifly/modal_show_all.js'; ?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $(".spinner").hide();
    $("#tabledata").show();
    $('#show_all').DataTable({
    "responsive": "true",
    "paging": "false",
    "fixedColumns":{  "heightMatch":"auto","leftColumns":"9"},
    "colReorder": "true",
    "aLengthMenu": [[ 4, 10, 25, -1], [ 4, 10, 25, "ทั้งหมด"]],
    "columnDefs": [
    { "width": "10%", "targets": 0 },
    { "width": "30%", "targets": 1 },
    { "width": "10%", "targets": 2 },
    { "width": "8%", "targets": 3 },
    { "width": "20%", "targets": 4 },
    { "width": "1%", "targets": 5 },
    { "width": "1%", "targets": 6 },
    { "width": "1%", "targets": 7 },
    { "width": "1%", "targets": 8 },
    { "width": "10%", "targets": 9 },
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
    "order":[[0,'asc']],
    "initComplete": function(settings, json) {
    setTimeout(function(){ $(".overlay").fadeOut('3000', function() {
    }); }, 1000);
    }
    });
    });
    </script>
  </html>