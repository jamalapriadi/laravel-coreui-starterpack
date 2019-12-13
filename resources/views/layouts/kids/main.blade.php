<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$instansi->nama_instansi}}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('front/js/front.js') }}" defer></script>

    <link media="all" type="text/css" rel="stylesheet" href="{{asset('kids/css/common-style.css')}}">
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('kids/css/responsive.css')}}">
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('kids/css/prettyPhoto.css')}}">
    <link rel="shortcut icon" href="https://kidsrepublic.sch.id/uploads/icons/favicon.ico">
</head>
<body class="home-one">
    <div id="app2">
        {{-- <div class="preloader"></div> --}}

        @include('layouts.kids.partials.header')

        @yield('content')
    

        @include('layouts.kids.partials.footer')
    </div>
</body>
</html>