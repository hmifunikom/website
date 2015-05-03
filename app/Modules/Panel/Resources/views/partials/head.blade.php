<meta charset="utf-8" />
<title id="page-title">Color Admin | Dashboard</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="_token" content="{{ csrf_token() }}" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="{{ asset_version('assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/css/animate.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/css/style.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/css/style-responsive.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/css/theme/blue.css') }}" rel="stylesheet" id="theme" />
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
<script src="{{ asset_version('assets/plugins/pace/pace.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->