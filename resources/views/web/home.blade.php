@extends('layouts.kids.main')

@section('content')
    <home-kid></home-kid>

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