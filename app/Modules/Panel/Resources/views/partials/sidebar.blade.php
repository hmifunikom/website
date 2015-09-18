<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{!! avatar(auth()->user()->userable->avatar) !!}" alt="" /></a>
                </div>
                <div class="info">
                    <div style="width: 130px" class="text-ellipsis">{{ auth()->user()->userable->nama }}</div>
                    <small>{{ auth()->user()->userable->divisi->singkatan }}</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigasi</li>
            <li class="{{ menu_active('panel.index') }}">
                <a href="{{ route('panel.index') }}" data-toggle="ajax">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="has-sub {{ menu_active('panel.keanggotaan.index') }}">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-group"></i>
                    <span>Keanggotaan</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ menu_active('panel.keanggotaan.anggota.index') }}"><a href="{{ route('panel.keanggotaan.anggota.index') }}" data-toggle="ajax">Anggota</a></li>
                    <li class="{{ menu_active('panel.keanggotaan.divisi.index') }}"><a href="{{ route('panel.keanggotaan.divisi.index') }}" data-toggle="ajax">Divisi</a></li>
                </ul>
            </li>
            <li class="{{ menu_active('panel.event.index') }}">
                <a href="{{ route('panel.event.index') }}" data-toggle="ajax">
                    <i class="fa fa-calendar"></i>
                    <span>Event</span>
                </a>
            </li>
            <li class="{{ menu_active('panel.library.index') }}">
                <a href="{{ route('panel.library.index') }}" data-toggle="ajax">
                    <i class="fa fa-book"></i>
                    <span>Perpustakaan</span>
                </a>
            </li>
            @if(Authority::can('read', HMIF\Modules\Email\Entities\Email::class))
            <li class="{{ menu_active('panel.email.index') }}">
                <a href="{{ route('panel.email.index') }}" data-toggle="ajax">
                    <i class="fa fa-envelope"></i>
                    <span>Email</span>
                </a>
            </li>
            @endif
            @if(Authority::can('read', HMIF\Modules\Invoice\Entities\Invoice::class))
            <li class="{{ menu_active('panel.invoice.index') }}">
                <a href="{{ route('panel.invoice.index') }}" data-toggle="ajax">
                    <i class="fa fa-file-text-o"></i>
                    <span>Invoice</span>
                </a>
            </li>
            @endif
            @if(Authority::can('read', HMIF\Modules\User\Entities\User::class))
            <li class="{{ menu_active('panel.user.index') }}">
                <a href="{{ route('panel.user.index') }}" data-toggle="ajax">
                    <i class="fa fa-user"></i>
                    <span>User</span>
                </a>
            </li>
            @endif
            @if(Authority::can('manage', 'Setting'))
            <li class="{{ menu_active('panel.setting.edit') }}">
                <a href="{{ route('panel.setting.edit') }}" data-toggle="ajax">
                    <i class="fa fa-gear"></i>
                    <span>Setting</span>
                </a>
            </li>
            @endif

            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->