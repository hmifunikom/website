@extends(((Request::ajax()) ? 'layouts.ajax' : 'layouts.master'))

@section('head')
    <style>
        #hero .content-bg #google-map-default {
            height: 100%;
            width: 100%;
        }

        #hero .container h1 {
            width: 270px;
            margin-left: 50%;
            position: absolute;
            left: -135px;
        }

        #hero .container h3 {
            width: 270px;
            margin-left: 50%;
            position: absolute;
            left: -135px;
            margin-top: 90px;
        }

    </style>
@stop

@section('content')
    <!-- begin #hero -->
    <div id="hero" class="content has-bg hero">
        <!-- begin content-bg -->
        <div class="content-bg">
            <div id="google-map-default"></div>
        </div>
        <!-- end content-bg -->
        <!-- begin container -->
        <div class="container home-content text-center">
            <h1>Contact</h1>
            <h3><span class="fa fa-angle-double-down"></span></h3>
        </div>
        <!-- end container -->
    </div>
    <!-- end #hero -->

    <!-- begin #book -->
    <div id="contact" class="content" data-scrollview="true">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row">
                <!-- begin col-4 -->
                <div class="col-md-6 col-sm-6" data-animation="true" data-animation-type="fadeInLeft">
                    <!-- begin about -->
                    <div class="about">
                        <h3>Alamat Sekretariat</h3>
                        <p>
                            <strong>HMIF Unikom</strong><br />
                            Universitas Komputer Indonesia<br />
                            Jl. Dipati Ukur No. 112 (<strong>R.4416</strong>)<br />
                            Bandung 40132<br />
                            T: 022 96072227 E: <a href="mailto:humas@hmifunikom.org">humas@hmifunikom.org</a>
                        </p>
                    </div>
                    <!-- end about -->
                </div>
                <!-- end col-4 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #about -->
@stop

@section('javascript')
    <script>
        var mapDefault;

        function handleGoogleMapSetting() {
            var mapOptions = {
                zoom: 18,
                center: new google.maps.LatLng(-6.886513991890386, 107.61547160768511),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                scrollwheel: false,
                disableDoubleClickZoom: true
            };
            mapDefault = new google.maps.Map(document.getElementById('google-map-default'), mapOptions);

            var cobaltStyles  = [{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":10},{"lightness":10},{"gamma":0.8},{"hue":"#293036"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#293036"}]}];
            mapDefault.setOptions({styles: cobaltStyles});

            $(window).resize(function () {
                resize();
            });
        }

        function resize() {
            mapDefault.setCenter(new google.maps.LatLng(-6.886513991890386, 107.61547160768511));
        }

        $(document).ready(function() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&callback=handleGoogleMapSetting';
            document.body.appendChild(script);
        });
    </script>
@stop
