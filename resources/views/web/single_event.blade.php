@extends('web.template.default')

@section('content')
    <section class="page-title center">
        <div class="container">
            <h2>{{$page->title}} {{$page->second_title}}</h2>
        </div>
    </section>

    <div class="sidebar-page product-details">
        <div class="container">
        
            <div class="row clearfix">
                
                <!--Content Side--> 
                <div class="col-md-8 col-sm-7 col-xs-12 post-column">
                    <section class="post-container">
                        
                        <!--Blog Post-->
                        <div class="blog-post wow fadeInLeft animated animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <article class="single-column">
                                <div class="img-box-s2">
                                    <div class="img-holder">
                                        <img src="{{$page->feature_image_url}}" alt="images">
                                    </div>
                                    <div class="outer-box">
                                        <div class="content">
                                            <h3><a href="#">{{$page->title}}</a></h3>
                                            <div class="date"><span class="icon-clock">{{date('d M Y',strtotime($page->tanggal))}} | {{date('H:i', strtotime($page->jam_mulai))}} - {{date('H:i', strtotime($page->jam_selesai))}}</span> <span class="icon-location">{{$page->lokasi}}</span></div>
                                            {!! $page->description !!}
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>

                <!--Sidebar-->  
                <div class="col-md-4 col-sm-5 col-xs-12 sidebar-column">
                    <aside class="sidebar">
                        <!-- Popular Categories -->
                        <div class="widget popular-categories wow fadeInUp animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                            <div class="sidebar-title"><h2>Another<span> Event</span></h2></div>

                            <ul class="list catagories">
                                @foreach($other as $row)
                                    <li><a href="{{URL::to('event/'.$row->slug)}}">{{$row->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Popular Tags -->
                        <div class="widget recent-photo">
                            <div class="sidebar-title"><h2>Recent <span>Photo</span></h2></div>
                            
                            <div class="instagram">
                                @foreach($photo as $key=>$val)
                                    <figure class="img-box">
                                        <a href="{{$val->image_url}}" target="_blank">
                                            <img src="{{$val->image_url}}" alt="" style="width:83px; height:83px;">
                                        </a>
                                    </figure>
                                @endforeach
                            </div>                   
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@stop