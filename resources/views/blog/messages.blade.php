
@if(isset($category_name))
    <div class="alert alert-info">
        <strong>{{$category_name}}</strong>
    </div>
@endif
@if(isset($author_name))
    <div class="alert alert-info">
        <strong>{{$author_name}}</strong>
    </div>
@endif
@if(isset($tag_name))
    <div class="alert alert-info">
        <strong>Tag: </strong><i>{{$tag_name}}</i>
    </div>
@endif
@if(request('term') != '')
    <div class="alert alert-info">
        <strong>{{request('term')}}</strong>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        <strong>{{session('success')}}</strong>
    </div>
@endif
