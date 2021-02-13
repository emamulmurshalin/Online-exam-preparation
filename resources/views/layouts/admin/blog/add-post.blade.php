@extends('layouts.admin.exam')
@section('title', 'Add blog post')
@section('contents')
    <add-blog-post @if(isset($id)) selected-url="/blogs/{{ $id }}" @endif>

    </add-blog-post>
@endsection
