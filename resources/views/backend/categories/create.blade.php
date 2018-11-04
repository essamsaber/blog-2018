@extends('backend.layouts.main')
@section('title', 'Create Category')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small>Create Category</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{route('backend.categories.index')}}">categories</a></li>
            <li class="active">Create Category</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
        {!! Form::model($category, ['route' => ['backend.categories.store'], 'files' => true, 'method' => 'post', 'id' => 'categories-form']) !!}
        @include('backend.categories.form')
        {!! Form::close() !!}            <!-- ./row -->

        </div>


    </section>
@endsection
@include('backend.categories.script')