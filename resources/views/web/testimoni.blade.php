@extends('web.template.main')

@section('content')
    <section class="page-title center">
        <div class="container">
            <h2>About Us</h2>
        </div>
    </section>

    <section class="two-column style-3 animated fadeIn" id="testimony">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 testimonial">
                    <div class="section-title">
                        <h2>Parent<span>&nbsp;Testimonial</span></h2>
                    </div>
                    <div class="slider">
                        @foreach($testimoni as $key=>$val)
                            <div class="item center">
                                <img src="{{$val->feature_image_url}}" alt="images">
                                <div class="img-ifo">
                                    <div class="text">
                                        {!! $val->description !!}
                                    </div>
                                    <div class="link">
                                        <a href="javascript:void(0)" class="btn-style-one">{{$val->title}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $( window ).on( "load", function() {
            $('.slider').owlCarousel({
                loop: true,
                items: true,
                nav: false,
                dots: true,
                autoplay:true
            });
        });
    </script>
@stop