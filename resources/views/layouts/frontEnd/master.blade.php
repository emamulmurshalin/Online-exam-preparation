@extends('layouts.frontEnd.index')
@section('title', 'Add blog post')
@section('content')
    <!-- banner -->
    @include('layouts.frontEnd.includes.banner')
    <!--//banner -->
    <!-- about -->
    @include('layouts.frontEnd.includes.about-our')
    <!-- //about -->
    <!-- services -->
    @include('layouts.frontEnd.includes.our-service')
    <!-- //services -->

    <!-- //news -->
    <!-- middle section -->
    @include('layouts.frontEnd.includes.our-course')
    <!-- //middle section -->
    <!-- testimonials -->
    @include('layouts.frontEnd.includes.testimonial')
    <!-- //testimonials -->
@endsection