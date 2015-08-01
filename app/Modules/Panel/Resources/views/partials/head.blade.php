<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="{{ asset_link('css.jquery-ui') }}" rel="stylesheet" />
<link href="{{ asset_link('css.bootstrap') }}" rel="stylesheet" />
<link href="{{ asset_link('css.fontawesome') }}" rel="stylesheet" />
<link href="{{ asset_link('css.jquery-gritter') }}" rel="stylesheet" />
<link href="{{ asset_link('css.animate') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/admin/css/style.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/admin/css/style-responsive.min.css') }}" rel="stylesheet" />
<link href="{{ asset_version('assets/admin/css/theme/blue.css') }}" rel="stylesheet" id="theme" />
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
<script src="{{ asset_link('js.pace') }}"></script>
<!-- ================== END BASE JS ================== -->