<div class="col-xs-9">
    <div class="box">
        <div class="box-body ">

            <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('Title') !!}
                {!! Form::text('title', null, ['class' => 'form-control','id' => 'title']) !!}
                @if($errors->has('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                @endif
            </div>

            <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                {!! Form::label('Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
                @if($errors->has('slug'))
                    <span class="help-block">{{$errors->first('slug')}}</span>
                @endif
            </div>

            <div class="form-group excerpt {{$errors->has('excerpt') ? 'has-error' : ''}}">
                {!! Form::label('excerpt') !!}
                {!! Form::textarea('excerpt', null, ['class' => 'form-control','id' => 'excerpt']) !!}
                @if($errors->has('excerpt'))
                    <span class="help-block">{{$errors->first('excerpt')}}</span>
                @endif
            </div>

            <div class="form-group body {{$errors->has('body') ? 'has-error' : ''}}">
                {!! Form::label('Body') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body']) !!}
                @if($errors->has('body'))
                    <span class="help-block">{{$errors->first('body')}}</span>
                @endif
            </div>

            <hr>


            <!-- /.box-body -->

        </div>
        <!-- /.box -->
    </div>
</div>
<div class="col-xs-3">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Publish</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('published_at') ? 'has-error' : ''}}">
                {!! Form::label('published_at', 'Published at') !!}
                <div class='input-group date' id='datetimepicker1'>
                    {!! Form::text('published_at', null, ['class' => 'form-control', 'placeholder' => 'Y-m-d H:i:s', 'id' => 'published_at']) !!}

                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

                @if($errors->has('published_at'))
                    <span class="help-block">{{$errors->first('published_at')}}</span>
                @endif
            </div>
        </div>
        <div class="box-footer clearfix">
            <div class="pull-left">
                {!! Form::submit('Save Draft', ['class' => 'btn btn-default', 'id' => 'save-draft']) !!}
            </div>
            <div class="pull-right">
                {!! Form::submit('Publish', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Category</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                {!! Form::select('category_id', \App\Category::pluck('name','id'), null,['class' => 'form-control']) !!}
                @if($errors->has('category_id'))
                    <span class="help-block">{{$errors->first('category_id')}}</span>
                @endif
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                Feature Image
            </h3>
        </div>
        <div class="box-body">
            <div class="form-group {{$errors->has('image') ? 'has-error' : ''}} text-center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="{{($post->image_thumb) ? $post->image_thumb : 'http://placehold.it/200x150&text=No-Image'}}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail"
                         style="max-width: 200px; max-height: 150px;"></div>
                    <div>
                                    <span class="btn btn-default btn-file"><span
                                                class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span> {!! Form::file('image', null, ['class' => 'form-control']) !!}
</span>
                        <a href="#" class="btn btn-default fileinput-exists"
                           data-dismiss="fileinput">Remove</a>
                    </div>
                </div>

                @if($errors->has('image'))
                    <span class="help-block">{{$errors->first('image')}}</span>
                @endif
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
</div>