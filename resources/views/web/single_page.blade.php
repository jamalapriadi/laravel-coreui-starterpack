@if($page->post_template == 'default')
    @extends('web.template.default')
@elseif($page->post_template == 'column-two')

@elseif($page->post_template == 'template-with-sidebar')

@endif

@section('content')
    <section class="page-title center">
        <div class="container">
            <h2>{{$page->title}} {{$page->second_title}}</h2>
        </div>
    </section>

    @if($page->page_type == "component")
        @if($page->component_name == "founder-component")
            <section class="about" id="founder">
                <div class="container">
                    <div class="section-title">
                        <h2>Founders <span>Profile</span> </h2>
                    </div>
                    <div class="row text">
                        @foreach($component as $row)
                            <div class="teacher-profile-tab col-md-8" style="text-align: justify;">  
                                <div class="heading-block">
                                    <h3>{{$row->name}}</h3>
                                </div>
                                <br>
                                {!! $row->description !!}
                            </div>
                            <div class="teacher-profile-tab col-md-4"> 
                                <a href="#10" aria-controls="10" role="tab" data-toggle="tab">
                                    <img src="{{$row->image_url}}" alt="images">
                                </a>
                                <hr>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($page->component_name == "gallery-component")
            <gallery-component></gallery-component>
        @endif

        
        @if($page->component_name == "contact-component")
            <contact-component></contact-component>
        @endif

        @if($page->component_name == "newsletter-component")
            <newsletter-component></newsletter-component>
        @endif

        @if($page->component_name == "testimoni-component")
            <testimoni-component></testimoni-component>
        @endif
    @endif

    @if($page->page_type == "text")
        {{-- Column Two --}}
        @if($page->post_template == "column-two")
            <section class="about" id="story">
                <div class="container">
                    <div class="row">
                        <div class="single-column col-md-6 col-sm-12">
                            <div class="section-title">
                                <h2>{{$page->title}}<span> {{$page->second_title}}</span> </h2>
                            </div>

                            <div class="post-content">
                                <div id="fromcke">
                                    {!! $page->description !!}
                                </div>
                            </div>
                        </div> 

                        <div class="single-column col-md-6 col-sm-12" style="margin-top: 90px">
                            <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn; border: 0;border-radius: 10px;">
                                <figure class="img-box">
                                    <a href="#">
                                        <img src="{{$page->feature_image_url}}" alt="">
                                    </a>
                                </figure>
                            </div> 
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- End Column Two --}}

        @if($page->post_template == "default")
            <section class="about" id="teacher">
                <div class="container">
                    <div class="row">
                        <div class="single-column col-md-12 col-sm-12">
                            <div class="section-title">
                                <h2>{{$page->title}}<span> {{$page->second_title}}</span> </h2>
                            </div>

                            <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                                <div class="post-content">
                                    <div id="fromcke">
                                        {!! $page->description !!}
                                    </div>
                                </div>
                            </div>

                        </div> 
                    </div>
                </div>
            </section>
        @endif

        @if($page->post_template == "column-two-with-slider")
            <section class="about" id="facility">
                <div class="container">
                    <div class="section-title"> 
                        <h2>{{$page->title}}<span> {{$page->second_title}}</span> </h2>
                    </div>
                    <div class="row">
                        <div class="single-column col-md-6 col-sm-12" style="padding-top: 30px; text-align: justify;">
                            <div class="post-content">
                                <div id="fromcke">
                                    {!! $page->description !!}
                                </div>
                            </div>
                        </div>

                        @foreach($page->files as $key=>$val)
                            <div class="double-column col-md-3 col-sm-12">
                                <div class="event"> 
                                    <div class="#" style="margin-top: 0px;">
                                        <div class="item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn; width: 100%;">
                                            <div class="img-holder">
                                                <figure>
                                                    <a href="#">
                                                        <img src="{{$val->image_url}}" alt="images">
                                                    </a>
                                                </figure>
                                                <div class="content bg-color-1">
                                                    <div class="newsletter-home">
                                                        <h4><a href="#">{{$val->title}}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        @endforeach


                    </div>
                </div>
            </section>
        @endif

        @if($page->post_template == "column-two-with-thumbnail")

            <section class="about" id="teacher">
                <div class="container"> 
                    <div class="row">
                        <div class="single-column col-md-12 col-sm-12">
                            <div class="section-title"> 
                                <h2>{{$page->title}}<span> {{$page->second_title}}</span> </h2>
                            </div>

                            <div class="post-content">
                                <div id="fromcke">
                                    {!! $page->description !!}
                                </div>
                            </div>

                            <div class="row">
                                @foreach($page->files as $key=>$val)
                                    <div class="col col-md-6">
                                        <div class="content">
                                            <p>{{$val->title}}</p>
                                            <p><img alt="" src="{{$val->image_url}}" style="width: 100%; border-radius: 10px;" /></p>
                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
    @endif

    @if($page->page_type == "text and component")
        <section class="about" id="teacher">
            <div class="container">
                <div class="row">
                    <div class="single-column col-md-12 col-sm-12">
                        <div class="section-title">
                            <h2>{{$page->title}}<span> {{$page->second_title}}</span> </h2>
                        </div>

                        <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn;">
                            <div class="post-content">
                                <div id="fromcke">
                                    {!! $page->description !!}

                                    <hr>
                                    @if($page->component_name == "program-component")
                                        <div class="row">
                                            <div style="text-align: center;"><span style="color:#333333;"><small><span dir="ltr"><big><span style="font-size:26px;"><span style="background:white"><span style="line-height:normal"><span style="font-family:&quot;dosis&quot;,serif"><strong>OUR PROGRAM</strong></span></span></span></span></big></span></small></span></div>
                                            <br>
                                            
                                            @foreach($program as $file)
                                                <div class="col-lg-6" style="margin-bottom:20px;">
                                                    <div style="background: rgb(253, 253, 102); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                                                        <span style="color:#333333;">
                                                            <span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;">
                                                                <span style="font-size:9.0pt">
                                                                    <span style="line-height:107%">
                                                                        <span style="font-size:16px;">
                                                                            <strong>{{$file->title}}</strong>
                                                                        </span>
                                                                        <br />
                                                                        {{$file->second_title}}&nbsp;
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </div>
                                        
                                                    <div style="background: rgb(238, 238, 238); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                                                        <span style="color:#333333;">
                                                            <span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;">
                                                                <img alt="Crawler" src="{{$file->feature_image_url}}" style="width: 150px; height: 150px;" />
                                                            </span>
                                                        </span>
                                                    </div>
                                        
                                                    <div style="background: rgb(172, 225, 250); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                                                        <span style="color:#333333;">
                                                            <span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif;">
                                                                <span style="font-size:14px;">
                                                                    <span style="line-height:107%">
                                                                        {!! $file->description !!}
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </div>
                                        
                                        
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div> 
                </div>
            </div>
        </section>
    @endif
@stop