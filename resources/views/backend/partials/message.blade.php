@if(session('success'))
    <div class="alert alert-info">
        {{session('success')}}
    </div>
@elseif(session('failed'))
    <div class="alert alert-danger">
        {{session('failed')}}
    </div>
@elseif(session('trash-message'))
    @php
    list($message, $postId) = session('trash-message');
    @endphp
    {!! Form::open(['method' => 'PUT', 'route' => ['backend.blog.restore', $postId]]) !!}
    <div class="alert alert-info">
        {{$message}} <button class="btn btn-warning btn-sm">Undo <i class="fa fa-undo"></i></button>
    </div>
    {!! Form::close() !!}
@endif