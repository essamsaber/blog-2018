<div class="col-xs-9">
    <div class="box">
        <div class="box-body ">

            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control','id' => 'name']) !!}
                @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('Email') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                @if($errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                @endif
            </div>

            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                @if($errors->has('password'))
                    <span class="help-block">{{$errors->first('password')}}</span>
                @endif
            </div>

            <div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                {!! Form::label('Password Confirmation') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
                @if($errors->has('password_confirmation'))
                    <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                @endif
            </div>

            <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                {!! Form::label('Role') !!}
                @if(auth()->id() == $user->id && auth()->id() == config('cms.default_user_id') || isset($userProfile))
                    <p class="form-control-static">{{$user->role_name}}</p>
                    {!! Form::hidden('role', auth()->user()->roles()->first()->id) !!}
                @else
                    {!! Form::select('role',\App\Role::pluck('name', 'id'),$user->exists ? $user->roles->first()->id: null , ['class' => 'form-control', 'id' => 'role']) !!}
                @endif
                @if($errors->has('role'))
                    <span class="help-block">{{$errors->first('role')}}</span>
                @endif
            </div>

            <!-- /.box-body -->
            <div class="box-header">
                <div class="box-footer clearfix">
                   @if($user->exists)
                        {!! Form::submit('Update', ['class' => 'btn btn-primary', 'id' => 'save']) !!}
                   @else
                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save']) !!}
                   @endif
                       <a class="btn btn-default" href="{{route('backend.users.index')}}"><i class="fa fa-arrow-circle-left"> Back</i></a>
                </div>
            </div>

        </div>
        <!-- /.box -->
    </div>
</div>