<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CadizManager | {{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('styles/index.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

</head>
<body>
    <x-alert/>
    <header class="main-header">
        @if (auth()->user()->isAdmin())
            <div class="logo">
                CadizAdmin
            </div>
        @elseif (auth()->user()->isManager())
            <div class="logo">
                CadizManager
            </div>
        @else
            <div class="logo">Cadiz</div>
        @endif
        
        <nav class="main-nav">
            <ul>
                @if (!(auth()->user()->hasVerifiedEmail()))
                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit">Resend verification email</button>
                    </form>
                @endif
                Hello, {{  Auth::user()->name }}!
                <form action=" {{ route('auth.logout') }}" method="POST" onsubmit="return confirm('Do you really wish to logout?');">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </ul>
        </nav>
    </header>
    
    <main>
        <div>
            @if (auth()->user()->isManager())
                <x-manager.navbar></x-manager.navbar>
            @elseif (auth()->user()->isAdmin())
                <x-admin.navbar></x-admin.navbar>
            @else
            @endif
        </div>
        {{ $slot }}
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">Cadiz<br>Duck Farm</div>
            <div class="footer-links">
                <p>Made by Wonder Pets @ 2025</p>
            </div>
        </div>
    </footer>
</body>
</html>