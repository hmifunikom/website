<div class="navbar big navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('assets/images/logo.png')}}" />HMIF Unikom</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li {{ menu_active('event.index') }} ><a href="{{route('event.index')}}">Event</a></li>
                <li {{ menu_active('event.index') }}><a href="#">Keanggotaan</a></li>
                <li {{ menu_active('event.index') }}><a href="#">Perpustakaan</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</div>