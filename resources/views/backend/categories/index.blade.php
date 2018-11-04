@extends('backend.layouts.main')
@section('title', 'All Categories')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Categories <small>Display All categories</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active"><a href="{{route('backend.categories.index')}}">Categories</a></li>
    </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="pull-left">
                            <a href="{{route('backend.categories.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create New</a>
                        </div>

                    </div>
                    @include('backend.partials.message')
                    @if(! $categories->count())
                        <div class="alert alert-danger">
                            <strong>No records</strong>
                        </div>
                    @else
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @include('backend.categories.table')
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                                <div class="pull-left">
                                    {{$categories->appends(request()->query())->render()}}
                                </div>
                                <div class="pull-right">
                                    <strong>
                                        <small>
                                            {{$categoriesCount}} items
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