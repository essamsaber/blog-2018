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
                {!! Form::open(['method' => 'DELETE', 'route' => ['backend.blog.destroy', $post->id]]) !!}
                <a href="{{route('backend.blog.edit', $post->id)}}" class="btn btn-xs btn-default">
                    <i class="fa fa-edit"></i>
                </a>

                <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
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