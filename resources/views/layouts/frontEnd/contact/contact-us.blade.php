@extends('layouts.frontEnd.index')
@section('title', 'Contact us')
@section('content')
    @include('layouts.frontEnd.banner')
    <!-- short-->
    <div class="services-breadcrumb">
        <div class="inner_breadcrumb">
            <ul class="short_ls">
                <li>
                    <a href="/">Home</a>
                    <span>| |</span>
                </li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
    <!-- //short-->
    <exam-contact-us>

    </exam-contact-us>
@endsection