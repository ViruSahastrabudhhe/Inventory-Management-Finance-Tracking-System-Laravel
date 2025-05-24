@if (session('success'))
    <div>
        <ul>
            <li>{{  session('success') }}</li>
        </ul>
    </div>
@endif

@if (session('error'))
    <div>
        <ul>
            <li>{{  session('error') }}</li>
        </ul>
    </div>
@endif

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{  $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>
