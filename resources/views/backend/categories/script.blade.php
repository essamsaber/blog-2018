@section('scripts')
    <script>
        $(function () {
            $('.box-footer .pull-left .pagination').addClass('no-margin');

        });

        $('#name').on('blur', function () {
            var theTitle = this.value.toLocaleLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                    .replace(/[^a-z0-9-]+/g, '-')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            slugInput.val(theSlug);
        });


    </script>
@endsection