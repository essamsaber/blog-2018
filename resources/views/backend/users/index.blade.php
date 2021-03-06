@extends('backend.layouts.main')
@section('title', 'All Users')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Users <small>Display All Users</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active"><a href="{{route('backend.users.index')}}">Users</a></li>
    </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="pull-left">
                            <a href="{{route('backend.users.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create New</a>
                        </div>

                    </div>
                    @include('backend.partials.message')
                    @if(! $users->count())
                        <div class="alert alert-danger">
                            <strong>No records</strong>
                        </div>
                    @else
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @include('backend.users.table')
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                                <div class="pull-left">
                                    {{$users->appends(request()->query())->render()}}
                                </div>
                                <div class="pull-right">
                                    <strong>
                                        <small>
                                            {{$usersCount}} items
                                        </small>
                                    </strong>
                                </div>
                            </div>
                    @endif
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- ./row -->
    </section>
@endsection
@section('scripts')
    <script>
        $(function(){
           $('.box-footer .pull-left .pagination').addClass('no-margin');
        });
    </script>
@endsection