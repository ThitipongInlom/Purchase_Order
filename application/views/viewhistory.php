<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/css/select2.min.css';?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/dist/css/AdminLTE.min.css'; ?>">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/iCheck/square/blue.css'; ?>">
        <!-- Alertify -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/alertify/css/alertify.min.css'; ?>" />
        <!-- Alertify theme -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/alertify/css/themes/semantic.min.css'; ?>" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <style type="text/css" media="screen">
    td {
      font-size: 13px;
    }        
    </style>
    <body class="hold-transition login-page">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h4>ประวัติรายการสินค้า</h4>
                <h4>[ <?php echo $titlehistory[0]->stname1; ?> ]</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-condensed">
                            <tr align="center">
                                <td width="15%">Date Last PR</td>
                                <td width="15%">PR No</td>
                                <td width="5%">Qty</td>
                                <td width="10%">Price</td>
                                <td width="45%">remark</td>
                                <td width="10%">File</td>
                            </tr>
                            <?php foreach ($datahistory as $key => $result) { ?>
                            <tr align="center">
                                <td><?php $Newdate = nice_date($result['usedate'], 'd-m-Y'); echo $Newdate; ?></td>
                                <td><a href="#"><p style="color: red;" dataprno="<?php echo $result['prno']; ?>" onclick="showwindowsmodalprview(this)"><?php echo $result['prno']; ?></p></a></td>
                                <td><?php echo $result['prqty']; ?></td>
                                <td><?php echo number_format($result['prprice'],2).'฿'; ?></td>
                                <td><?php echo $result['iremark']; ?></td>
                                <td><?php if ($result['ifileupd']!='') {
                                echo '<div align="center"><i class="fa fa-paperclip" id="iconimg" imgdata="'.$result['ifileupd'].'" onclick="openwindowimg(this)"></i></div>';
                                 } ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- jQuery 3 -->
    <script src="<?php echo base_url().'assets/adminlte/bower_components/jquery/dist/jquery.min.js'; ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url().'assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'; ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url().'assets/adminlte/plugins/iCheck/icheck.min.js'; ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/adminlte/dist/js/adminlte.min.js'; ?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>"></script>
    <!-- Add Pr Modifiy -->
    <script type="text/javascript" src="<?php echo base_url().'/assets/js_modifly/modelview.js'; ?>"></script>
</html>