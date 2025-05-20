<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ asset('styles/style.css') }}" type="text/css">
</head>
<body>
    <main>
        {{ $slot }}
    </main>
</body>
</html>