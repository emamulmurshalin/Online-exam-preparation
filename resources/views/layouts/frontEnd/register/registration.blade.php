@extends('layouts.frontEnd.index')
@section('title', 'Model test')
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
                <li>Registration</li>
            </ul>
        </div>
    </div>
    <!-- //short-->
    <app-registration>

    </app-registration>
@endsection
