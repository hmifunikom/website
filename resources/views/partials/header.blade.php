<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
    <!-- begin container -->
    <div class="container">
        <!-- begin navbar-header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('index') }}" class="navbar-brand">
                <span class="brand-logo no-border">
                    <img src="{{ asset_version('assets/images/logo.png') }}" class="m-b-10" height="30px">
                </span>
                <span class="brand-text">
                    <span class="text-theme">HMIF</span> Unikom
                </span>
            </a>
        </div>
        <!-- end navbar-header -->
        <!-- begin navbar-collapse -->
        <div class="collapse navbar-collapse" id="header-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ menu_home('index') }}" ><a data-toggle="ajax" href="{{ route('index') }}">HOME</a></li>
                <li class="{{ menu_active('keanggotaan.index') }}" ><a data-toggle="ajax" href="{{ route('keanggotaan.index') }}">KEANGGOTAAN</a></li>
                <li><a href="{{ route('index') }}">EVENT</a></li>
                <li class="{{ menu_active('library.index') }}" ><a data-toggle="ajax" href="{{ route('library.index') }}">PERPUSTAKAAN</a></li>
                <li class="{{ menu_home('contact.index') }}" ><a data-toggle="ajax" href="{{ route('contact.index') }}">CONTACT</a></li>
            </ul>
        </div>
        <!-- end navbar-collapse -->
    </div>
    <!-- end container -->
</div>