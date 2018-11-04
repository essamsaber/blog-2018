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
            <div class="-col-xs-9">
                <div class="box">
                    {!! Form::model($user, ['route' => ['backend.users.destroy', $user->id], 'files' => true, 'method' => 'delete', 'id' => 'users-form']) !!}
                    <div class="box-body">
                        <p>You have specified this user for delete:</p>
                        <p>
                            ID #{{$user->id}}: {{$user->name}}
                        </p>
                        <p>
                            What should be done with content own by this user?
                        </p>
                        <p>
                            <input type="radio" checked name="delete_option" value="delete"> Delete All Content
                        </p>
                        <p>
                            <input type="radio" name="delete_option" value="attribute"> Attribute content to another user
                            {!! Form::select('selected_user', $users) !!}
                        </p>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                        <a href="{{route('backend.users.index')}}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </section>
@endsection
@include('backend.users.script')