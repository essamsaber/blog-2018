@section('scripts')
    <script>
        $(function () {
            $('.box-footer .pull-left .pagination').addClass('no-margin');

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