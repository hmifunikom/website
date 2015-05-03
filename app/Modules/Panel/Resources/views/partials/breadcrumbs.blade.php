@if ($breadcrumbs)
    <ol class="breadcrumb pull-right">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$breadcrumb->last)
                <li><a href="{{{ $breadcrumb->url }}}" data-pjax>{{{ $breadcrumb->title }}}</a></li>
            @else
                <li class="active">{{{ $breadcrumb->title }}}</li>
            @endif
        @endforeach
    </ol>
@endif