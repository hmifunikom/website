<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
            <a href="{{ route('panel.index') }}" class="navbar-brand">
                <span class="navbar-logo no-border">
                    <img src="{{ asset_version('assets/images/logo-sm.png') }}" class="m-b-10">
                </span> HMIF Unikom
            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{!! avatar(auth()->user()->userable->avatar) !!}" alt="" />
                    <span class="hidden-xs">{{ auth()->user()->email }}</span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="javascript:;">Edit Profil</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('auth/logout') }}">Keluar</a></li>
                </ul>
            </li>
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>
<!-- end #header -->