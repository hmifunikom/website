<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('cakrawala.index')}}">
                <span class="cakrawala-logo active"></span>
                Cakrawala
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::cakrawala()->check())
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::cakrawala()->user()->username }} {{Helper::fa('angle-down')}}<div class="clearfix"></div></a>
                    <ul class="dropdown-menu">
                        @if(Auth::cakrawala()->user()->userable instanceof HMIF\Model\Cakrawala\Tim)
                        <li {{ Helper::active('cakrawala.anggota.index') }}><a href="{{action('cakrawala.anggota.index')}}">{{Helper::fa(
                            'group')}} Form Anggota</a></li>
                        <li {{ Helper::active('cakrawala.persyaratan.index') }}><a href="{{action('cakrawala.persyaratan.index')}}">{{Helper::fa('files-o')}} Form Persyaratan</a></li>
                        <li {{ Helper::active('cakrawala.karya.index') }}><a href="{{action('cakrawala.karya.index')}}">{{Helper::fa('star')}} Form Karya</a></li>
                        <li class="divider"></li>
                        @endif
                        <li {{ Helper::active('cakrawala.pembayaran.edit') }}><a href="{{action('cakrawala.pembayaran.edit')}}">{{Helper::fa('money')}} Status Pembayaran</a></li>
                        <li class="divider"></li>
                        <li><a href="{{action('cakrawala.sessions.destroy')}}">{{Helper::fa('sign-out')}} Keluar</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</div>