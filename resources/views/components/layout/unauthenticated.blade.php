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
        <div class="logo">Cadiz</div>
        <nav class="main-nav">
            <ul>
                {{ $navlinks }}
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

    <script>
        const authSection = document.getElementById("auth-section")
        function scrollToAuth() {
            authSection.scrollIntoView({
                behavior: "smooth"
            });
        }
    </script>
</body>
</html>