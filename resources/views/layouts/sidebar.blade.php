<div class="col-md-4">
    <aside class="right-sidebar">
        <form action="{{route('blog')}}" method="GET">
            <div class="search-widget">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" name="term" placeholder="Search for...">
                    <span class="input-group-btn">
                            <button class="btn btn-lg btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                          </span>
                </div><!-- /input-group -->
            </div>
        </form>
        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{route('blog.category', $category)}}"><i class="fa fa-angle-right"></i> {{$category->name}}</a>
                        <span class="badge pull-right">{{$category->posts->count()}}</span>
                    </li>
                   @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Popular Posts</h4>
            </div>
            <div class="widget-body">
                <ul class="popular-posts">
                    @foreach($popular_posts as $post)
                    <li>
                        <div class="post-image">
                            <a href="#">
                                <img src="{{$post->image_thumb}}" />
                            </a>
                        </div>
                        <div class="post-body">
                            <h6><a href="{{route('blog.show', $post->slug)}}">{{$post->title}}</a></h6>
                            <div class="post-meta">
                                <span>{{$post->date}}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

       <div class="widget">
           <div class="widget-heading">
                <h4>Tags</h4>
            </div>
            <div class="widget-body">
                <ul class="tags">
                    @foreach($tags as $tag)
                    <li><a href="{{route('blog.tag', $tag->slug)}}">{{$tag->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="widget">
            <div class="widget-heading">
                <h4>Categories</h4>
            </div>
            <div class="widget-body">
                <ul class="categories">
                    @foreach($archives as $archive)
                        <li>
                            <a href="{{route('blog', ['month' => $archive->month, 'year' => $archive->year])}}">
                                <i class="fa fa-archive"></i> {{$archive->month . ' ' . $archive->year}}
                            </a>
                            <span class="badge pull-right">{{$archive->post_count}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>