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
    <script src="{{ asset('front/js/front.js') }}" defer></script>

    <link media="all" type="text/css" rel="stylesheet" href="{{asset('front/kids/css/common-style.css')}}">
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('front/kids/css/responsive.css')}}">
	<link media="all" type="text/css" rel="stylesheet" href="{{asset('front/kids/css/prettyPhoto.css')}}">
    <link rel="shortcut icon" href="https://kidsrepublic.sch.id/uploads/icons/favicon.ico">
</head>
<body class="home-one">
    <div id="app">
        {{-- <div class="preloader"></div> --}}

        @include('layouts.kids.partials.header')

        <main-slide></main-slide>

        <section style="margin-top: 90px; margin-bottom: 90px">
            <div class="row"> 
                <!--Video Channel Youtube Kids -->
                <div class="section-title center pb-60">
                    <h2 class="mt-4"> Video <span>Profiles</span></h2> 
                    <div class="col-sm-12">
                        <div class="videoWrapper">
                            <div class="col-sm-6" style="margin-top: 35px">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/BUR7iDUcXoU" frameborder="0" style="border:17px solid #FDFD66; border-radius: 30px" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
    
                            <div class="col-sm-6" style="margin-top: 35px">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/85zttQ5P__A" frameborder="0" style="border:17px solid #ACE1FA; border-radius: 30px" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about" id="feature" style="background-color: rgb(189, 230, 251); padding-bottom: 80px">
                <div class="container">
                    <div class="section-title center pb-60">
                        <h2>Our <span> Feature</span> </h2>
                    </div>
                    <div class="row">
                        <div class="single-column col-md-7 col-sm-12" style="background-color: rgba(250, 250, 250, 0.5) /* Blue background with 30% opacity */; border-radius: 30px; padding-left: 20px">
                            <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                                <div class="post-content">
                                    <div id="fromcke">
                                        <div class="btgrid">
                                            <div class="row row-1">
                                                <div class="col col-md-6">
                                                    <div class="content">
                                                        <p>
                                                            <br />
                                                            <span style="color:#000000;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/speaker%20(1).png" style="width: 32px; height: 32px;" />&nbsp; 
                                                                </span>
                                                            </span>
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">Gymnastic Hall &amp; Indoor Dance Studio</span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/air-conditioner.png" style="width: 32px; height: 32px;" />&nbsp; 
                                                                    Air-Conditioned Classrooms
                                                                </span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/molecule.png" style="width: 32px; height: 32px;" />&nbsp; 
                                                                    Montessori Equipped Classrooms
                                                                </span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/books.png" style="width: 32px; height: 32px;" />&nbsp; 
                                                                    Library Corners inside Classrooms
                                                                </span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/swimming-pool.png" style="width: 32px; height: 32px;" />&nbsp; 
                                                                    Swimming pool
                                                                </span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
        
                                                <div class="col col-md-6">
                                                    <div class="content">
                                                        <p>
                                                            <br />
                                                            <span style="color:#000000;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/bird.png" style="width: 32px; height: 32px;" />&nbsp;
                                                                </span>
                                                            </span>
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;"> Gardening Area &amp; Animals Corner</span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/childhood.png" style="width: 32px; height: 32px;" />&nbsp; Outdoor Playground
                                                                </span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/parents.png" style="width: 32px; height: 32px;" />&nbsp; Parents Lounge &amp; Multipurpose Hall
                                                                </span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/cctv.png" style="width: 32px; height: 32px;" />&nbsp; Online CCTV
                                                                </span>
                                                            </span>
                                                        </p>
        
                                                        <p>
                                                            <br />
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="https://kidsrepublic.sch.id/uploads/images/browser.png" style="width: 32px; height: 32px;" />&nbsp; Online Information System (SIMAK)
                                                                </span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="bootstrap-tabs" data-tab-set-title="Test">&nbsp;</div>
        
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="single-column col-md-5 col-sm-12">  
                            <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                                <figure class="img-box">
                                    <!-- <a href="javascript:void(0)"><img src="https://kidsrepublic.sch.id/resizepng/3/OurFeature-97019.png/685/443/0/0" alt="images"></a> -->
                                    <a href="javascript:void(0)"><img src="https://kidsrepublic.sch.id/resizepng/3/OurFeature-97019.png/700/515/0/0" alt="images"> </a>
                                </figure>
                            </div> 
                        </div>
                    </div>
                </div>           
            </section>
    

        @include('layouts.kids.partials.footer')

        <div class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></div>
    </div>

    {{-- <!-- jQuery js -->
	<script src="https://kidsrepublic.sch.id/assets/frontend/assets/jquery/jquery-1.12.3.min.js"></script>
    <!-- bootstrap js -->
    <script src="https://kidsrepublic.sch.id/assets/frontend/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery.bxslider js -->
    <script src="https://kidsrepublic.sch.id/assets/frontend/assets/owl.carousel-2/owl.carousel.min.js"></script>

    <script src="https://kidsrepublic.sch.id/assets/frontend/assets/Polyglot-Language-Switcher-master/js/jquery.polyglot.language.switcher.js"></script>
    <script src="https://kidsrepublic.sch.id/assets/frontend/assets/fancyapps-fancyBox/source/jquery.fancybox.pack.js"></script>
    <script src="https://kidsrepublic.sch.id/assets/frontend/assets/scrollbar.js"></script>

    <script src="https://kidsrepublic.sch.id/assets/frontend/js/script.js"></script>
    <script src="https://kidsrepublic.sch.id/assets/frontend/js/home-min.js"></script>
    <script src="https://kidsrepublic.sch.id/assets/frontend/js/jquery.prettyPhoto.js"></script>

    <script>
        $(document).ready(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto();
                ({
                    animation_speed: 'normal',
                    opacity: 1,
                    show_title: true,
                    allow_resize: true,
                    counter_separator_label: '/',
                    theme: 'light_square',
                    /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                });
        });
        $( window ).on( "load", function() {
            $('.slidertetimony').owlCarousel({
                loop: true,
                items: true,
                nav: false,
                dots: true,
                autoplay:true
            });
        });

    </script> --}}

</body>
</html>