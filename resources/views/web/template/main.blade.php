<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$instansi->nama_instansi}} - {{$instansi->tagline}}</title>
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('kids/css/common-style.css')}}">
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('kids/css/responsive.css')}}">
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('kids/css/prettyPhoto.css')}}">
    <link rel="shortcut icon" href="https://kidsrepublic.sch.id/uploads/icons/favicon.ico">

    @yield('css')
</head>
<body class="home-one">
    
    @include('layouts.kids.partials.header')

    @yield('content')
            
        

    @include('layouts.kids.partials.footer')

    <!-- jQuery js -->
	<script src="{{asset('kids/assets/jquery/jquery-1.12.3.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('kids/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('kids/js/jquery.prettyPhoto.js')}}"></script>
    <!-- owl carousel js -->
    <!-- jquery.bxslider js -->
    <script src="{{asset('kids/assets/wow.js')}}"></script>
	<script src="{{asset('kids/assets/owl.carousel-2/owl.carousel.min.js')}}"></script>

    <script src="{{asset('kids/js/script.js')}}"></script>

    @yield('js')

    <script type='text/javascript'>
        msg = document.title;
        msg ="{{$instansi->nama_instansi}} - {{$instansi->tagline}} - "+msg ;
        position = 0;
        
        function scrolltitle() {
          document.title = msg.substring(position, msg.length) + msg.substring(0, position);
          position++;
          if(position > msg.length) position = 0
          window.setTimeout("scrolltitle()", 150);
        }
        
        scrolltitle();
        
    </script>

</body>
</html>