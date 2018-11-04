@extends('backend.layouts.main')
@section('title', 'Add new blog')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Blog
            <small>add new</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
            <li class="active">Add new</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
        {!! Form::model($post, ['route' => 'backend.blog.store', 'files' => true, 'method' => 'post', 'id' => 'blog-form']) !!}
        @include('backend.blog.form')
        {!! Form::close() !!}            <!-- ./row -->

        </div>


    </section>
@endsection
@include('backend.blog.script')