@extends('backend.layouts.main')
@section('title', 'Edit Post')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blog
            <small>Edit post</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
            <li class="active">Edit Post</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
        {!! Form::model($post, ['route' => ['backend.blog.update', $post->id], 'files' => true, 'method' => 'put', 'id' => 'blog-form']) !!}
        @include('backend.blog.form')
        {!! Form::close() !!}            <!-- ./row -->

        </div>


    </section>
@endsection
@include('backend.blog.script')