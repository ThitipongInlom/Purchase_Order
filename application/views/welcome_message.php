<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Purchase | Order</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?php echo base_url().'assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css'; ?>">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url().'assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css'; ?>">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="<?php echo base_url().'assets/adminlte/bower_components/Ionicons/css/ionicons.min.css'; ?>">
    <!-- Select2 -->
    <link rel="stylesheet"
        href="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/css/select2.min.css';?>">
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
</head>

<body class="hold-transition login-page">
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <select id='langselect'>
                    <option value='english' data-image="<?php echo base_url().'assets/icon/en.png'; ?>"
                        <?php if ($this->session->site_lang == 'english') {
            echo 'selected'; } ?>>English
                    </option>
                    <option value='thai' data-image="<?php echo base_url().'assets/icon/th.png'; ?>"
                        <?php if ($this->session->site_lang == 'thai') {
            echo 'selected'; } ?>>Thai</option>
                </select>
            </div>
        </div>
    </div>
    <div class="login-box">
        <div class="login-logo">
            <img src="assets/icon/gardenhotel.gif" width="100">
            <h3><b>Garden Seaview</b></h3<br>
                <h3>Purchase Order</h3>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo $this->lang->line('Sign_in_To_start_your_session'); ?></p>
            <form name="formlogin" id="formlogin">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('username'); ?>"
                        id="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control"
                        placeholder="<?php echo $this->lang->line('password'); ?>" id="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="button" class="btn btn-primary btn-block "
                            id="login"><?php echo $this->lang->line('login'); ?>
                            <i class="fa fa-refresh fa-spin fa-fw" id="loginicon"
                                style="padding-right: 2px;"></i></button>
                    </div>
                    <!-- /.col -->
                </div>
                <form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url().'assets/adminlte/bower_components/jquery/dist/jquery.min.js'; ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url().'assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js'; ?>">
    </script>
    <!-- iCheck -->
    <script src="<?php echo base_url().'assets/adminlte/plugins/iCheck/icheck.min.js'; ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/adminlte/dist/js/adminlte.min.js'; ?>"></script>
    <!-- Alertify -->
    <script src="<?php echo base_url().'assets/alertify/alertify.min.js'; ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url().'/assets/adminlte/bower_components/select2/dist/js/select2.full.min.js';?>">
    </script>
    <!-- Login.js -->
    <script src="<?php echo base_url().'/assets/js_modifly/login.js';?>"></script>
    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    $("#langselect").select2({
        templateResult: addlangimg,
        templateSelection: addlangimg,
        width: '130'
    });
    $('#langselect').on('select2:selecting', function(e) {
        $.ajax({
            url: 'index.php/Language/switchLang/' + e.params.args.data.id,
            type: 'POST',
            data: {
                data: e.params.args.data.id
            },
            success: function(e) {
                location.reload();
            }
        });
    });

    function addlangimg(opt) {
        if (!opt.id) {
            return opt.text;
        }
        var optimage = $(opt.element).data('image');
        if (!optimage) {
            return opt.text;
        } else {
            var $opt = $(
                '<span class="langimg"><img src="' + optimage + '" class="userPic"  width="24" > ' + $(opt.element)
                .text() + '</span>'
            );
            return $opt;
        }
    };
    </script>
</body>

</html>