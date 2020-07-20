<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$username = $this->session->username;
$type = $this->session->type;
$signature_img = $this->session->signature_img;
echo '<input type="hidden" id="usernameSwitch" value="'.$username.'">';
echo '<input type="hidden" id="usernameSession" value="'.$Switch.'">';
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive1.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/adminlte/bower_components/datatables.net-bs/css/responsive2.css'; ?>">
    <!-- switch_bootstrap3 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/switch_bootstrap3/bootstrap-switch.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'/assets/switch_bootstrap3/bootstrap-switch.min.css'; ?>">
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
                    <button type="button" class="btn btn-su btn-success" disabled><?php echo $this->lang->line('save'); ?></button></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php  
        if ($type == 'hod') {
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<div class="box box-info">';
        echo '<div class="box-header with-border">';
        echo '<h3 class="box-title">สถานะ ลายเซ็น</h3>';
        echo '<div class="box-tools pull-right">';
        echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>';
        echo '</div></div>';
        echo '<div class="box-body">';
        if ($signature_img=='') {
            echo '<div align="center"><span class="label label-danger">ติดต่อ IT 7367 เพื่อ อัพโหลด ลายเซ็น</span>  ';
        }else{
            echo '<div align="center"><span class="label label-success">มีลายเซ็น</span>  ';
            echo '<img src="../assets/signature/'.$signature_img.'" width="80"></div>';
        }   
        echo '</div></div></div></div>';          
        }
        ?>        
        <div class="row">
          <div class="col-md-12">
            <div class="box box-warning">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo $this->lang->line('changepassword'); ?></h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group" id="formoldpassword">
                      <label for="oldpassword" class="control-label"><?php echo $this->lang->line('oldpassword'); ?></label>
                      <input type="password" class="form-control" id="oldpassword" placeholder="<?php echo $this->lang->line('oldpassword'); ?>" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="formnewpassword1">
                      <label for="newpassword1" class="control-label"><?php echo $this->lang->line('newpassword'); ?></label>
                      <input type="password" class="form-control" id="newpassword1" placeholder="<?php echo $this->lang->line('newpassword'); ?>" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group" id="formnewpassword2">
                      <label for="newpassword2" class="control-label"><?php echo $this->lang->line('newpassword2'); ?></label>
                      <input type="password" class="form-control" id="newpassword2" placeholder="<?php echo $this->lang->line('newpassword2'); ?>">
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div align="center">
                      <div class="form-group">
                      <label for="btnpasswordsave" class="control-label"><?php echo $this->lang->line('confirm'); ?></label><br>
                      <button type="button" class="btn btn-su btn-success" id="btnpasswordsave" onclick="checkpassword();"><h8><?php echo $this->lang->line('changepassword'); ?></h8></button>
                      </div>
                    </div>
                  </div>                                                      
                </div>
              </div>
            </div>
          </div>
        </div>
        <div></div>
        <?php  
        if ($username == $Switch) {
        echo '<div class="row">';
        echo '<div class="col-md-12">';
        echo '<div class="box box-primary collapsed-box">';
        echo '<div class="box-header with-border">';
        echo '<h3 class="box-title">'.$this->lang->line('Settingpage').'</h3>';
        echo '<div class="box-tools pull-right">
              <button type="button" id="switchhide" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
              </div>';
        echo '</div>';
        echo '<div class="box-body">';
        echo '<div class="table-responsive"><table class="table">
              <tr align="center">
              <td><b>SQLAddpr Switch :</b></td>
              <td><input type="checkbox" name="SQLAddprSwitch" id="SQLAddprSwitch"></td>
              <td><b>Addprset Switch :</b></td>
              <td><input type="checkbox" name="AddprsetSwitch" id="AddprsetSwitch"></td>
              <td><b>Show_all Switch :</b></td>
              <td><input type="checkbox" name="Show_allSwitch" id="Show_allSwitch"></td>
              </tr>
              <tr align="center">
              <td><b>Show_allnew Switch :</b></td>
              <td><input type="checkbox" name="Show_allnewSwitch" id="Show_allnewSwitch"></td>
              <td><b>Show_approve Switch :</b></td>
              <td><input type="checkbox" name="Show_approveSwitch" id="Show_approveSwitch"></td>
              <td><b>Show_completed Switch :</b></td>
              <td><input type="checkbox" name="Show_completedSwitch" id="Show_completedSwitch"></td>
              </tr>
              <tr align="center">
              <td><b>Show_accounting Switch :</b></td>
              <td><input type="checkbox" name="Show_accountingSwitch" id="Show_accountingSwitch"></td>
              <td><b>Show_reject Switch :</b></td>
              <td><input type="checkbox" name="Show_rejectSwitch" id="Show_rejectSwitch"></td>
              <td><b>Settinguser Switch :</b></td>
              <td><input type="checkbox" name="SettinguserSwitch" id="SettinguserSwitch"></td>
              </tr>              
              </table></div>
             ';
        echo '</div>';
        echo '</div></div></div>';
        }
        ?>
      </section>
      <!-- /.content-wrapper -->
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
    <!-- Morris.js charts -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/raphael/raphael.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/morris.js/morris.min.js'; ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>
    <!-- switch_bootstrap3 -->
    <script src="<?php echo base_url().'/assets/switch_bootstrap3/bootstrap-switch.js';?>"></script>
    <script src="<?php echo base_url().'/assets/switch_bootstrap3/bootstrap-switch.min.js';?>"></script>
    <!-- Profile Pr Modifiy -->
    <script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/profile.js'; ?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>   
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