<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Oops... Maintenance | HMIF Unikom</title>
    <meta name="description" content="HMIF Unikom Official Website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="robots" content="none">
    <meta name="twitter:title" content="Oops... Maintenance | HMIF Unikom">
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
    <meta property="og:title" content="Oops... Maintenance | HMIF Unikom">
    <meta property="og:description" content="HMIF Unikom Official Website">
    <link rel="shortcut icon" href="<?php echo asset_version('favicon.ico'); ?>">
    <link rel="icon" href="<?php echo asset_version('favicon.ico'); ?>" type="image/x-icon">

    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?php echo asset_link('css.jquery-ui'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_link('css.bootstrap'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_link('css.fontawesome'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_link('css.jquery-gritter'); ?>" rel="stylesheet" />
    <link href="<?php echo asset_link('css.animate'); ?>" rel="stylesheet" />
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
    <script src="<?php echo asset_link('pace'); ?>"></script>
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
            <div class="error-code m-b-10">503 <i class="fa fa-warning"></i></div>
            <div class="error-content">
                <div class="error-message">Maintenance...</div>
                <div class="error-desc m-b-20">
                    Oops.. Sedang melakukan perawatan. <br/>
                    Silahkan kembali beberapa saat lagi.
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
    <script src="<?php echo asset_link('js.jquery'); ?>"></script>
    <script src="<?php echo asset_link('js.jquery-migrate'); ?>"></script>
    <script src="<?php echo asset_link('js.jquery-ui'); ?>"></script>
    <script src="<?php echo asset_link('js.bootstrap'); ?>"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo asset_link('js.html5shiv'); ?>"></script>
    <script src="<?php echo asset_link('js.respond'); ?>"></script>
    <script src="<?php echo asset_link('js.excanvas'); ?>"></script>
    <![endif]-->
    <script src="<?php echo asset_link('js.jquery-pjax'); ?>"></script>
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