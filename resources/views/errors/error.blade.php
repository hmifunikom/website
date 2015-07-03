<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Oops... Terjadi kesalahan | HMIF Unikom</title>
    <meta name="description" content="HMIF Unikom Official Website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="none">
    <meta name="twitter:title" content="Oops... Terjadi kesalahan | HMIF Unikom">
    <meta name="twitter:description" content="HMIF Unikom Official Website">
    <meta name="twitter:site" content="@hmifunikom">
    <meta name="twitter:creator" content="@hmifunikom">
    <meta name="twitter:url" content="<?php echo URL::current(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta property="fb:page_id" content="433175063394714">
    <meta property="fb:app_id" content="1576946569237047">
    <meta property="fb:admins" content="1338503834">
    <meta property="og:url" content="<?php echo URL::current(); ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="HMIF Unikom">
    <meta property="og:title" content="Oops... Terjadi kesalahan | HMIF Unikom">
    <meta property="og:description" content="HMIF Unikom Official Website">
    <link rel="shortcut icon" href="<?php echo asset_version('favicon.ico'); ?>">
    <link rel="icon" href="<?php echo asset_version('favicon.ico'); ?>" type="image/x-icon">

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/plugins/gritter/css/jquery.gritter.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/css/animate.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/admin/css/style.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/admin/css/style-responsive.min.css'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_version('assets/admin/css/theme/blue.css'); ?>" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script>
        paceOptions = {
            ajax: {
                trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
            },
            restartOnRequestAfter:35, // Detect post request
            restartOnPushState: false
        }
    </script>
    <script src="<?php echo asset_version('assets/plugins/pace/pace.min.js'); ?>"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin error -->
        <div class="error">
            <div class="error-code m-b-10"><?php echo $code; ?> <i class="fa fa-warning"></i></div>
            <div class="error-content">
                <div class="error-message">Oops...</div>
                <div class="error-desc m-b-20">
                    Sepertinya terjadi kesalahan. <br />
                    Silahkan coba kembali beberapa saat lagi.
                </div>
                <div>
                    <a href="/" class="btn btn-success">Kembali ke Home</a>
                </div>
            </div>
        </div>
        <!-- end error -->

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?php echo asset_version('assets/plugins/jquery/jquery-1.9.1.min.js'); ?>"></script>
    <script src="<?php echo asset_version('assets/plugins/jquery/jquery-migrate-1.1.0.min.js'); ?>"></script>
    <script src="<?php echo asset_version('assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo asset_version('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo asset_version('assets/crossbrowserjs/html5shiv.js'); ?>"></script>
    <script src="<?php echo asset_version('assets/crossbrowserjs/respond.min.js'); ?>"></script>
    <script src="<?php echo asset_version('assets/crossbrowserjs/excanvas.min.js'); ?>"></script>
    <![endif]-->
    <script src="<?php echo asset_version('assets/plugins/jquery-pjax/jquery.pjax.js'); ?>"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?php echo asset_version('assets/admin/js/apps.min.js'); ?>"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>
</html>