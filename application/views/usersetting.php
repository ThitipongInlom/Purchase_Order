<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

if (empty($this->session->username)) {
  redirect('', 'refresh');
}
if ($this->session->lang == 'english') {
  $this->lang->load('message','english');
}else{
  $this->lang->load('message','thai');
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- Alertify -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/alertify/css/alertify.min.css'; ?>" />
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
        <?php echo $this->lang->line('settinguser'); ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('index.php/Usersetting/Settinguser'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('settinguser'); ?></a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12">
          <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
            <div class="table-responsive">  
              <table id="tableusersetting" cellspacing="0" width="100%" class="table table-bordered table-striped table-hover responsive table-condensed table-stripedstyle">
              <thead>  
                <tr align="center">
                  <th>Username</th>
                  <th>Fname</th>
                  <th>Lname</th>
                  <th>Type</th>
                  <th>Email</th>
                  <th>Department</th>
                  <th>Lang</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user as $row) {

                ?>
                <tr align="center">
                  <td><?php echo  $row->username; ?></td>
                  <td><?php echo  $row->fname; ?></td>
                  <td><?php echo  $row->lname; ?></td>
                  <td><?php echo  $row->type; ?></td>
                  <td><?php echo  $row->email; ?></td>
                  <td><?php echo  $row->dep; ?></td>
                  <td><?php echo  $row->lang; ?></td>
                  <td>
                    <button class="btn btn-sm btn-warning" primary="<?php echo  $row->username; ?>" onclick="editdata(this);">แก้ไข</button>
                    <input type="hidden" id="showeditdatauser" data-toggle="modal" data-target="#editdatauser">
                    <button class="btn btn-sm btn-danger" disabled>ลบ</button>
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
      </section>

      <!-- Modal -->
      <div id="editdatauser" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">แก้ไขข้อมูล</h4>
            </div>
            <div class="modal-body" id="showcallblackedit">
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
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>    
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/fastclick/lib/fastclick.js'; ?>"></script>
    <!-- charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/Chart.js/Chart.js';?>"></script>
    <!-- Js Usersetting -->
    <script src="<?php echo base_url().'/assets/js_modifly/uersetting.js'; ?>"></script>
  </body>
</html>