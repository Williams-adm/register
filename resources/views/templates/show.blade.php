<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <h1 class="text-center text-xl font-semibold">@yield('title')</h1>
    </header>
            <a href="@yield('back')" class="bg-orange-300 p-2 rounded-lg">Regresar</a>
    <main>
        @yield('content')
    </main>
</body>
</html>