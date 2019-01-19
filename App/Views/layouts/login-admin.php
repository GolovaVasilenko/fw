
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Astore | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/assets/admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/admin/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/admin/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <b>AStore</b> Admin panel</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">

        <p class="login-box-msg">Sign in to start your session</p>
        <div class="arrea-errors">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($errors)):?>
                        <div class="alert alert-danger">
                            <?=$errors; ?>
                        </div>
                    <?php endif;?>
                    <?php if(isset($success)):?>
                        <div class="alert alert-success">
                            <?=$success; ?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>

        <?=$content;?>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="/assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/assets/admin/plugins/iCheck/icheck.min.js"></script>
<script src="/assets/admin/js/custom.js"></script>
</body>
</html>
