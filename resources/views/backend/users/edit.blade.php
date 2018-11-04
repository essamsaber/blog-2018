@extends('backend.layouts.main')
@section('title', 'Edit User')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Edit User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="{{route('backend.users.index')}}">users</a></li>
            <li class="active">Edit User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

        @if(isset($userProfile))
            {!! Form::model($user, ['url' => ['backend/profile'], 'files' => true, 'method' => 'put', 'id' => 'users-form']) !!}
        @else
            {!! Form::model($user, ['route' => ['backend.users.update', $user->id], 'files' => true, 'method' => 'put', 'id' => 'users-form']) !!}
        @endif
        @include('backend.users.form')
        {!! Form::close() !!}            <!-- ./row -->

        </div>


    </section>
@endsection
@include('backend.users.script')