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
                {!! Form::open(['style' => 'display:inline-block','method' => 'PUT', 'route' => ['backend.blog.restore', $post->id]]) !!}
                <button title="Restore" class="btn btn-xs btn-default">
                    <i class="fa fa-refresh"></i>
                </button>
                {!! Form::close() !!}

                {!! Form::open(['style' => 'display:inline-block','method' => 'DELETE', 'route' => ['backend.blog.force-delete', $post->id]]) !!}
                <button title="Delete" class="btn btn-xs btn-danger" onclick="confirm('You are about to delete this post permanent. Are you sure? ')">
                    <i class="fa fa-times"></i>
                </button>
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