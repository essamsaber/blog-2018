@section('styles')
    <link rel="stylesheet" href="{{asset('public/backend/plugins/tag-editor/jquery.tag-editor.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('public/backend/plugins/tag-editor/jquery.caret.min.js')}}"></script>
    <script src="{{asset('public/backend/plugins/tag-editor/jquery.tag-editor.min.js')}}"></script>
    <script>
        $(function () {
            $('.box-footer .pull-left .pagination').addClass('no-margin');
            var options = {};

            @if($post->exists)
                options = {
                initialTags: {!! json_encode($post->tags->pluck('name')) !!},
            };
            @endif
            $('input[name=post_tags]').tagEditor(options);
            $('#datetimepicker1').datetimepicker({
                showClear: true,
                format:'YYYY-MM-DD HH:mm:ss'
            });
        });

        $('#title').on('blur', function () {
            var theTitle = this.value.toLocaleLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                    .replace(/[^a-z0-9-]+/g, '-')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            slugInput.val(theSlug);
        });

        $('#save-draft').on('click', function(e){
            e.preventDefault();
            $("#published_at").val("");
            $("#blog-form").submit();
        });
        var excerpt = new SimpleMDE({element: $("#excerpt")[0]});
        var body = new SimpleMDE({element: $("#body")[0]});


    </script>
@endsection