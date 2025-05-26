@if (session('success'))
    <div>
        <script>
            swal("{{session('success')}}", {
                icon: "success",
                buttons: {
                confirm: {
                    className: "btn btn-success",
                    },
                },
            });
        </script>
    </div>
@endif

@if (session('error'))
    <div>
        <script>
            swal("{{session('error')}}", {
                icon: "error",
                buttons: {
                confirm: {
                    className: "btn btn-danger",
                    },
                },
            });
        </script>
    </div>
@endif

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <script>
            swal("{{session('error')}}", {
                icon: "error",
                buttons: {
                confirm: {
                    className: "btn btn-danger",
                    },
                },
            });
        @endforeach
    </div>
@endif
