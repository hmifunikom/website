@extends(((Request::ajax()) ? 'panel::layouts.ajax' : 'panel::layouts.master'))

@section('head')
    <link href="{{ asset_version('assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet" />
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
                        <div class="btn-group">
                            <a href="{{ route('panel.email.index') }}" data-pjax="true" class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <!-- end btn-toolbar -->
                </div>
                <!-- end wrapper -->
                <!-- begin wrapper -->
                <div class="wrapper">
                    <div class="p-30 bg-white">
                        <!-- begin email form -->
                        {!! Former::open()->route('panel.email.store')->data_pjax() !!}
                            <!-- begin email to -->
                            <label class="control-label">To:</label>
                            <div class="m-b-15">
                                <input type="text" name="email_to" class="form-control" value="{{ $message->subjectEmail or '' }}" />
                            </div>
                            <!-- end email to -->
                            <!-- begin email subject -->
                            <label class="control-label">Subject:</label>
                            <div class="m-b-15">
                                <input type="text" name="subject" class="form-control"  value="@if(isset($message->subject))Re: {{ $message->subject }}@endif" />
                            </div>
                            <!-- end email subject -->
                            <!-- begin email content -->
                            <label class="control-label">Content:</label>
                            <div class="m-b-15">
                                <textarea class="textarea form-control" name="html" id="wysihtml5" placeholder="Tulis pesan ..." rows="12"></textarea>
                            </div>
                            <!-- end email content -->
                            @if(Input::has('reply'))
                                <input type="hidden" name="reply" value="{{ Input::get('reply') }}">
                            @endif
                            <button type="submit" class="btn btn-primary p-l-40 p-r-40">Kirim</button>
                        {!! Former::close() !!}
                        <!-- end email form -->
                    </div>
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
        var handleEmailContent = function() {
            $('#wysihtml5').wysihtml5();
        };

        $(document).ready(function() {
            $.getScript('{{ asset_version('assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js') }}').done(function() {
                $.getScript('{{ asset_version('assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js') }}').done(function() {
                    handleEmailContent();
                });
            });
        });
    </script>
@endsection