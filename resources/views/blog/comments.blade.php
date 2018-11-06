<article class="post-comments" id="comments">
    <h3><i class="fa fa-comments"></i> {{$post->commentsCount()}}</h3>

    <div class="comment-body padding-10">
        <ul class="comments-list">
            @foreach($comments as $comment)
                <li class="comment-item" id="comment-{{$comment->id}}">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>{{$comment->author_name}} <small>{{$comment->date}}</small></h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>{!! $comment->html_body !!}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        {{$comments->appends(request()->query('post'))->links()}}
    </div>

    <div class="comment-footer padding-10">
        <h3>Leave a comment</h3>
      <form method="POST" action="{{route('blog.post-comment', $post->slug)}}">
          {{csrf_field()}}
          {{method_field('POST')}}
            <div class="form-group required {{$errors->has('author_name') ? 'has-error' : ''}}">
                <label for="name">Name</label>
                <input required type="text" name="author_name" id="name" class="form-control">
                @if($errors->has('author_name'))
                    <span class="has-block">
                        <strong>{{$errors->first('author_name')}}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group required {{$errors->has('author_email') ? 'has-error' : ''}}">
                <label for="email">Email</label>
                <input required type="text" name="author_email" id="email" class="form-control">
                @if($errors->has('author_email'))
                    <span class="has-block">
                        <strong>{{$errors->first('author_email')}}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group required {{$errors->has('body') ? 'has-error' : ''}}">
                <label for="comment">Comment</label>
                <textarea required name="body" id="comment" rows="6" class="form-control"></textarea>
                @if($errors->has('body'))
                    <span class="has-block">
                        <strong>{{$errors->first('body')}}</strong>
                    </span>
                @endif
            </div>
            <div class="clearfix">
                <div class="pull-left">
                    <input type="submit" class="btn btn-lg btn-success" value="Comment">
                </div>
                <div class="pull-right">
                    <p class="text-muted">
                        <span class="required">*</span>
                        <em>Indicates required fields</em>
                    </p>
                </div>
            </div>
        </form>
    </div>

</article>