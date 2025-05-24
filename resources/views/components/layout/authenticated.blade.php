<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('styles/index.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        @if (auth()->user()->isAdmin())
            <div class="logo">CadizAdmin</div>
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