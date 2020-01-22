@extends('web.template.default')

@section('content')
    {{-- <subscribe-component></subscribe-component> --}}
    <section class="page-title center">
        <div class="container">
            <h2>SUBSCRIBE</h2>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="row">
                <div class="single-column col-md-12 col-sm-12">
                    <div class="section-title">
                    </div>
                </div>    
            </div>
        </div>           
    </section>

    <section class="contact-us animated fadeIn">
        <div class="container">
            <div class="section-title center">
                <h2>Subscribe <span>Newsletter</span></h2>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-12">
                    <div class="contact-box">

                        <div id="loading"></div>
    
                        <form onsubmit="return false" id="formSubscribe" data-action="{{URL::to('proses/subscribe')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <input type="text" name="first_name" placeholder="First Name*" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <input type="text" name="last_name" placeholder="Last Name*" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <input type="email" name="email" placeholder="Email*" required>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                    <input type="text" name="phone" placeholder="Phone No" required>
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
    </section>
@endsection