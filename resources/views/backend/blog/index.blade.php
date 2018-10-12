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
                    <div class="box-header">
                        <div class="pull-left">
                            <a href="{{route('backend.blog.create')}}" class="btn btn-success">Create New</a>
                        </div>
                    </div>
                    @if(! $posts->count())
                        <div class="alert alert-danger">
                            <strong>No records</strong>
                        </div>
                    @else
                        <!-- /.box-header -->
                        <div class="box-body ">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            <a href="#" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->author->name}}</td>
                                        <td>{{$post->category->name}}</td>
                                        <td>
                                            <abbr title="{{$post->formattedDate(true)}}">
                                                {{$post->formattedDate()}}
                                            </abbr> |
                                            {!! $post->publishedLabel() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                                <div class="pull-left">
                                    {{$posts->links()}}
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