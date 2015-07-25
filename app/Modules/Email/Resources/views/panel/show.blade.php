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
                        <li class="@if($email->type == 'in') active @endif"><a href="{{ route('panel.email.index', ['type' => 'in']) }}" data-pjax="true"><i class="fa fa-inbox fa-fw m-r-5"></i> Kotak masuk</a></li>
                        <li class="@if($email->type == 'out') active @endif"><a href="{{ route('panel.email.index', ['type' => 'out']) }}" data-pjax="true"><i class="fa fa-send fa-fw m-r-5"></i> Kotak keluar</a></li>
                    </ul>
                </div>
                <!-- end wrapper -->
            </div>
            <!-- end vertical-box-column -->
            <!-- begin vertical-box-column -->
            <div class="vertical-box-column bg-white">
                <!-- begin wrapper -->
                <div class="wrapper bg-silver-lighter clearfix">
                    <div class="btn-group m-r-5">
                        <a href="{{ route('panel.email.create', ['reply' => $email->getRouteKey()]) }}" data-pjax="true" class="btn btn-white btn-sm"><i class="fa fa-reply"></i> Balas pesan</a>
                    </div>
                    <div class="btn-group m-r-5">
                        {!! Former::open()->route('panel.email.destroy', $email->getWrappedObject())->data_pjax()->data_confirm('Hapus pesan ini?') !!}
                        <button type="submit" class="btn btn-white btn-sm p-l-20 p-r-20"><i class="fa fa-trash"></i></button>
                        {!! Former::close() !!}
                    </div>
                    <div class="pull-right">
                        <div class="btn-group m-l-5">
                            <a href="{{ route('panel.email.index') }}" data-pjax="true" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end wrapper -->
                <!-- begin wrapper -->
                <div class="wrapper">
                    <h4 class="m-b-15 m-t-0 p-b-10 underline">{{ $email->subject }}</h4>
                    <ul class="media-list underline m-b-20 p-b-15">
                        <li class="media media-sm clearfix">
                            <a href="javascript:;" class="pull-left">
                                <img class="media-object rounded-corner" alt="{{ $email->subjectName }}" src="{{ gravatarlib($email->subjectEmail) }}" />
                            </a>
                            <div class="media-body">
                                    <span class="email-from text-inverse f-w-600">
                                        from {{ $email->email_from }}

                                    </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> {{ $email->dateFull }}</span><br />
                                    <span class="email-to">
                                        To: {{ $email->email_to }}
                                    </span>
                            </div>
                        </li>
                    </ul>

                    <div id="mail-container">
                        <?php
                            $content = new HMIF\Libraries\EmailDisplayer();
                            $content->setHtml($email->html);
                            echo $content->parse();
                        ?>
                    </div>

                    @if($email->attachment->count() > 0)
                    <hr>

                    <ul class="attached-document clearfix">
                        @foreach($email->attachment as $attachment)
                        <li>
                            <div class="document-name"><a href="{{ route('panel.email.attachment.download', [$email->getWrappedObject(), $attachment->getWrappedObject()]) }}">{{ $attachment->filename }}</a></div>
                            <div class="document-file">
                                <a href="{{ route('panel.email.attachment.download', [$email->getWrappedObject(), $attachment->getWrappedObject()]) }}">
                                    {!! $attachment->icon !!}
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <!-- end wrapper -->
                <!-- begin wrapper -->
                <div class="wrapper bg-silver-lighter text-right clearfix">
                    <div class="btn-group m-l-5">
                        <a href="{{ route('panel.email.index') }}" data-pjax="true" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
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
        $(document).ready(function() {
        });
    </script>
@endsection