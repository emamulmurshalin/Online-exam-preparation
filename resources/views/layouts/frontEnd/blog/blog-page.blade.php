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
                <li>Blog page</li>
            </ul>
        </div>
    </div>
    <!-- //short-->
    <app-blog-page>

    </app-blog-page>
@endsection
