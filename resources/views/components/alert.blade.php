@if (session('success'))
    <div>
        <script>
            alert("{{ session('success') }}")
        </script>
    </div>
@endif

@if (session('error'))
    <div>
        <script>
            alert("{{ session('error') }}")
        </script>
    </div>
@endif

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <script>
                alert("{{ $error }}")
            </script>
        @endforeach
    </div>
@endif

<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>
