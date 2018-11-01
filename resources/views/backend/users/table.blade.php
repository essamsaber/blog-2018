<table class="table table-bordered">
    <thead>
    <tr>
        <th>Action</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
                @if($user->id != config('cms.default_user_id'))
                    <a href="{{route('backend.users.edit', $user->id)}}" class="btn btn-xs btn-default">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="{{route('backend.users.confirm-delete', $user->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                @endif
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->posts->count()}}</td>
            <td>-</td>
            
        </tr>
    @endforeach
    </tbody>
</table>