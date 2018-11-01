<div class="col-xs-9">
    <div class="box">
        <div class="box-body ">

            <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('Title') !!}
                {!! Form::text('name', null, ['class' => 'form-control','id' => 'name']) !!}
                @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                {!! Form::label('Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
                @if($errors->has('slug'))
                    <span class="help-block">{{$errors->first('slug')}}</span>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-header">
                <div class="box-footer clearfix">
                   @if($category->exists())
                        {!! Form::submit('Update', ['class' => 'btn btn-primary', 'id' => 'save']) !!}
                   @else
                        {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save']) !!}
                   @endif
                        {!! Form::submit('cancel', ['class' => 'btn btn-default']) !!}
                </div>
            </div>

        </div>
        <!-- /.box -->
    </div>
</div>