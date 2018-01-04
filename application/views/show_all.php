<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $this->lang->line('showallorders'); ?></title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
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
        <li><a href="<?php echo site_url('index.php/Show_data/show_all'); ?>"><i class="fa fa-television"></i> <?php echo $this->lang->line('showallorders'); ?></a></li>
      </ol>
    </section>
    <!-- Main content -->
<section class="content"> 
<div class="row"> 
  <div class="col-md-12">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
    <button type="button" id="btnopendata" data-toggle="modal" data-target="#opendata"></button>
    <div class="box box-primary" id="tabledata">
            <div class="box-body">
              <table id="show_all" class="table table-bordered table-striped table-hover responsive ">
                <thead>
                <tr>
                  <th width="12">PR No.</th>
                  <th width="26">Vendor</th>
                  <th width="9">PR Date</th>
                  <th width="10">Ref No.</th>
                  <th width="20">Warehouse</th>
                  <th width="1">HOD</th>
                  <th width="1">AC Team</th>
                  <th width="1">GM</th>
                  <th width="1">EFC</th>
                  <th width="8" align="center">Action.</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($row as $result) {?>
                 <tr>
                  <td><?php echo $result['prno']; ?></td>
                  <td><?php echo '<small class="label bg-primary">'.$result['Vendor'].'</small><br>'.$result['Vendor_name']; ?></td>
                  <td><?php $Newdate = nice_date($result['prdate'], 'Y-m-d'); echo $Newdate; ?></td>
                  <td><?php echo $result['refno']; ?></td>
                  <td>Warehouse</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                    <button type="button" class="btn btn-sm  btn-primary"  primary="<?php echo $result['prno']; ?>" onclick="opendata(this)"><i class="fa fa-fw fa-search"></i></button>
                    <button type="button" class="btn btn-sm  btn-success"><i class="fa fa-fw fa-print"></i></button>
                    <button type="button" class="btn btn-sm  btn-warning"><i class="fa fa-fw fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-close"></i></button>
                  </td>
                </tr>
                <? } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
          <!-- /.box -->
  </div>        
</div>          
</section>
<!-- Modal -->
<div id="opendata" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ดูข้อมูล <i id="idprimary"></i></h4>
      </div>
      <div class="modal-body" id="dispayopendata">
      </div>
      <div class="modal-footer">
        <div align="center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
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
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript" charset="utf-8" ></script>
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
        "aLengthMenu": [[ 4, 10, 25, -1], [ 4, 10, 25, "ทั้งหมด"]],
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
</script>
</body>
</html>