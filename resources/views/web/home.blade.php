@extends('layouts.kids.main')

@section('content')
    <home-kid></home-kid>

    {{-- <section class="home-video-hero">
        <div id="myslider" class="carousel slide" data-ride="carousel" style="opacity: 0.9;">
            <ol class="carousel-indicators">
                <li data-target="#myslider" data-slide-to="0" class="active"> </li>
                <li data-target="#myslider" data-slide-to="1"> </li>
                <li data-target="#myslider" data-slide-to="2"> </li>
                <li data-target="#myslider" data-slide-to="3"> </li>
                <li data-target="#myslider" data-slide-to="4"> </li>
                <li data-target="#myslider" data-slide-to="5"> </li>
            </ol>
            
            <div class="carousel-inner">
                <div class="item active">
                    <img src="https://kidsrepublic.sch.id/uploads/6/0.jpeg" width="100%">
                </div>
                <div class="item">
                    <img src="https://kidsrepublic.sch.id/uploads/6/1.jpeg" width="100%">
                </div>
                <div class="item">
                    <img src="https://kidsrepublic.sch.id/uploads/6/2.jpeg" width="100%">
                </div>
                <div class="item">
                    <img src="https://kidsrepublic.sch.id/uploads/6/3.jpeg" width="100%">
                </div>
                <div class="item">
                    <img src="https://kidsrepublic.sch.id/uploads/6/4.jpeg" width="100%">
                </div>
                <div class="item">
                    <img src="https://kidsrepublic.sch.id/uploads/6/5.jpeg" width="100%">
                </div>
            </div>
        
            <div class="video-overlay"> </div>
                <div class="content-container">
                    <div class="content" style="text-align:center; vertical-align: center; -webkit-filter: drop-shadow(2px 2px 4px black);filter: drop-shadow(2px 2px 4px black);">
                        <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                            <div class="post-content">
                                <h2><span style="font-size:36px;">Welcome to Kids Republic!</span></h2>
                                <h3><span style="font-size:20px;">"One-stop Early Education Center in East Jakarta"</span></h3>
                                <p><span style="font-size:20px;">In our child friendly premise we provide:</span></p>
                                <p><span style="font-size:20px;"><a href="educprogram"><img src="/https://kidsrepublic.sch.id/uploads/images/edu1.png" style="width: 180px; height: 105px;" /></a>&nbsp;&nbsp; <a href="gymprogram" target="_self"><img src="/https://kidsrepublic.sch.id/uploads/images/gym1.png" style="width: 180px; height: 105px;" /></a>&nbsp;&nbsp; <a href="trainingprogram" target="_self"><img src="/https://kidsrepublic.sch.id/uploads/images/training1.png" style="width: 180px; height: 105px;" /></a>&nbsp; &nbsp;<a href="flyer" target="_self"><img src="/https://kidsrepublic.sch.id/uploads/images/Logo-primary-school.png" style="width: 139px; height: 105px;" /></a></span></p>
                                <p>&nbsp;</p>
                                <p><span style="font-size:20px;">Managed by skilled and certified teachers in the field of Early Child Development is our commitment that parents feel safe and student feels comfortable to learn and play..</span></p>
                            </div>
                        </div>
                   </div>
                </div>    
            </div>
            <a class="carousel-control left" href="#myslider" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="carousel-control right" href="#myslider" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </section> --}}

    <video-profile></video-profile>

    <our-feature></our-feature>

    <current-promo></current-promo>

    <latest-news></latest-news>

    {{-- <calendar-dan-event></calendar-dan-event> --}}

    <section class="two-column style-2 event">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <tanggal-component></tanggal-component>
                </div>

                <div class="col-md-4 col-sm-12">
                    <event-component></event-component>
                </div>
            </div>
        </div>
    </section>
    
@stop