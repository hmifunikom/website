<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{!! gravatar(auth()->user()->email) !!}" alt="" /></a>
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
            <li class="{{ menu_active('panel.event.index') }}">
                <a href="{{ route('panel.event.index') }}" data-toggle="ajax">
                    <i class="fa fa-calendar"></i>
                    <span>Event</span>
                </a>
            </li>
            <li class="{{ menu_active('panel.user.index') }}">
                <a href="{{ route('panel.user.index') }}" data-toggle="ajax">
                    <i class="fa fa-user"></i>
                    <span>User</span>
                </a>
            </li>

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