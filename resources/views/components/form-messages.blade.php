@if (session('success'))
    <div>
        <ul>
            <li>{{  session('success') }}</li>
        </ul>
    </div>
@elseif (session('error'))
    <div>
        <ul>
            <li>{{ session('error') }}</li>
        </ul>
    </div>
@endif