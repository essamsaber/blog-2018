@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('blog.messages')
                @if(!$posts->count())
                    <div class="alert alert-warning">
                        No posts !
                    </div>
                @else
                    @foreach($posts as $post)
                        <article class="post-item">
                            @if($post->image_url)
                                <div class="post-item-image">
                                    <img width="600" height="400" src="{{$post->image_url}}" alt="">
                                </div>
                            @endif
                            <div class="post-item-body">
                                <div class="padding-10">
                                    <h2><a href="{{$post->postUrl()}}">{{$post->title}}</a></h2>
                                    <p>{!! $post->excerpt_html !!}</p>
                                </div>

                                <div class="post-meta padding-10 clearfix">
                                    <div class="pull-left">
                                        <ul class="post-meta-group">
                                            <li><i class="fa fa-user"></i><a href="{{route('blog.author',$post->author)}}"> {{$post->author->name}}</a></li>
                                            <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                            <li><i class="fa fa-file"></i><a href="{{route('blog.category',$post->category)}}"> {{$post->category->name}}</a></li>
                                            <li><i class="fa fa-tags"></i>{!! $post->html_tags !!}</li>
                                            <li><i class="fa fa-comments"></i><a href="{{$post->postUrl()}}#comments">{{$post->commentsCount()}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{$post->postUrl()}}">Continue Reading &raquo;</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    <nav>
                        <ul class="pager">
                            {{$posts->appends(request()->only(["term","month","year"]))->links()}}
                        </ul>
                    </nav>
                @endif
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
