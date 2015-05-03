<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Cakrawala HMIF UNIKOM adalah salah satu acara terbesar yang pernah diadakan oleh Himpunan Mahasiswa Teknik Informatika Universitas Komputer Indonesia">
<meta name="keywords"  content="Cakrawala, HMIF UNIKOM, Himpunan Teknik Informatika Bandung, Unikom Bandung, Universitas Komputer Indonesia" />
<link rel="shortcut icon" href="{{ asset('favicon.ico?v1.0') }}">
@if(isset($pagetitle))
<title>{{ $pagetitle }} - Cakrawala - HMIF Unikom</title>
@else
<title>Cakrawala - HMIF Unikom</title>
@endif

@if(Auth::cakrawala()->check())
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
@endif

<!-- Bootstrap core CSS -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap.full.min.css') }}" rel="stylesheet">

@if(App::environment('production'))
<link href="//cdn.jsdelivr.net/bootstrap.datepicker/0.1/css/datepicker.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
@else
<link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet">
<link href="{{ asset('assets/fonts/font-awesome.min.css') }}" rel="stylesheet">
@endif

<link rel="stylesheet" href="{{ asset(Helper::version('assets/css/main.min.css')) }}" />
<link rel="stylesheet" href="{{ asset(Helper::version('assets/css/cakrawala.min.css')) }}" />
<link rel="stylesheet" href="{{ asset(Helper::version('assets/css/cakrawala-page.min.css')) }}" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv-printshiv.min.js"></script>
<script src="//cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
<![endif]-->