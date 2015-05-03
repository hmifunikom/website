<div class="navbar big navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('ifgames.index')}}"><img src="{{asset('assets/images/logo.png')}}" />IF Games</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li {{-- Helper::active('ifgames.index') --}} ><a href="{{action('ifgames.index')}}">Home</a></li>
                <li {{ Helper::active('ifgames.pendaftaran') }} ><a href="{{action('ifgames.pendaftaran')}}">Pendaftaran</a></li>
                @if(Auth::ifgames()->check())
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::ifgames()->user()->username }} {{Helper::fa('angle-down')}}<div class="clearfix"></div></a>
                    <ul class="dropdown-menu">
                        <li {{ Helper::active('ifgames.anggota.index') }}><a href="{{action('ifgames.anggota.index')}}">{{Helper::fa('clipboard')}} Form Anggota</a></li>
                        <li><a href="{{action('ifgames.sessions.destroy')}}">{{Helper::fa('sign-out')}} Keluar</a></li>
                    </ul>
                </li>
                @else
                <li {{ Helper::active('ifgames.sessions.create') }}><a href="{{action('ifgames.sessions.create')}}">Login</a>
                @endif
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</div>