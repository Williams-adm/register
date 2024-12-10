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
@if($msj = Session::get('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4" id="alert">
        <p>{{$msj}}</p>
    </div>
@endif
    <header>
        <h1 class="text-center text-xl font-semibold">@yield('title')</h1>
    </header>
    <main>
        <nav class="my-6">
            <a href="{{route('home')}}" class="bg-orange-300 p-2 rounded-lg ml-6">Regresar</a>
            <a href="@yield('buttonCreate')" class="bg-orange-300 p-2 rounded-lg ml-6">Crear</a>
        </nav>
        <section>@yield('empty')</section>
        <table>
            <thead>
                <tr>@yield('encabezadoTabla')</tr>
            </thead>
            <tbody>
                @yield('contenidoTabla')
            </tbody>
        </table>
        @yield('content')
    </main>
    @vite('resources/js/alert.js')
</body>
</html>