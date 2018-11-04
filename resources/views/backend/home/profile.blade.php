@extends('backend.layouts.main')
@section('title', 'Update profile informatioin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
            <small>Update profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
    <section class="content">
        @include('backend.partials.message')
        <div class="row">

        {!! Form::model($user, ['url' => ['backend/profile'], 'files' => true, 'method' => 'put', 'id' => 'users-form']) !!}

        @include('backend.users.form')
        {!! Form::close() !!}            <!-- ./row -->

        </div>


    </section>
@endsection
@include('backend.users.script')