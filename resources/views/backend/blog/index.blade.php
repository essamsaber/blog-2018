@extends('backend.layouts.main')
@section('title', 'All Blogs')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Blog <small>Display All blog posts</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="{{route('backend.blog.index')}}">Blog</a></li>
    <li class="active">All Blog</li>
    </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="pull-left">
                            <a href="{{route('backend.blog.create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create New</a>
                        </div>
                        <div class="pull-right">
                            @php
                                $links = [];
                                foreach($filterLists as $list_name => $count):
                                    $selected = $list_name == request('status') ? 'text-bold' : '';
                                    $links[] = "<a class='{$selected}' href='?status={$list_name}'>".ucfirst($list_name)."({$count})</a>";
                                endforeach;
                            @endphp

                            {!! implode(' | ', $links) !!}
                        </div>
                    </div>
                    @include('backend.partials.message')
                    @if(! $posts->count())
                        <div class="alert alert-danger">
                            <strong>No records</strong>
                        </div>
                    @else
                        <!-- /.box-header -->
                        <div class="box-body ">
                            @if($allPosts)
                                @include('backend.blog.table')
                            @else
                                @include('backend.blog.trash-table')
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                                <div class="pull-left">
                                    {{$posts->appends(request()->query())->render()}}
                                </div>
                                <div class="pull-right">
                                    <strong>
                                        <small>
                                            {{$postCount}} items
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