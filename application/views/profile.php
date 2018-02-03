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
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
    
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
        <?php echo $this->lang->line('profile'); ?>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('index.php/Profile'); ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $this->lang->line('profile'); ?></a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('formuser'); ?></h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="username" class="control-label"><?php echo $this->lang->line('username'); ?></label>
                      <input type="text" class="form-control" id="username" placeholder="<?php echo $this->lang->line('username'); ?>" value="<?php echo $result[0]->username; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="fname" class="control-label"><?php echo $this->lang->line('fname'); ?></label>
                      <input type="text" class="form-control" id="fname" placeholder="<?php echo $this->lang->line('fname'); ?>" value="<?php echo $result[0]->fname; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="lname" class="control-label"><?php echo $this->lang->line('lname'); ?></label>
                      <input type="text" class="form-control" id="lname" placeholder="<?php echo $this->lang->line('lname'); ?>" value="<?php echo $result[0]->lname; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="dep" class="control-label"><?php echo $this->lang->line('dep'); ?></label>
                      <input type="text" class="form-control" id="dep" placeholder="<?php echo $this->lang->line('dep'); ?>" value="<?php echo $result[0]->dep; ?>" disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="type" class="control-label"><?php echo $this->lang->line('type'); ?></label>
                      <input type="text" class="form-control" id="type" placeholder="<?php echo $this->lang->line('type'); ?>" value="<?php echo $result[0]->type; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="langselect" class="control-label"><?php echo $this->lang->line('lang'); ?></label>
                      <br>
                      <select id='langselect'>
                        <option value='english' data-image="<?php echo base_url().'assets/icon/en.png'; ?>" <?php if ($result[0]->lang == 'english') {
                        echo 'selected'; } ?>>English</option>
                        <option value='thai' data-image="<?php echo base_url().'assets/icon/th.png'; ?>"  <?php if ($result[0]->lang == 'thai') {
                        echo 'selected'; } ?>>Thai</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="email" class="control-label"><?php echo $this->lang->line('email'); ?></label>
                      <input type="text" class="form-control" id="email" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php echo $result[0]->email; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <br><div align="center">
                    <button type="button" class="btn btn-su btn-success">บันทึก</button></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>
    <script type="text/javascript">
    $("#langselect").select2({
    templateResult: addlangimg,
    templateSelection: addlangimg,
    width: '100%'
    });
    $('#langselect').on('select2:selecting', function(e) {
    $.ajax({
    url: '../index.php/Language/switchLanguser/'+e.params.args.data.id,
    type: 'POST',
    data: {data: e.params.args.data.id},
    success: function (e) {
    location.reload();
    }
    });
    });
    function addlangimg (opt) {
    if (!opt.id) {
    return opt.text;
    }
    var optimage = $(opt.element).data('image');
    if(!optimage){
    return opt.text;
    } else {
    var $opt = $(
    '<span class="langimg"><img src="' + optimage + '" class="userPic"  width="24" > ' + $(opt.element).text() + '</span>'
    );
    return $opt;
    }
    };
    </script>
  </body>
</html>