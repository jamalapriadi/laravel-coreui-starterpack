@if($page->post_template == 'default')

    @extends('web.template.default')
    
@elseif($page->post_template == 'column-two')

@elseif($page->post_template == 'template-with-sidebar')

@endif

@section('content')
    @if($page->heading_title!=null)
        <section class="page-title center">
            <div class="container">
                <h2>{{$page->heading_title}}</h2>
            </div>
        </section>
    @endif

    @if($page->page_type == "component")
        @if($page->component_name == "founder-component")
            <section class="about animated fadeIn" id="founder">
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
                                <center>
                                    <figure class="img-box">
                                        @if($agent->isDesktop())
                                            @if($row->image_alignment == "center")
                                                <center>
                                                    <img src="{{$row->image_url}}" class="img-responsive" align="{{$row->image_alignment}}" alt="images" style="max-width:{{$row->image_width}}px; max-height:{{$row->image_height}}px;border-radius: {{$row->image_border_top_left_radius}}px {{$row->image_border_top_right_radius}}px {{$row->image_border_bottom_right_radius}}px {{$row->image_border_bottom_left_radius}}px ;">
                                                </center>
                                            @else 
                                                <img src="{{$row->image_url}}" class="img-responsive" align="{{$row->image_alignment}}" alt="images" style="max-width:{{$row->image_width}}px; max-height:{{$row->image_height}}px;border-radius: {{$row->image_border_top_left_radius}}px {{$row->image_border_top_right_radius}}px {{$row->image_border_bottom_right_radius}}px {{$row->image_border_bottom_left_radius}}px ;">
                                            @endif
                                        @endif

                                        @if($agent->isPhone())
                                            <img src="{{$row->image_url}}" alt="images" style="width:210px; height:280px;">
                                        @endif
                                    </figure>
                                </center>
                                <hr>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($page->component_name == "gallery-component")
            <section class="filter animated fadeIn" style="padding-top: 75px;">
                <div class="container">
                    <div class="pull-left">
                        <select class="col-md-4 col-sm-6 col-xs-12 btn-style-one" id="pilihgallery">
                            <option value="">Select Album</option>
                            @foreach($component as $key=>$val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </section>

            <section class="gallery-section gallery-three-column style-3 animated fadeIn">
                <div class="container">
                
                    <!--Sortable Masonry-->
                    <div class="sortable-gallery">
                        <!--Filter-->
                        <div class="row" class="gallery">
                            <div id="lightbox" class="lightbox">
                                <!--Default Portfolio Item-->
                                <div id="tampilGalleryFile" data-url="{{URL::to('list/gallery-file')}}"></div>

                                <div id="tampilLoadMore"></div>
                            </div>
                        </div>
                    </div>

                    <div id="divModal"></div>
                </div>
            </section>            
        @endif

        
        @if($page->component_name == "contact-component")
            <section class="contact-us animated fadeIn" style="background-color: rgb(189, 230, 251);">
                <div class="upper">
                    <div class="container">
                        <div class="row">
                            <div class="single-column col-md-6" style="margin-bottom:30px;">
                                <div class="section-title">
                                    <h2>Find<span> Us</span> </h2>
                                </div>

                                <div class="map-responsive">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.780692068041!2d106.889507!3d-6.237987!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc2aff6aaa55a9a49!2sKids%20Republic!5e0!3m2!1sid!2sid!4v1566739844103!5m2!1sid!2sid" width="100%" height="530" frameborder="0" style="border:0; border-radius: 30px; box-shadow: 10px 10px 5px grey;" allowfullscreen=""></iframe>
                                </div>
                            </div>

                            <div class="single-column col-md-6" style="margin-bottom:30px;">
                                <div class="section-title">
                                    <h2>Get In<span> Touch</span> </h2>
                                </div>    
                                <div class="contact-box">
                                    <div id="loading"></div>

                                    <form onsubmit="return false" id="formContactUs" data-action="{{URL::to('proses/kontak')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                                <input type="text" style="border-radius: 10px" name="first_name" maxlength="28" placeholder="First Name*" required>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                                <input type="text" style="border-radius: 10px" name="last_name" maxlength="28" placeholder="Last Name*" required>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                                <input type="email" style="border-radius: 10px" name="email" maxlength="50" placeholder="Email*" required>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                                <input type="text" style="border-radius: 10px" name="phone" maxlength="30" placeholder="Phone No" required>
                                            </div>
                                            <div class="form-group col-lg-12 col-sm-12 col-xs-12">
                                                <textarea name="message" style="border-radius: 10px; height: 285px" maxlength="300" v-model="state.message" placeholder="Message" required></textarea>
                                            </div>
                                            <div class="form-group col-lg-12 center">
                                                <button type="submit" name="submit" class="btn-style-one center">Submit now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <section class="contact-us">
                <div class="upper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 column">
                                <div class="item center">
                                    <div class="icon">
                                        <span class="icon-location"></span>
                                    </div>
                                    <div class="content">
                                        <h4><a href="#">Main Campus</a></h4>
                                        <p>Jl. Cipinang Bali 1 no. 5A Kec. Jatinegara,<br />Jakarta Timur 13420</p>
                                    </div>
                                </div>

                                <div class="item center">
                                    <div class="icon">
                                        <span class="icon-technology-2"></span>
                                    </div>
                                    <div class="content">
                                        <h4><a href="#">Phone</a></h4>
                                        <p>(021) 2982 7245</p>
                                        <p>0821 200 77600</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 column">

                                <div class="item center">
                                    <div class="icon">
                                        <span class="icon-location"></span>
                                    </div>
                                    <div class="content">
                                        <h4><a href="#">Center Bekasi</a></h4>
                                        <p>Kids Republic Jl. Pulo Sirih Barat, Ruko Arcadia Blok Bd 111,112,115 Grand Galaxy City, Bekasi</p>
                                    </div>
                                </div>

                                <div class="item center">
                                    <div class="icon">
                                        <span class="icon-technology-2"></span>
                                    </div>
                                    <div class="content">
                                        <h4><a href="#">Phone</a></h4>
                                        <p>0813 888 33343</p>   
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12 column">
                                <div class="item center">
                                    <div class="icon">
                                        <span class="icon-interface"></span>
                                    </div>
                                    <div class="content">
                                        <h4><a href="#">Email</a></h4>
                                        <p>info@kidsrepublic.sch.id</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($page->component_name == "newsletter-component")
            <div class="sidebar-page blog animated fadeIn">
                <div class="container">
                    <div class="row clearfix">
                        <!--Content Side--> 
                        <div class="col-md-8 col-sm-7 col-xs-12 blog-column">
                            <section class="blog-container">
                                <!--Blog Post-->
                                @php 
                                    $lebar=0;
                                    $posisi="";
                                @endphp

                                @foreach($component as $key=>$val)
                                <div class="blog-post wow fadeIn animated" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <article class="single-column">
                                        <div class="img-box-s2">
                                            @if($key==0)
                                                @php 
                                                    $lebar=$val->image_width;
                                                    $posisi=$val->image_alignment;
                                                @endphp
                                                <div class="img-holder">
                                                    @if($agent->isDesktop())
                                                        @if($val->image_alignment == "center")
                                                            <center>
                                                                <img src="{{$val->feature_image_url}}" class="img-responsive" alt="images" style="width:{{$val->image_width}}px; height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                            </center>
                                                        @else 
                                                            <img src="{{$val->feature_image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                        @endif
                                                    @endif

                                                    @if($agent->isPhone())
                                                        <img src="{{$val->feature_image_url}}" class="img-responsive" alt="" style="border-radius: 0 15px 0 15px;">
                                                    @endif
                                                </div>
                                                
                                                <div style="clear:both"></div>
                                            @endif
                                            

                                            @if($key <=2)
                                                @if($posisi == "center")
                                                    <center>
                                                        @if($agent->isDesktop())
                                                            <div class="outer-box" style="width:{{$lebar}}px;">
                                                        @elseif($agent->isPhone())
                                                            <div class="outer-box">
                                                        @else 
                                                            <div class="outer-box">
                                                        @endif
                                                            <div class="content">
                                                                @if($key==0)
                                                                {{-- <div class="date">
                                                                    <span>{{date('d M Y',strtotime($val->updated_at))}}</span>
                                                                </div> --}}
                                                                
                                                                @endif
        
                                                                <h3>
                                                                    <a>{{$val->title}}</a>
                                                                </h3>
                                                        
                                                                <div class="text">
                                                                    <p>
                                                                        {!! $val->description !!}
                                                                    </p>
                                                                    <p>Please <a href="{{URL::to('subscribe')}}">Subscribe here</a> for update Newsletter</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </center>    
                                                @else
                                                    @if($agent->isDesktop())
                                                        <div class="outer-box" style="width:{{$lebar}}px;">
                                                    @elseif($agent->isPhone())
                                                        <div class="outer-box"></div>
                                                    @else 
                                                        <div class="outer-box"></div>
                                                    @endif
                                                        <div class="content">
                                                            @if($key==0)
                                                            {{-- <div class="date">
                                                                <span>{{date('d M Y',strtotime($val->updated_at))}}</span>
                                                            </div> --}}
                                                            
                                                            @endif
    
                                                            <h3>
                                                                <a>{{$val->title}}</a>
                                                            </h3>
                                                    
                                                            <div class="text">
                                                                <p>
                                                                    {!! $val->description !!}
                                                                </p>
                                                                <p>Please <a href="{{URL::to('subscribe')}}">Subscribe here</a> for update Newsletter</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </article>  
                                </div>
                                @endforeach
                            </section>
                        </div>

                        <!--Sidebar-->  
                        <div class="col-md-4 col-sm-5 col-xs-12 sidebar-column">
                            <aside class="sidebar">
                                <!-- Popular Categories -->
                                <div class="widget popular-categories wow fadeIn animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeIn;">
                                    <div class="sidebar-title"><h2>Edi<span>tion</span></h2></div>
                                    
                                    <ul class="list catagories">
                                        @php $jum_arsip=0; @endphp
                                        
                                        @foreach($summary as $key=>$val)
                                            @if(date('Y',strtotime($val->created_at)) == date('Y'))
                                                <li>
                                                    <!--<a href="javascript:void(0)" >{{$val->periode}}<span class="float-right">({{$val->jumlah}})</span></a>-->
                                                    {{-- <a href="javascript:void(0)" >{{$val->title}}</a> --}}
                                                    <a href="javascript:void(0)" >Newsletter {{date('M Y',strtotime($val->created_at))}}</a>
                                                </li>
                                            @endif
                                            
                                            @if(date('Y',strtotime($val->created_at)) < date('Y'))
                                                @php $jum_arsip=1; @endphp
                                            @endif
                                        @endforeach
                                    </ul>
                                    
                                    @if($jum_arsip > 0)
                                        <div id="demo" class="collapse">
                                            <ul class="list catagories">
                                                @foreach($summary as $key=>$val)
                                                    @if(date('Y',strtotime($val->created_at)) < date('Y'))
                                                        <li>
                                                            <a href="javascript:void(0)" >{{$val->title}}</a>
                                                        </li>
                                                    @endif
                                            @endforeach
                                            </ul>
                                        </div>
                                        <a href="#demo" class="btn btn-block" data-toggle="collapse">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Popular Tags -->
                                <div class="widget recent-photo">
                                    <div class="sidebar-title"><h2>Recent <span>Photo</span></h2></div>
                                    
                                    <div class="instagram">
                                        @foreach($photo as $key=>$val)
                                            <figure class="img-box">
                                                <a href="{{$val->image_url}}" target="_blank">
                                                    <img src="{{$val->image_url}}" alt="" style="width:83px; height:83px;">
                                                    {{-- <img src="{{$val->image_url}}" alt="images" style="width:{{$val->image_width}}px; height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;"> --}}
                                                </a>
                                            </figure>
                                        @endforeach
                                    </div>                   
                                </div>
                            </aside>
                        </div>
                        <!--Sidebar-->
                    </div>
                </div>
            </div>
        @endif

        @if($page->component_name == "testimoni-component")
            <testimoni-component></testimoni-component>
        @endif
    @endif

    @if($page->page_type == "text")
        {{-- Column Two --}}
        @if($page->post_template == "column-two")
            <section class="about animated fadeIn" id="story">
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

                        <div class="single-column col-md-6 col-sm-12" style="margin-top: 90px;">
                            <div class="wow fadeIn animated" data-wow-duration="2s" data-wow-delay="0.5s" data-wow-offset="0" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: fadeIn; border: 0;border-radius: 10px;">
                                <figure class="img-box">
                                    <a href="#">
                                        @if($agent->isDesktop())
                                            <img src="{{$page->feature_image_url}}" alt="images" style="width:{{$page->image_width}}px; height:{{$page->image_height}}px;border-radius: {{$page->image_border_top_left_radius}}px {{$page->image_border_top_right_radius}}px {{$page->image_border_bottom_right_radius}}px {{$page->image_border_bottom_left_radius}}px ;">
                                        @endif

                                        @if($agent->isPhone())
                                        <img src="{{$page->feature_image_url}}" class="img-responsive" alt="" style="border-radius: 0 15px 0 15px;">
                                        @endif
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
            <section class="about animated fadeIn" id="teacher">
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
            <section class="about animated fadeIn" id="facility">
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
                                                        @if($agent->isDesktop())
                                                            @if($val->image_alignment == "center")
                                                                <center>
                                                                    <img src="{{$val->image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                                </center>
                                                            @else 
                                                                <img src="{{$val->image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                            @endif
                                                        @endif

                                                        @if($agent->isPhone())
                                                            <img src="{{$val->image_url}}" alt="images" style="border-radius: 0 15px 0 15px;">
                                                        @endif
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

            <section class="about animated fadeIn" id="teacher">
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
                                            <p>
                                                @if($agent->isDesktop())
                                                    @if($val->image_alignment == "center")
                                                        <center>
                                                            <img src="{{$val->image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                        </center>
                                                    @else 
                                                        <img src="{{$val->image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                    @endif
                                                @endif

                                                @if($agent->isPhone())
                                                    <img alt="" src="{{$val->image_url}}" style="width: 100%; border-radius: 10px;" />
                                                @endif
                                            </p>
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

        @if($page->post_template =="column-two-with-carousel")
            <section class="about animated fadeIn" id="teacher">
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

                                        @if($page->slug == "extracuriculer")
                                            <div class="btgrid">
                                                <div class="row row-1">
                                                    <div class="col col-md-6">
                                                        <div class="content">
                                                            <p>
                                                                <span style="color:#333333;">
                                                                    <strong style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: sans-serif,Arial,Verdana,&amp;quot;trebuchet ms&amp;quot;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 700; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;">
                                                                        <span style="box-sizing: border-box; font-size: 24px;">
                                                                            <span style="box-sizing: border-box; line-height: 115%;">
                                                                                <span style="box-sizing: border-box; font-style: normal;">
                                                                                    <span style="box-sizing: border-box; font-weight: 700;">Gymnastic Extracurricular</span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </strong>
                                                                </span>
                                                            </p>
                                            
                                                            <ul style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: sans-serif,Arial,Verdana,&amp;quot;trebuchet ms&amp;quot;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; padding-bottom: 0px; padding-left: 40px; padding-right: 40px; padding-top: 0px; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;">
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Gymnastic (1x/ week)</span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Kids Dance (1x/ week)</span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Intro to Sport (1x/ week)</span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Little Futsal (1x/ week)</span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Karate Kids (1x/ week)</span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Taekwondo (1x/ week)</span></span></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="col col-md-6">
                                                        <div class="content">
                                                            <p>
                                                                <span style="color:#333333;">
                                                                    <strong style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: sans-serif,Arial,Verdana,&amp;quot;trebuchet ms&amp;quot;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 700; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;">
                                                                        <span style="box-sizing: border-box; font-size: 24px;">
                                                                            <span style="box-sizing: border-box; line-height: 115%;">Other extracurricular activities:</span>
                                                                        </span>
                                                                    </strong>
                                                                </span>
                                                            </p>
                                            
                                                            <ul style="box-sizing: border-box; color: rgb(51, 51, 51); font-family: sans-serif,Arial,Verdana,&amp;quot;trebuchet ms&amp;quot;; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; padding-bottom: 0px; padding-left: 40px; padding-right: 40px; padding-top: 0px; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;">
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Ballet Kids Republic x RAFA International Dance School </span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Swimming </span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Kids Republic x Gen Cerdik Fun Science</span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Kids Republic Robotic </span></span></span></li>
                                                                <li style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;"><span style="color:#333333;"><span style="box-sizing: border-box; line-height: 115%;"><span style="box-sizing: border-box;">Kids Republic x Haqiqi Qur’an Learning</span></span></span></li>
                                                            </ul>
                                            
                                                            <p style="box-sizing: border-box; margin-bottom: 0pt; margin-right: 0cm; margin-top: 0cm; text-align: justify;">&nbsp;</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>

                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div> 
                    </div>

                    <section class="home-video-hero">
                        <div id="myslider" class="carousel slide" data-ride="carousel" style="opacity: 0.9;background:transparent;">
                            <ol class="carousel-indicators">
                                @foreach($page->files as $key=>$val)
                                    <li data-target="#myslider" data-slide-to="{{$key}}" @if($key == 0) class="active" @endif> </li>
                                @endforeach
                            </ol>
    
                            <div class="carousel-inner" style="background:transparent">
                                @foreach($page->files as $key=>$val)
                                    <div class="item @if($key == 0) active @endif" style="background:transparent">
                                        
                                        @if($agent->isDesktop())
                                            @if($val->image_alignment == "center")
                                                <center>
                                                    <img src="{{$val->image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                                </center>
                                            @else 
                                                <img src="{{$val->image_url}}" class="img-responsive" align="{{$val->image_alignment}}" alt="images" style="max-width:{{$val->image_width}}px; max-height:{{$val->image_height}}px;border-radius: {{$val->image_border_top_left_radius}}px {{$val->image_border_top_right_radius}}px {{$val->image_border_bottom_right_radius}}px {{$val->image_border_bottom_left_radius}}px ;">
                                            @endif
                                        @endif

                                        @if($agent->isPhone())
                                            <img src="{{$val->image_url}}" class="img-responsive" width="100%" style="border-radius:0 15px 0 15px;">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                
                            <a class="carousel-control left" href="#myslider" data-slide="prev" style="background:transparent">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="carousel-control right" href="#myslider" data-slide="next" style="background:transparent">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </section>

                    @if($page->slug == "extracuriculer")
                        <p>
                            <br />
                            <br />
                            <span style="color:#333333;"><u><span style="font-size:18px;"><strong>Partnership with :</strong></span></u></span><br />
                            &nbsp;
                        </p>

                        <div class="btgrid">
                            <div class="row row-1">
                                <div class="col col-md-3">
                                    <div class="content">
                                        <p>&nbsp;</p>
                                        <p><span style="color:#333333;"><img alt="" src="https://kidsrepublic.sch.id/uploads/images/Extra_robotic.jpeg" style="width: 200px; height: 64px;border-radius: 0 15px 0 15px;" /></span></p>
                                    </div>
                                </div>
                            
                                <div class="col col-md-3">
                                    <div class="content">
                                        <p><span style="color:#333333;"><img alt="" src="https://kidsrepublic.sch.id/uploads/images/RAFA%20LOGO%20(RGB)-01.png" style="width: 200px; height: 141px;border-radius: 0 15px 0 15px;" /></span></p>
                                    </div>
                                </div>
                            
                                <div class="col col-md-3">
                                    <div class="content">
                                        <p><span style="color:#333333;"><img alt="" src="https://kidsrepublic.sch.id/uploads/images/Extra_haqiqi%281%29.jpeg" style="width: 200px; height: 155px;border-radius: 0 15px 0 15px;" /></span></p>
                                    </div>
                                </div>
                            
                                <div class="col col-md-3">
                                    <div class="content">
                                        <p><span style="color:#333333;"><img alt="" src="https://kidsrepublic.sch.id/uploads/images/Extra_cerdik.jpeg" style="width: 200px; height: 146px;border-radius: 0 15px 0 15px;" /></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else   
                        <br><br>
                    @endif
                </div>
            </section>
        @endif
        
    @endif

    @if($page->page_type == "text and component")
        <section class="about animated fadeIn" id="teacher">
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
                                                                @if($agent->isDesktop())
                                                                    <img src="{{$file->feature_image_url}}" alt="images" style="width:{{$file->image_width}}px; height:{{$file->image_height}}px;border-radius: {{$file->image_border_top_left_radius}}px {{$file->image_border_top_right_radius}}px {{$file->image_border_bottom_right_radius}}px {{$file->image_border_bottom_left_radius}}px ;">
                                                                @endif 

                                                                @if($agent->isPhone())
                                                                    <img alt="Crawler" src="{{$file->feature_image_url}}" style="width: 150px; height: 150px;border-radius: 0 15px 0 15px;" />
                                                                @endif
                                                            </span>
                                                        </span>
                                                    </div>
                                        
                                                    <div style="background: rgb(172, 225, 250); border: 1px solid rgb(204, 204, 204); padding: 5px 10px; text-align: center;">
                                                        {!! $file->description !!}
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