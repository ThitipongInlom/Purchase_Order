<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive.bootstrap4.css'; ?>">
    <!-- Css Modifly -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css_modifly/css_show_all.css'; ?>">    
    <!-- Alertify -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/alertify/css/alertify.min.css'; ?>" />
    
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
        <?php echo $this->lang->line('Dashboard'); ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Dashboard'); ?></a></li>
        </ol>
      </section>
      <button type="button" id="btnopendata" data-toggle="modal" data-target="#opendata"></button>
      <section class="content">
        <div class="row">
          <div class="col-md-12">  
            <div class="box box-success">
                <div class="box-header with-border">
                <h3 class="box-title">PR Wait Apporve </h3>
            </div>
            <div class="box-body">
              <div class="row">  
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua">AC</span>
                    <div class="info-box-content">
                      <span class="info-box-text">AC APV</span>
                      <span class="info-box-number"><?php echo $acnoapp; ?> wait approve
                      </span>
                    </div>
                  </div>       
                </div>
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua">GM</span>
                    <div class="info-box-content">
                      <span class="info-box-text">GM APV</span>
                      <span class="info-box-number"><?php echo $gmnoapp; ?> wait approve</span>
                    </div>
                  </div>       
                </div>
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua">EFC</span>
                    <div class="info-box-content">
                      <span class="info-box-text">EFC</span>
                      <span class="info-box-number"><?php echo $efcnoapp; ?> wait approve</span>
                    </div>
                  </div>       
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">  
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">PR Comment</h3>
            </div>
            <div class="box-body">
              <div class="row">  
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table-sm">
                        <thead>
                          <tr class="text-center">
                            <th width="8%">Ref No.</th>
                            <th width="12%">PR Date</th>
                            <th width="18%">Vendor</th>
                            <th>Comment</th>
                            <th width="15%">Reply Comment</th>
                            <th width="5%">HOD</th>
                            <th width="5%">AC</th>
                            <th width="5%">GM</th>
                            <th width="5%">EFC</th>
                            <th width="8%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($table_call_back as $key => $row) { ?>
                        <?php 
                          $Newdate = nice_date($row->prdate, 'd-m-Y');
                          if ($row->HdApprove=='Y') {
                            $HdApprove = nice_date($row->HdApprove_Date, 'd-m-Y');
                          }else{
                            $HdApprove = '';
                          }
                          if ($row->PRApprove=='Y') {
                            $PRApprove = nice_date($row->PRApprove_Date, 'd-m-Y');
                          }else{
                            $HdApprove = '';
                          }
                          if ($row->GMApprove=='Y') {
                            $GMApprove = nice_date($row->GMApprove_Date, 'd-m-Y');
                          }else{
                            $GMApprove = '';
                          }
                          if ($row->EFCApprove=='Y') {
                            $EFCApprove = nice_date($row->EFCApprove_Date, 'd-m-Y');
                          }else{
                            $EFCApprove = '';
                          }  
                        ?>
                          <tr>
                            <td align="center"><b><?php echo $row->refno; ?></b></td>
                            <td><?php echo nice_date($row->prdate, 'd/m/Y') ?> | <b><?php echo $row->dep; ?></b></td>
                            <td><?php echo $row->Vendor_name.' - <b>'.$row->Vendor.'</b>'; ?></td>
                            <td>
                              <?php
                                $username = $this->session->username;
                                if ($username == 'Somkhit') {
                                  echo "<input type='text' class='form-control form-control-sm' onchange='statusapp(this);' statusapppr='$row->prno' deppr='$row->Dep_name' value='$row->statusapp' >";
                                }else {
                                  echo $row->statusapp; echo '<br>'; echo nice_date($row->statusdatetime, 'd-m-Y'); echo '<b>';  echo $row->statusby; echo'</b>'; 
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                                if ($username == 'Somkhit') {
                                  echo $row->rc_statusapp; echo '<br>'; if ($row->rc_statusdatetime == '') {} else {echo nice_date($row->rc_statusdatetime, 'd-m-Y');} echo '<b>';  echo $row->rc_statusby; echo'</b>'; 
                                }else {
                                  echo "<input type='text' class='form-control form-control-sm' onchange='re_statusapp(this);' statusapppr='$row->prno' deppr='$row->Dep_name' value='$row->rc_statusapp' >";
                                }
                              ?>
                            </td>
                            <td>
                                <?php if ($row->HdApprove == 'Y') {
                                  echo '<i class="fa fa-check fa-2x"  aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$HdApprove.'"></i>';
                                }elseif ($row->HdApprove == 'N'){
                                  echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                                }?>
                            </td>
                            <td>
                                <?php if ($row->PRApprove == 'Y') {
                                  echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$PRApprove.'"></i>';
                                }elseif ($row->PRApprove == 'N'){
                                  echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                                }?>
                            </td>
                            <td>
                                <?php if ($row->GMApprove == 'Y') {
                                  echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$GMApprove.'"></i>';
                                }elseif ($row->GMApprove == 'N'){
                                  echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                                }?>
                            </td>
                            <td>
                                <?php if ($row->EFCApprove == 'Y') {
                                  echo '<i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;" data-toggle="tooltip" data-placement="bottom" title="'.$EFCApprove.'"></i>';
                                }elseif ($row->EFCApprove == 'N'){
                                  echo '<i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i>';
                                }?>
                            </td>
                            <td align="center">
                                <?php
                                if ($username == 'Somkhit') {
                                    echo "<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ูข้อมูล'><i class='fa fa-fw fa-search'></i></button> ";
                                    echo "<button type='button' primary='$row->prno' class='btn btn-xs btn-warning' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไข PR'><i class='fa fa-fw fa-edit'></i></button> ";
                                }elseif ($username == 'Somkid') {
                                    echo "<button type='button' primary='$row->prno' class='btn btn-xs btn-warning' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไข PR'><i class='fa fa-fw fa-edit'></i></button> ";
                                }else {
                                    
                                }
                                ?>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </section>
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

    <!-- DataTables -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/responsive.bootstrap4.js'; ?>" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.dateFormat.js'; ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/Chart.js/Chart.js';?>"></script>
    <!-- Dashboard Modifiy -->
    <script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/dashdoard.js'; ?>"></script>
    <script src="<?php echo base_url().'/assets/js_modifly/modal_show_all.js'; ?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
    <script>
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
            setTimeout(function() { location.reload();}, 1500);
          }
        });
    }
    var re_statusapp = function re_statusapp(e) {
      var urlresult = JSON.parse(linkurl());
      var prid = $(e).attr('statusapppr');
      var deppr = $(e).attr('deppr');
      var statusappval = $(e).val();
        $.ajax({
          url: urlresult.restatusapp,
          type: 'POST',
          data: {prid: prid,statusappval: statusappval,deppr: deppr},
          success: function (callblack) {
            alertify.set('notifier','position', 'อัพเดตเสร็จสิ้น');
            alertify.success('แจ้งเตือน : ' + alertify.get('notifier','position'));
            setTimeout(function() { location.reload();}, 1500);
          }
        });
    }
    </script>
  </body>
</html>