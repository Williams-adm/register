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
@if($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-4" id="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if($msj = Session::get('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4" id="alert">
        <p>{{$msj}}</p>
    </div>
@endif

@if($msj = Session::get('info'))
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded mb-4" id="alert">
        <p>{{$msj}}</p>
    </div>
@endif

    <header>
        <h1 class="text-center text-xl font-semibold">@yield('title')</h1>
    </header>
    <main>
        <a href="@yield('back')" class="bg-orange-300 p-2 rounded-lg">Regresar</a>
        <form action="@yield('formAction')" method="POST" class="mt-6" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @yield('formContent')
            <button type="submit" class="bg-orange-300 p-2 rounded-lg">Enviar</button>
        </form>
    </main>
    @vite('resources/js/alert.js')
</body>
</html>