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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url().'/assets/adminlte/bower_components/font-awesome/css/font-awesome.css'; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/dist/css/skins/_all-skins.min.css'; ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="hold-transition skin-purple sidebar-collapse sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>P</b>O</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Purchase</b> <b>Order</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" id="headmanu" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown notifications-menu">
                            <a href="#"><b>Garden Seaview</b></a>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="<?php echo site_url('index.php/Profile'); ?>">
                                <?php echo $this->session->fname; echo ' '; echo $this->session->lname; echo ' <b>['; echo $this->session->dep; echo']</b>'; ?>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-gears"></i>
                            </a>
                            <ul class="dropdown-menu" style="right: 0;">
                                <li
                                    class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Profile')
            {echo 'active';}?>">
                                    <a href="<?php echo site_url('index.php/Profile'); ?>">
                                        <button type="button" class="btn btn-primary  btn-block">โปรไฟล์</button>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="modal" data-target="#modal-default">
                                        <button type="button" class="btn btn-danger  btn-block">ออกจากระบบ</button>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><?php echo $this->lang->line('mainmenu');?></li>
                    <li
                        class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Dashboard/Dashboard')
            {echo 'active';}?>">
                        <a href="<?php echo site_url('index.php/Dashboard/Dashboard'); ?>">
                            <i class="fa fa-dashboard"></i><span><?php echo $this->lang->line('Dashboard'); ?></span>
                        </a>
                    </li>
                    <li
                        class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Add_Pr/')
            {echo 'active';}?>">
                        <a href="<?php echo site_url('index.php/Add_Pr/'); ?>">
                            <i class="fa fa-plus"></i><span><?php echo $this->lang->line('addpr'); ?></span>
                        </a>
                    </li>
                    <li
                        class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_all')
            {echo 'active';}?>">
                        <a href="<?php echo site_url('index.php/Show_data/show_all'); ?>">
                            <i class="fa fa-book"></i><span><?php echo $this->lang->line('showallorders'); ?></span>
                        </a>
                    </li>
                    <li
                        class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_approve')
            {echo 'active';}?>">
                        <a href="<?php echo site_url('index.php/Show_data/show_approve'); ?>">
                            <i
                                class="fa  fa-handshake-o"></i><span><?php echo $this->lang->line('approvedprocessing'); ?></span>
                        </a>
                    </li>
                    <?php
        $typedep = $this->session->dep;
        $typetype = $this->session->type;
        $typeusername = $this->session->username;
        $right_ac = $this->session->right_ac;
        $right_gm = $this->session->right_gm;
	      $right_efc = $this->session->right_efc;
        if ($typedep=='AC' AND $typetype=='accounting' OR $typedep=='AC' AND $typetype=='accounting0' OR $typedep=='EXC' AND $typeusername=='Somkhit' OR $right_ac=='Y' OR $right_gm=='Y' OR $right_efc=='Y') {
        echo'<li class="';
        if ($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/Show_accounting/') {
          echo 'active';
        }
        echo '">';
        echo '<a href="'.site_url('index.php/Show_data/Show_accounting?i=All').'"><i class="fa  fa-calculator"></i><span>'.$this->lang->line('account').'</span></a></li>';
        }
        ?>
                    <li
                        class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_completed')
            {echo 'active';}?>">
                        <a href="<?php echo site_url('index.php/Show_data/show_completed'); ?>">
                            <i class="fa  fa-check"></i><span><?php echo $this->lang->line('completed'); ?></span>
                        </a>
                    </li>
                    <li
                        class="<?php
            if($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_reject')
            {echo 'active';}?>">
                        <a href="<?php echo site_url('index.php/Show_data/show_reject'); ?>">
                            <i class="fa fa-times"></i><span><?php echo $this->lang->line('reject'); ?></span>
                        </a>
                    </li>
                    <?php
        $typedep = $this->session->dep;
        $typetype = $this->session->type;
        $typeusername = $this->session->username;
        $right_ac = $this->session->right_ac;
        $right_gm = $this->session->right_gm;
	      $right_efc = $this->session->right_efc;
        if ($typedep=='AC' AND $typetype=='accounting' OR $typedep=='AC' AND $typetype=='accounting0' OR $right_ac=='Y') {
        echo'<li class="';
        if ($this->input->server('REQUEST_URI') == '/PO/index.php/Dashboard/AddData/') {
          echo 'active';
        }
        echo '">';
        echo '<a href="'.site_url('index.php/Dashboard/AddData').'"><i class="fa  fa-cart-plus"></i><span>'.$this->lang->line('adddata').'</span></a></li>';
        }
        ?>
                    <?php
        if ($this->session->type =='admin' OR $this->session->dep =='IT') {
        echo '<li class="treeview';
        if ($this->input->server('REQUEST_URI') == '/PO/index.php/Show_data/show_allnew'
        OR  $this->input->server('REQUEST_URI') == '/PO/index.php/Usersetting/Settinguser') {
          echo 'active';
        }
        echo '">';
        echo '<a href="#">
              <i class="fa fa-cog"></i> <span>ระบบ</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
        <ul class="treeview-menu">';

        echo'<li class="';
        if ($this->input->server('REQUEST_URI') == '/PO/index.php/Usersetting/Settinguser') {
          echo 'active';
        }
        echo '">';
        echo '<a href="'.site_url('index.php/Usersetting/Settinguser').'"><i class="fa fa-dashboard"></i><span>'.$this->lang->line('settinguser').'</span></a></li>';

        echo '</ul>';
        }
        ?>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


        <!-- =============================================== -->
        <div class="modal fade" id="modal-default" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">ยืนยันการออกจากระบบ</h4>
                    </div>
                    <div class="modal-body">
                        <p>ออกจากระบบ PO </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left " data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-success " id="logout">ยืนยัน <i
                                class="fa fa-refresh fa-spin fa-fw" id="logouticon" style="margin-right: 2px;"></i>
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- jQuery 3 -->
        <script src="<?php echo base_url().'/assets/adminlte/bower_components/jquery/dist/jquery.min.js'; ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url().'/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'; ?>">
        </script>
        <!-- Slimscroll -->
        <script
            src="<?php echo base_url().'/assets/adminlte//bower_components/jquery-slimscroll/jquery.slimscroll.min.js'; ?>">
        </script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url().'assets/adminlte/dist/js/adminlte.min.js'; ?>"></script>
        <!-- Logout -->
        <script src="<?php echo base_url().'assets/js_modifly/logout.js'; ?>"></script>
        <!-- Cookie -->
        <script src="<?php echo base_url().'/assets/js_modifly/jquery_cookie.js'; ?>"></script>

</html>