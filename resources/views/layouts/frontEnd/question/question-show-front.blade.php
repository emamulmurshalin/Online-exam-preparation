@extends('layouts.frontEnd.index')
@section('title', 'Question')
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
                <li>Previous question</li>
            </ul>
        </div>
    </div>
    <!-- //short-->
    <exam-question>

    </exam-question>
@endsection