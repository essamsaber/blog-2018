@extends('backend.main')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body ">
                        <h3>Welcome to MyBlog!</h3>
                        <p class="lead text-muted">Hallo User, Welcome to MyBlog</p>

                        <h4>Get started</h4>
                        <p><a href="{{route('backend.blog.create')}}" class="btn btn-primary">Write your first blog post</a> </p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- ./row -->
    </section>
@endsection
