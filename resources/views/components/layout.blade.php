<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskForge</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 min-h-screen">
    <header class="flex justify-center">
        <div class="w-full max-w-7xl px-4">
            @guest
                <x-navbar />
            @endguest
        </div>
    </header>

    <main class="flex justify-center mt-6">
        <div class="w-full max-w-7xl px-4">
            {{ $slot }}
        </div>
    </main>
</body>