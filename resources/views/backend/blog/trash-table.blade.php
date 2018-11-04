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
    <?php $request = request(); ?>
    @foreach($posts as $post)
        <tr>
            <td>
                {!! Form::open(['style' => 'display:inline-block','method' => 'PUT', 'route' => ['backend.blog.restore', $post->id]]) !!}
                @if(check_user_permission($request, 'Blog@restore', $post->id))
                <button title="Restore" class="btn btn-xs btn-default">
                    <i class="fa fa-refresh"></i>
                </button>
                @else
                    <button disabled="disabled" title="Restore" class="btn btn-xs btn-default">
                        <i class="fa fa-refresh"></i>
                    </button>
                @endif
                {!! Form::close() !!}

                {!! Form::open(['style' => 'display:inline-block','method' => 'DELETE', 'route' => ['backend.blog.force-delete', $post->id]]) !!}
                @if(check_user_permission($request, 'Blog@restore', $post->id))
                    <button title="Delete" class="btn btn-xs btn-danger" onclick="confirm('You are about to delete this post permanent. Are you sure? ')">
                        <i class="fa fa-times"></i>
                    </button>
                @else
                    <button title="Delete" class="btn btn-xs btn-danger" disabled="disabled">
                        <i class="fa fa-times"></i>
                    </button>
                @endif

                {!! Form::close() !!}

            </td>
            <td>{{$post->title}}</td>
            <td>{{$post->author->name}}</td>
            <td>{{$post->category->name}}</td>
            <td>
                <abbr title="{{$post->formattedDate(true)}}">
                    {{$post->formattedDate()}}
                </abbr> |
            </td>
        </tr>
    @endforeach
    </tbody>
</table>