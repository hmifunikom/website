@if(Session::has('success'))
    {{ Alert::success(Session::get('success')) }}
@endif
@if(Session::has('danger'))
    {{ Alert::danger(Session::get('danger')) }}
@endif
@if(Session::has('warning'))
    {{ Alert::warning(Session::get('warning')) }}
@endif
@if(Session::has('info'))
    {{ Alert::info(Session::get('info')) }}
@endif