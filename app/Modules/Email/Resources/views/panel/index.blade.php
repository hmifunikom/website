@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')

@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content content-full-width">
        <!-- begin vertical-box -->
        <div class="vertical-box">
            <!-- begin vertical-box-column -->
            <div class="vertical-box-column width-250">
                <!-- begin wrapper -->
                <div class="wrapper bg-silver text-center">
                    <a href="{{ route('panel.email.create') }}" data-pjax="true" class="btn btn-success p-l-40 p-r-40 btn-sm">
                        Tulis pesan
                    </a>
                </div>
                <!-- end wrapper -->
                <!-- begin wrapper -->
                <div class="wrapper">
                    <p><b>FOLDERS</b></p>
                    <ul class="nav nav-pills nav-stacked nav-sm">
                        <li class="{{ menu_active_qs('type', 'in') }}"><a href="{{ route('panel.email.index', ['type' => 'in']) }}" data-pjax="true"><i class="fa fa-inbox fa-fw m-r-5"></i> Kotak masuk</a></li>
                        <li class="{{ menu_active_qs('type', 'out') }}"><a href="{{ route('panel.email.index', ['type' => 'out']) }}" data-pjax="true"><i class="fa fa-send fa-fw m-r-5"></i> Kotak keluar</a></li>
                    </ul>
                </div>
                <!-- end wrapper -->
            </div>
            <!-- end vertical-box-column -->
            <!-- begin vertical-box-column -->
            <div class="vertical-box-column">
                <!-- begin wrapper -->
                <div class="wrapper bg-silver-lighter">
                    <!-- begin btn-toolbar -->
                    <div class="btn-toolbar">
                        <!-- begin btn-group -->
                        @if($emails->hasPages())
                        <?php $emails->appends(Input::all()); ?>
                        <div class="btn-group pull-right">
                            @if($emails->currentPage() <= 1)
                                <a class="btn btn-white btn-sm disabled">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            @else
                                <a class="btn btn-white btn-sm" href="{{ $emails->url($emails->currentPage() - 1) }}" data-pjax="true">
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                            @endif

                            @if(! $emails->hasMorePages())
                                <a class="btn btn-white btn-sm disabled">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            @else
                                <a class="btn btn-white btn-sm" href="{{ $emails->url($emails->currentPage() + 1) }}" data-pjax="true">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            @endif
                        </div>
                        @endif
                        <!-- end btn-group -->
                        <!-- begin btn-group -->
                        @if(Input::get('type') != 'out')
                        <div class="btn-group dropdown">
                            <button class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                                @if(! Input::has('unreaded')) Semua @else Belum dibaca @endif <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu text-left text-sm">
                                <li class="@if(! Input::has('unreaded')) active @endif"><a href="{{ route('panel.email.index', ['type' => 'in']) }}" data-pjax="true">Semua</a></li>
                                <li class="@if(Input::get('unreaded') == '1') active @endif"><a href="{{ route('panel.email.index', ['type' => 'in', 'unreaded' => 1]) }}" data-pjax="true">Belum dibaca</a></li>
                            </ul>
                        </div>
                        @endif
                        <!-- end btn-group -->
                        <!-- begin btn-group -->
                        <div class="btn-group">
                            <a class="btn btn-sm btn-white" href="{{ $emails->url($emails->currentPage()) }}" data-pjax="true" data-toggle="tooltip" data-placement="top" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></a>
                        </div>
                        <!-- end btn-group -->
                        <!-- begin btn-group -->
                        <div class="btn-group">
                            {!! Former::open()->route('panel.email.action.destroy')->data_pjax()->data_pjax_success('handleDelete')->data_confirm('Hapus pesan yang dipilih?') !!}
                            <input type="hidden" name="ids" class="ids">
                            <input type="hidden" name="type" value="{{ Input::get('type') }}">
                            <button type="submit" class="btn btn-sm btn-white hide" data-email-action="delete"><i class="fa fa-trash m-r-3"></i> <span class="hidden-xs">Hapus</span></button>
                            {!! Former::close() !!}
                        </div>
                        <!-- end btn-group -->
                    </div>
                    <!-- end btn-toolbar -->
                </div>
                <!-- end wrapper -->
                <!-- begin list-email -->
                <ul class="list-group list-group-lg no-radius list-email">
                    @foreach($emails as $email)
                        <li class="list-group-item {{ $email->sign }}">
                            <div class="email-checkbox">
                                <label>
                                    <i class="fa fa-square-o"></i>
                                    <input type="checkbox" data-checked="email-checkbox" value="{{ $email->id_email }}" />
                                </label>
                            </div>
                            <a href="{{ route('panel.email.show', [$email->getWrappedObject()]) }}" class="email-user" data-pjax="true">
                                <img src="{{ gravatarlib($email->subjectEmail) }}" alt="{{ $email->subjectName }}" />
                            </a>
                            <div class="email-info">
                                <span class="email-time">{{ $email->dateDiff }}</span>
                                <h5 class="email-title">
                                    <a href="{{ route('panel.email.show', [$email->getWrappedObject()]) }}" data-pjax="true">{{ $email->subjectName }} - {{ $email->subject }}</a>
                                </h5>
                                <p class="email-desc">
                                    {{ $email->shortText }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- end list-email -->
                <!-- begin wrapper -->
                <div class="wrapper bg-silver-lighter clearfix">
                    @if($emails->hasPages())
                    <div class="btn-group pull-right">
                        @if($emails->currentPage() <= 1)
                        <a class="btn btn-white btn-sm disabled">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        @else
                        <a class="btn btn-white btn-sm" href="{{ $emails->url($emails->currentPage() - 1) }}" data-pjax="true">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        @endif

                        @if(! $emails->hasMorePages())
                            <a class="btn btn-white btn-sm disabled">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        @else
                            <a class="btn btn-white btn-sm" href="{{ $emails->url($emails->currentPage() + 1) }}" data-pjax="true">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        @endif
                    </div>
                    @endif
                    <div class="m-t-5">{{ $emails->total() }} pesan</div>
                </div>
                <!-- end wrapper -->
            </div>
            <!-- end vertical-box-column -->
        </div>
        <!-- end vertical-box -->
    </div>
    <!-- end #content -->
@stop

@section('javascript')
    <script>
        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        var handleEmailActionButtonStatus = function() {
            if ($('[data-checked=email-checkbox]:checked').length !== 0) {
                $('[data-email-action]').removeClass('hide');
            } else {
                $('[data-email-action]').addClass('hide');
            }
        };

        var selectedId = [];
        var handleEmailCheckboxChecked = function() {
            $('[data-checked=email-checkbox]').live('click', function() {
                var targetLabel = $(this).closest('label');
                var targetEmailList = $(this).closest('li');
                var id = $(this).val();
                if ($(this).prop('checked')) {
                    $(targetLabel).addClass('active');
                    $(targetEmailList).addClass('selected');
                    selectedId.push(id);
                } else {
                    $(targetLabel).removeClass('active');
                    $(targetEmailList).removeClass('selected');
                    removeA(selectedId, id);
                }
                handleEmailActionButtonStatus();

                $('input.ids').val(selectedId.join());
            });
        };

        var handleDelete = function(data, status, xhr) {
            var targetEmailList = '[data-checked=email-checkbox]:checked';
            if ($(targetEmailList).length !== 0) {
                $(targetEmailList).closest('li').slideToggle(function() {
                    $(this).remove();
                    selectedId = [];
                    handleEmailActionButtonStatus();
                });
            }
        };

        $(document).ready(function() {
            handleEmailCheckboxChecked();
        });
    </script>
@endsection