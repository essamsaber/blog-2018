@extends('backend.layouts.main')
@section('title', 'Create User')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Create User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{route('backend.users.index')}}">users</a></li>
            <li class="active">Create User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
        {!! Form::model($user, ['route' => ['backend.users.store'], 'files' => true, 'method' => 'post', 'id' => 'users-form']) !!}
        @include('backend.users.form')
        {!! Form::close() !!}            <!-- ./row -->

        </div>


    </section>
@endsection
@include('backend.users.script')