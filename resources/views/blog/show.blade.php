@extends('layouts.main')

@section('content')
    @php $author = $post->author; @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">
                    @if($post->image_url)
                        <div class="post-item-image">
                            <a href="#">
                                <img src="{{$post->image_url}}" alt="{{$post->title}}">
                            </a>
                        </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{$post->title}}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('blog.author', $author)}}"> {{$author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                    <li><i class="fa fa-folder"></i><a href="#"> {{$post->category->name}}</a></li>
                                    <li><i class="fa fa-tags"></i>{!! $post->html_tags !!}</li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            {!! $post->body_html !!}

                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                        <div class="media-left">
                            <a href="{{route('blog.author', $author)}}">
                                <img alt="Author 1" src="{{asset('public/img/author.jpg')}}" class="media-object">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{route('blog.author', $author)}}">{{$author->name}}</a></h4>
                            <div class="post-author-count">
                                <a href="{{route('blog.author', $author)}}">
                                    <i class="fa fa-clone"></i>
                                    @php $posts_count = $author->posts()->published()->count() @endphp
                                    {{$posts_count}} {{str_plural('post', $posts_count)}}
                                </a>
                            </div>
                            <p>{!! $author->bio_html !!}</p>
                        </div>
                    </div>
                </article>

               {{--Comments here--}}
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
