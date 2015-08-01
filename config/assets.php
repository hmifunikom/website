<?php

return [

    'default' => 'cdn',

    'files'   => [

        'css' => [
            'bootstrap'            => [
                'local' => 'assets/plugins/bootstrap/css/bootstrap.min.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.min.css'
            ],

            'fontawesome'          => [
                'local' => 'assets/plugins/font-awesome/css/font-awesome.min.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css'
            ],

            'animate'              => [
                'local' => 'assets/css/animate.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.3.0/animate.min.css'
            ],

            'jquery-ui'            => [
                'local' => 'assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/css/jquery-ui.min.css'
            ],

            'jquery-gritter'       => [
                'local' => 'assets/plugins/gritter/css/jquery.gritter.css',
                'cdn'   => 'https://oss.maxcdn.com/jquery.gritter/1.7.4/css/jquery.gritter.css'
            ],

            'bootstrap-wysihtml5'  => [
                'local' => 'assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css',
                'cdn'   => 'https://oss.maxcdn.com/bootstrap.wysihtml5/0.0.2/bootstrap-wysihtml5-0.0.2.css'
            ],

            'datepicker'           => [
                'local' => 'assets/plugins/bootstrap-datepicker/css/datepicker.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.min.css'
            ],

            'datepicker3'          => [
                'local' => 'assets/plugins/bootstrap-datepicker/css/datepicker3.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker3.min.css'
            ],

            'bootstrap-timepicker' => [
                'local' => 'assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                'cdn'   => 'https://oss.maxcdn.com/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css'
            ],

            'bwizard'              => [
                'local' => 'assets/plugins/bootstrap-wizard/css/bwizard.min.css',
            ],

            'bootstrap-markdown'   => [
                'local' => 'assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.9.0/css/bootstrap-markdown.min.css'
            ],

            'jquery-fileupload'    => [
                'local' => 'assets/plugins/jquery-file-upload/css/jquery.fileupload.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.7/css/jquery.fileupload.min.css'
            ],

            'jquery-jvectormap'    => [
                'local' => 'assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css'
            ],

            'bootstrap-calendar'   => [
                'local' => 'assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css',
            ],

            'morris'               => [
                'local' => 'assets/plugins/morris/morris.css',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.css'
            ],

            'password-indicator'   => [
                'local' => 'assets/plugins/password-indicator/css/password-indicator.css',
            ],
        ],

        'js'  => [

            'pace'                       => [
                'local' => 'assets/plugins/pace/pace.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/pace/0.5.6/pace.min.js'
            ],

            'jquery'                     => [
                'local' => 'assets/plugins/jquery/jquery-1.9.1.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js'
            ],

            'jquery-migrate'             => [
                'local' => 'assets/plugins/jquery/jquery-migrate-1.1.0.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.1.0/jquery-migrate.min.js'
            ],

            'bootstrap'                  => [
                'local' => 'assets/plugins/bootstrap/js/bootstrap.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js'
            ],

            'html5shiv'                  => [
                'local' => 'assets/crossbrowserjs/html5shiv.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2pre/html5shiv.min.js'
            ],

            'respond'                    => [
                'local' => 'assets/crossbrowserjs/respond.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js'
            ],

            'excanvas'                   => [
                'local' => 'assets/crossbrowserjs/excanvas.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/excanvas.min.js'
            ],

            'jquery-cookie'              => [
                'local' => 'assets/plugins/jquery-cookie/jquery.cookie.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'
            ],

            'scroll-monitor'             => [
                'local' => 'assets/plugins/scrollMonitor/scrollMonitor.js',
            ],

            'jquery-pjax'                => [
                'local' => 'assets/plugins/jquery-pjax/jquery.pjax.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js'
            ],

            'jquery-ui'                  => [
                'local' => 'assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js'
            ],

            'jquery-gritter'             => [
                'local' => 'assets/plugins/gritter/js/jquery.gritter.js',
                'cdn'   => 'https://oss.maxcdn.com/jquery.gritter/1.7.4/js/jquery.gritter.min.js'
            ],

            'jquery-bc-swipe'            => [
                'local' => 'assets/plugins/jquery-bcSwipe/jquery.bcSwipe.min.js',
            ],

            'trianglify'                 => [
                'local' => 'assets/plugins/trianglify/trianglify.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/trianglify/0.3.1/trianglify.min.js'
            ],

            'wysihtml5'                  => [
                'local' => 'assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/wysihtml5/0.3.0/wysihtml5.min.js'
            ],

            'bootstrap-wysihtml5'        => [
                'local' => 'assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js',
                'cdn'   => 'https://oss.maxcdn.com/bootstrap.wysihtml5/0.0.2/bootstrap-wysihtml5-0.0.2.min.js'
            ],

            'color-thief'                => [
                'local' => 'assets/plugins/color-thief/color-thief.min.js',
            ],

            'jquery-countdown'           => [
                'local' => 'assets/plugins/jquery-countdown/jquery.countdown.min.js',
                'cdn'   => 'https://oss.maxcdn.com/jquery.countdown/2.0.5/jquery.countdown.min.js'
            ],

            'bootbox'                    => [
                'local' => 'assets/plugins/bootstrap-bootbox/bootbox.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js'
            ],

            'jquery-form'                => [
                'local' => 'assets/plugins/form/jquery.form.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js'
            ],

            'bootstrap-datepicker'       => [
                'local' => 'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            ],

            'bootstrap-timepicker'       => [
                'local' => 'assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
                'cdn'   => 'https://oss.maxcdn.com/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js'
            ],

            'bwizard'                    => [
                'local' => 'assets/plugins/bootstrap-wizard/js/bwizard.js',
            ],

            'bootstrap-markdown'         => [
                'local' => 'assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.9.0/js/bootstrap-markdown.min.js'
            ],

            'marked'                     => [
                'local' => 'assets/plugins/marked/marked.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.2/marked.min.js'
            ],

            'jquery-fileupload-tmpl'     => [
                'local' => 'assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js',
            ],

            'jquery-fileupload-iframe'   => [
                'local' => 'assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.7/jquery.iframe-transport.min.js'
            ],

            'jquery-fileupload'          => [
                'local' => 'assets/plugins/jquery-file-upload/js/jquery.fileupload.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.7/jquery.fileupload.min.js'
            ],

            'jquery-fileupload-process'  => [
                'local' => 'assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.7/jquery.fileupload-process.min.js'
            ],

            'jquery-fileupload-validate' => [
                'local' => 'assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.7/jquery.fileupload-validate.min.js'
            ],

            'jquery-fileupload-xdr'      => [
                'local' => 'assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.7/cors/jquery.xdr-transport.min.js'
            ],

            'jquery-sticky'              => [
                'local' => 'assets/plugins/jquery-sticky/jquery.sticky.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.1/jquery.sticky.min.js'
            ],

            'jquery-hashchange'          => [
                'local' => 'assets/plugins/jquery-hashchange/jquery.hashchange.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jquery-hashchange/v1.3/jquery.ba-hashchange.min.js'
            ],

            'jquery-slimscroll'          => [
                'local' => 'assets/plugins/slimscroll/jquery.slimscroll.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.2.0/jquery.slimscroll.min.js'
            ],

            'morris-raphael'             => [
                'local' => 'assets/plugins/morris/raphael.min.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js'
            ],

            'morris'                     => [
                'local' => 'assets/plugins/morris/morris.js',
                'cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js'
            ],

            'password-indicator'         => [
                'local' => 'assets/plugins/password-indicator/js/password-indicator.js',
            ],
        ]
    ]
];