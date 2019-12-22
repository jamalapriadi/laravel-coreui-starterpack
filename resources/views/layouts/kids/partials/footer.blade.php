<section class="footer-style-2">
    <div class="container">
        <div class="footer-upper">
            <div class="row">
                <div class="col-lg-6 col-sm-5 col-xs-5 column">
                    <div class="footer-widget-about">
                        <div class="column-title">
                            <h2>Contact Us</h2>
                        </div>
                        <div class="content">
                            <ul>
                                @foreach($instansi->kontak as $row)
                                    <li>
                                        @if($row->show_name == "Y")
                                            <a>
                                                <h4 style="color:#ffffff">
                                                    <font color="#ffffff">{{$row->parameter_name}} :</font>
                                                </h4>
    
                                                <font color="#ffffff">{{$row->parameter_value}}</font>
    
                                            </a>
                                        @else 
                                            @if($row->icon=="telp")
                                                <span style="color:#ffffff" class="icon-technology-2"></span>
                                                <a>
                                                    <font color="#ffffff">{{$row->parameter_value}}</font>
                                                </a>
                                            @endif
    
                                            @if($row->icon=="email")
                                                <span style="color:#ffffff" class="icon-interface"></span>
                                                <a href="mailto:{{$row->parameter_value}}?subject=Web%20Visitor" target="_top">
                                                    <font color="#ffffff">{{$row->parameter_value}}</font>
                                                </a>
                                            @endif
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 col-sm-3 col-xs-3">
                    <div class="links-column">
                        <div class="column-title">
                            <h2>Useful Links</h2>
                        </div>
                        <ul>
                            <li><a href="{{URL::to('page/kids-republic')}}"><font color="#ffffff">About Us</font></a></li>
                            <li><a href="{{URL::to('page/our')}}"><font color="#ffffff">Programmes</font></a></li>
                            <li><a href="{{URL::to('page/gallery')}}"><font color="#ffffff">Gallery</font></a></li>                            
                            <li><a href="{{URL::to('page/newsletter')}}"><font color="#ffffff">Newsletter</font></a></li>
                            <li><a href="{{URL::to('page/contact')}}"><font color="#ffffff">Contact Us</font></a></li>
                            <li><a href="https://simak.kidsrepublic.sch.id/"><font color="#ffffff">SIMAK</font></a></li>
                            <li><a href="{{URL::to('page/career')}}"><font color="#ffffff">Career</font></a></li>
                        </ul>
                    </div>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="links-column">
                        <div class="column-title">
                            <h2>Subscribe</h2>
                            <p><font color="#ffffff">for update newsletter:</font></p>
                        </div>
                        <ul>
                            <li><a href="{{URL::to('subscribe')}}"><button type="button" class="thm-btn thm-blue-bg btn-style-one">Subscribe</button></a></li>
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
        <div class="coppy-right clearfix">
            <div class="pull-left">
                <i><font color="#ffffff">Copyright © Kids Republic {{date('Y')}}</i>
            </div>
        </div>
    </div>
</section>

<div class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></div>