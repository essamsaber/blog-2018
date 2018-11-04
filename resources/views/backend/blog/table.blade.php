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
        <?php $request = request(); ?>
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['backend.blog.destroy', $post->id]]) !!}
                @if(check_user_permission($request, 'Blog@edit', $post->id))
                <a href="{{route('backend.blog.edit', $post->id)}}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>
                @else
                    <a href="#" disabled="disabled" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>
                @endif
                @if(check_user_permission($request, 'Blog@edit', $post->id))
                    <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                @else
                    <button disabled="disabled" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
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
                {!! $post->publishedLabel() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>