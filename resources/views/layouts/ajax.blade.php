<head>
    {!! Head::render() !!}
    @yield('head')
    <meta name="_token" content="{{ csrf_token() }}" />
</head>
<body class="flat-black">
    @yield('content')
    <script>
        App.restartGlobalFunction();
        {!! show_notification() !!}
    </script>
    @yield('javascript')
</body>