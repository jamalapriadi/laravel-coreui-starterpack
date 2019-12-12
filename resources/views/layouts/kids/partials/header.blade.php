<header class="header clearfix">
    <div class="main-header stricky bubble">
        <div class="container">
            <div class="logo pull-left">
                <a href="/">
                    <img src="https://kidsrepublic.sch.id/resizepng/logo/logo.png/null/82/100/0" alt="KR Logo">
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

                    <div class="contact">
						<a href="https://web.facebook.com/kidsrepublicid?ref=hl" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                    </div>
					<div class="contact">
						<a href="https://www.instagram.com/kidsrepublicschool/" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a>
                    </div>
                    <div class="contact">
						<a href="https://www.youtube.com/channel/UCbLZ_IwTxCaq8TzOny9dB4w" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                    </div>
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
                                        <li class="dropdown ">
                                            <a href="" style="cursor: default">{{$item->menu}}</a>
                                            <ul class="submenu">
                                                @foreach($item->child as $r)
                                                    @if(count($r->child) > 0)
                                                        <li class="dropdown ">
                                                            <a href="#" style="cursor: default">{{$r->menu}}</a>
                                                            <ul class="submenu">
                                                                @foreach($r->child as $k)
                                                                    @if($k->page!=null)
                                                                        <li><a href="{{URL::to('page/'.$k->page->slug)}}">{{$k->menu}}</a></li>
                                                                    @else
                                                                        <li><a href="#">{{$k->menu}}</a></li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @else
                                                        @if($r->page!=null)
                                                            <li><a href="{{URL::to('page/'.$r->page->slug)}}">{{$r->menu}}</a></li>
                                                        @else
                                                            <li><a href="#">{{$r->menu}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        @if($item->menu_url == "#")
                                            @if($item->page != null)
                                                <li>
                                                    <a href="{{URL::to('page/'.$item->page->slug)}}">{{$item->menu}}</a>
                                                </li>
                                            @else 
                                                <li class="#">
                                                    <a href="{{URL::to($item->menu_url)}}">{{$item->menu}}</a>
                                                </li>
                                            @endif
                                        @else
                                            <li class="#">
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
		<ul class="social">
			<li><a href="https://web.facebook.com/kidsrepublicid?ref=hl" class="facebook" target="_blank">
                <!-- <img src="public/uploads/socmed/logofb.png" width="30px"> --><span class="fa fa-facebook-square fa-2x"></span></a>
            </li>
			<li><a href="https://www.instagram.com/kidsrepublicschool/" class="instagram" target="_blank"><span class="fa fa-instagram fa-2x"></span></a></li>
			<li><a href="https://www.youtube.com/channel/UCbLZ_IwTxCaq8TzOny9dB4w" class="youtube" target="_blank"><span class="fa fa-youtube-square fa-2x"></span></a></li>
		</ul>
	</div>
</header>
