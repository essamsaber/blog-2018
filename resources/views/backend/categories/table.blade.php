<table class="table table-bordered">
    <thead>
    <tr>
        <th>Action</th>
        <th>Title</th>
        <th>Posts Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['backend.categories.destroy', $category->id]]) !!}
                @if($category->id != config('cms.default_category_id'))
                    <a href="{{route('backend.categories.edit', $category->id)}}" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>

                    <button onclick="return confirm('You are about to delete a whole category!. Are you sure ?')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                    {!! Form::close() !!}
                @endif
            </td>
            <td>{{$category->name}}</td>
            <td>{{$category->posts->count()}}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>