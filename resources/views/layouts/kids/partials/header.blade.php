<header class="header clearfix">
    <div class="main-header stricky bubble">
        <div class="container">
            <div class="logo pull-left">
                <a href="/">
                    <img src="{{$instansi->logo_url}}" alt="KR Logo">
                </a>
            </div>

            <div class="nav-outer">
                <div class="header-top">
                    <div class="contact">
                        <p><i class="fa fa-phone"></i> <font color="#2042DB"><b>&nbsp  {{$instansi->telp}}</b></font></p>
                    </div>
                    <div class="contact">
                        <p><a href="https://simak.kidsrepublic.sch.id/dashboard/trialreqform/"class="btn-center" target="_blank">Trial Request</a></p>
                    </div>
                    <div class="contact">
                        <p><a href="{{URL::to('page/contact')}}">Email Us</a></p>
                    </div>

                    @foreach($instansi->sosmed as $row)
                        @if($row->name == "Facebook")
                            <div class="contact">
                                <a href="{{$row->pivot->social_media_url}}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                            </div>
                        @endif

                        @if($row->name == "Instagram")
                            <div class="contact">
                                <a href="{{$row->pivot->social_media_url}}" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a>
                            </div>
                        @endif

                        @if($row->name == "Youtube")
                            <div class="contact">
                                <a href="{{$row->pivot->social_media_url}}" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                            </div>
                        @endif

                    @endforeach
                </div>
                <nav class="mainmenu-area">
                    <div class="navbar" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            
                        </div>
                        
                        <div class="navbar-collapse collapse text-center">  
                            <ul>
                                @foreach ($instansi->menu as $item)
                                    @if(count($item->child) > 0)
                                        <li class="dropdown {{ (request()->is('page/'.$item->slug.'/*')) ? 'current' : '' }}">
                                            <a href="" style="cursor: default">{{$item->menu}}</a>
                                            <ul class="submenu">
                                                @foreach($item->child as $r)
                                                    @if(count($r->child) > 0)
                                                        <li class="dropdown  {{ (request()->is('page/'.$r->slug.'/*')) ? 'current' : '' }}">
                                                            <a href="#" style="cursor: default">{{$r->menu}}</a>
                                                            <ul class="submenu">
                                                                @foreach($r->child as $k)
                                                                    @if($k->page!=null)
                                                                        <li>
                                                                            <a href="{{URL::to('page/'.$r->slug.'/'.$k->page->slug)}}">{{$k->menu}}</a>
                                                                        </li>
                                                                    @else
                                                                        <li>
                                                                            <a href="#">{{$k->menu}}</a>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @else
                                                        @if($r->page!=null)
                                                            <li class="{{ Request::path() == 'page/'.$item->slug.'/'.$r->page->slug ? 'current' : '' }}">
                                                                <a href="{{URL::to('page/'.$item->slug.'/'.$r->page->slug)}}">{{$r->menu}}</a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="#">{{$r->menu}}</a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        @if($item->menu_url == "#")
                                            @if($item->page != null)
                                                <li class="{{ Request::path() == 'page/'.$item->slug.'/'.$item->page->slug ? 'current' : '' }}">
                                                    <a href="{{URL::to('page/'.$item->slug.'/'.$item->page->slug)}}">{{$item->menu}}</a>
                                                </li>
                                            @else 
                                                <li class="#">
                                                    <a href="{{URL::to($item->menu_url)}}">{{$item->menu}}</a>
                                                </li>
                                            @endif
                                        @else
                                            <li class="{{ Request::path() == $item->menu_url ? 'current' : '' }}">
                                                <a href="{{URL::to($item->menu_url)}}">{{$item->menu}}</a>
                                            </li>
                                        @endif    
                                    @endif
                                @endforeach
                            </ul>  
                        </div> 

                    </div>
                </nav>
            </div>

        </div>
	
	<div class="ornament"></div>
	
    </div>
	<div class="socmed-samping">
        <ul class="social-icons text-center icons-design-colored icons-size-custom social-follow basel-sticky-social basel-sticky-social-right">
            @foreach($instansi->sosmed as $row)
                @if($row->name == "Facebook")
                    <li class="social-facebook">
                        <a rel="nofollow" style="background:#365493" href="{{$row->pivot->social_media_url}}" target="_blank" class="">
                            <i class="fa fa-facebook"></i>
                            <span style="background:#365493" class="basel-social-icon-name">{{$row->name}}</span>
                        </a>
                    </li>
                @endif

                @if($row->name == "Instagram")
                    <li class="social-instagram">
                        <a rel="nofollow" style="background:#774430" href="{{$row->pivot->social_media_url}}" target="_blank" class="">
                            <i class="fa fa-instagram"></i>
                            <span style="background:#774430" class="basel-social-icon-name">{{$row->name}}</span>
                        </a>
                    </li>
                @endif

                @if($row->name == "Youtube")
                    <li class="social-youtube">
                        <a rel="nofollow" style="background:#c32f2b" href="{{$row->pivot->social_media_url}}" target="_blank" class="">
                            <i class="fa fa-youtube"></i>
                            <span style="background:#c32f2b" class="basel-social-icon-name">{{$row->name}}</span>
                        </a>
                    </li>
                @endif

                @if($row->name == "Twitter")
                    <li class="social-whatsapp whatsapp-desktop">
                        <a rel="nofollow" style="background:#3CF" href="{{$row->pivot->social_media_url}}" target="_blank" class="">
                            <i class="fa fa-twitter"></i>
                            <span style="background:#3CF" class="basel-social-icon-name">{{$row->name}}</span>
                        </a>
                    </li>
                @endif

                @if($row->name == "Whatsapp")
                    <li class="social-whatsapp whatsapp-mobile">
                        <a rel="nofollow" style="background:#1EBEA5" href="{{$row->pivot->social_media_url}}" target="_blank" class="">
                            <i class="fa fa-whatsapp"></i>
                            <span style="background:#1EBEA5" class="basel-social-icon-name">{{$row->name}}</span>
                        </a>
                    </li>
                @endif

            @endforeach
        </ul>
	</div>
</header>
