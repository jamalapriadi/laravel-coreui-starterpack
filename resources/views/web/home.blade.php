@extends('web.template.main')

@section('css')
    <style>
        .myIframe {
            position: relative;
            padding-bottom: 100%;
            height: 0;
            overflow: auto; 
            -webkit-overflow-scrolling:touch;
        } 
        .myIframe iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 97%;
            height: 74%;
        }
    </style>
@stop

@section('content')
    <!-- SLIDER -->
    <section class="home-video-hero">
        <div id="myslider" class="carousel slide" data-ride="carousel" style="opacity: 0.9;">
            <ol class="carousel-indicators">
                @foreach($carousel as $key=>$val)
                    <li data-target="#myslider" data-slide-to="{{$key}}" @if($key==0) class="active" @endif> </li>
                @endforeach
            </ol>
            
            <div class="carousel-inner">
                @foreach($carousel as $key=>$val)
                    <div class="item @if($key==0) active @endif">
                        <img src="{{$val->image_url}}" width="100%">
                    </div>
                @endforeach
            </div>
        
            <div class="video-overlay"> </div>
                <div class="content-container">
                    <div class="content" style="text-align:center; vertical-align: center; -webkit-filter: drop-shadow(2px 2px 4px black);filter: drop-shadow(2px 2px 4px black);">
                        <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                            <div class="post-content">
                                {!! $overlay->text !!}
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
    </section>
    <!-- END SLIDER -->

    <!-- VIDEO -->
    <section style="margin-top: 90px; margin-bottom: 90px">
        <div class="container-fluid">
            <div class="row"> 
                <div class="section-title center pb-60">
                    <h2 class="mt-4"> Video <span>Profiles</span></h2> 
                    <div class="col-sm-12">
                        <div class="videoWrapper">
                            @foreach($video as $key=>$val)
                                @if($agent->isDesktop())
                                    <div class="col-sm-6" style="margin-top: 35px">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$val->video_id}}" 
                                            frameborder="0" 
                                            @if($key % 2==0) style="border:17px solid #FDFD66; border-radius: 30px" @else style="border:17px solid #ACE1FA; border-radius: 30px" @endif
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @endif

                                @if($agent->isPhone())
                                    <div class="col-sm-6" style="margin-top:15px;margin-left:-15px;margin-right:-15px;">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$val->video_id}}" 
                                            frameborder="0" 
                                            @if($key % 2==0) style="border:10px solid #FDFD66; border-radius: 30px" @else style="border:10px solid #ACE1FA; border-radius: 30px" @endif
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @endif
                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- OUR VIDEO -->

    <!-- FASILITAS -->
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
                                                @foreach($fasilitas as $key=>$val)
                                                    @if($key < 5)
                                                        <p>
                                                            <br />
                                                            <span style="color:#000000;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="{{$val->icon_url}}" style="width: 32px; height: 32px;" />&nbsp; 
                                                                </span>
                                                            </span>
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">{{$val->name}}</span>
                                                            </span>
                                                        </p>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col col-md-6">
                                            <div class="content">
                                                @foreach($fasilitas as $key=>$val)
                                                    @if($key >= 5)
                                                        <p>
                                                            <br />
                                                            <span style="color:#000000;">
                                                                <span style="font-size:18px;">
                                                                    <img alt="" src="{{$val->icon_url}}" style="width: 32px; height: 32px;" />&nbsp; 
                                                                </span>
                                                            </span>
                                                            <span style="color:#333333;">
                                                                <span style="font-size:18px;">{{$val->name}}</span>
                                                            </span>
                                                        </p>
                                                    @endif
                                                @endforeach
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
                            <a href="javascript:void(0)"><img src="https://kidsrepublic.sch.id/resizepng/3/OurFeature-97019.png/700/515/0/0" alt="images"> </a>
                        </figure>
                    </div> 
                </div>
            </div>
        </div>           
    </section>
    <!-- END FASILITAS -->


    <!-- PROMO -->
    <section class="event" style="padding-bottom:30px;">
        <div class="container">
            <div class="section-title">
                <h2>Current <span>Promo</span></h2>
            </div>
            <div class="event-carousel">
                @foreach($promo as $key=>$val)
                    <div class="item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                        <div class="img-holder">
                            <figure>
                                <a href="{{URL::to('promo/'.$val->slug)}}" target="_blank">
                                    <img src="{{$val->feature_image_url}}" alt="images" class="img-responsive img-fluid" style="width:370px;height:370px;">
                                </a>
                            </figure>
                            <div class="content bg-color-3" style="line-height: 1.5em; height: 6em; overflow: hidden;">
                                <div class="newsletter-home">
                                    <h4><span style="display:block;text-overflow: ellipsis;width: 100px;overflow: hidden; white-space: nowrap;"></span>
                                    <a href="{{URL::to('promo/'.$val->slug)}}" target="_blank">{{$val->title}}</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- END PROMO -->

    <!-- NEWS -->
    <section class="about" id="feature">
        <section class="two-column style-2 event" style="background-color: rgb(189, 230, 251); margin-bottom: 80px">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 tab-column">
                        <div class="section-title">
                            <h2>News</h2>
                        </div>
                        <div class="event-carousel" id="newsletterslider">
                            @foreach($news as $key=>$val)
                                <div class="item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                                    <div class="img-holder">
                                        <figure>
                                            <a href="{{URL::to('news/'.$val->slug)}}" target="_blank">
                                                @if($agent->isDesktop())
                                                    <img src="{{$val->feature_image_url}}" style="width:236px;height:106px;" alt="images">
                                                @endif

                                                @if($agent->isPhone())
                                                    <img src="{{$val->feature_image_url}}" style="width:384px;height:173px;" class="img-responsive" alt="images">
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="content bg-color-2" style="line-height: 1.5em; height: 9em; overflow: hidden;">
                                            <div class="newsletter-home">
                                                <h4><a href="{{URL::to('news/'.$val->slug)}}" target="_blank">{{$val->title}}</a></h4>
                                                <p>Date Event <span class="fa fa-clock-o"></span> {{$val->tanggal_indo}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 testimonial">
                        <div class="section-title">
                            <h2>Parent <span>Testimonial</span></h2>
                        </div>
                        <div class="slidertetimony">
                            @foreach($testimoni as $key=>$val)
                                <div class="item center" style="background-color: rgba(250, 250, 250, 0.5)">
                                    <img src="{{$val->feature_image_url}}" alt="images" style="width:75px; height:75px">
                                    <div class="img-ifo">
                                        <div class="text">
                                            <p>
                                                <font color="#000000">
                                                    {!! $val->description !!}
                                                </font>
                                            </p>
                                        </div>
                                        <div class="link">
                                            <a target="_blank" href="{{URL::to('testimony')}}" class="btn-style-one">{{$val->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- END NEWS -->

    <section class="two-column style-2 event">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="section-title">
                        <h2>Calendar<span> Academics</span></h2>
                        <ul>
                            @if($calendar != null)
                                @if(count($calendar->files) > 0)
                                    <li>
                                        {{-- $calendar->files[0]->image_url --}}
                                        <a href="{{URL::to('download?type=calendar&file='.$calendar->files[0]->id)}}" target="_blank" rel="nofollow" title="Calendar Academic">
                                            <button type="button" class="btn btn-primary" style="margin-bottom: 10px"> 
                                                <i class="fa fa-download"></i> Download Calendar
                                            </button>
                                        </a>
                                    </li>
                                @endif 
                            @endif
                        </ul>

                        <div class="myIframe" style="position: relative;
                        padding-bottom: 100%;
                        height: 0;
                        overflow: hidden; 
                        -webkit-overflow-scrolling:touch;">
                            @if($calendar != null)
                                @if(count($calendar->files) > 0)
                                    {{-- <iframe src="https://kidsrepublic.sch.id/uploads/Documents/Academic_Calendar_2019-2020_(Parents).pdf#zoom=170" style="position: absolute; top: -20%;
                                    left:-25%;
                                    width: 200%;
                                    height: 100%;"></iframe> --}}
                                    {{-- <iframe id="fred" src="{{$calendar->files[0]->image_url}}" 
                                        frameborder="0" scrolling="auto" height="1100" width="850" ></iframe> --}}

                                    {{-- <iframe src="https://docs.google.com/viewerng/viewer?url={{$calendar->files[0]->image_url}}&embedded=true" frameborder="0" height="100%" width="100%">
                                        </iframe> --}}

                                    <iframe src="https://docs.google.com/viewerng/viewer?url=https://kidsrepublic.sch.id/uploads/Documents/Academic_Calendar_2019-2020_(Parents).pdf&embedded=true&zoom=9" style="position:absolute;right:0; top:0; bottom:0; width:100%;" frameborder="0" height="100%" width="1500px">
                                        </iframe>

                                @endif 
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="upcoming-event">
                        <div class="section-title"> 
                            <h2>Upcoming<span> Events</span></h2>
                        </div>

                        @foreach($event as $key=>$val)
                            <div class="item">
                                <div class="content">
                                    <tr>
                                        <td>
                                            <h4><a href="{{URL::to('event/'.$val->slug)}}" target="_blank" style="font color: #000">{{$val->title}}</a></h4>
                                            <p><span class="fa fa-calendar-o"></span> {{$val->hari_indo}}, {{date('d M Y',strtotime($val->tanggal))}}</p>
                                            <p><span class="fa fa-clock-o"></span> {{date('H:i',strtotime($val->jam_mulai))}} - {{date('H:i',strtotime($val->jam_selesai))}}</p>
                                            <p><span class="fa fa-map-marker"></span>{{$val->lokasi}}</p>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    
@stop