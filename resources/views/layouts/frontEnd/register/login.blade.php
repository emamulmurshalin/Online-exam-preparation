@extends('layouts.frontEnd.index')
@section('title', 'Login page')
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
                <li>Login</li>
            </ul>
        </div>
    </div>
    <!-- //short-->
    <app-login>

    </app-login>
@endsection
