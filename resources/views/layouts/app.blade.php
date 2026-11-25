<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Talent & Showcase Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="text-lg font-bold text-gray-900">
                Campus Talent &amp; Showcase Hub
            </a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto w-full px-4 py-8 flex-1">
        @yield('content')
    </main>
</body>
</html>
