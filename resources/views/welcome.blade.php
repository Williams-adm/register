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
    <h1 class="text-3xl text-center">Bienvenido</h1>
    <h2>Seleccione las siguientes opciones:</h2>
    <section class="flex justify-center mt-4">
        <a href="{{ route('categories.index') }}" class="mr-10 bg-orange-300 p-2 rounded-lg">Categorías</a>
        <a href="{{ route('products.index') }}" class="bg-orange-300 p-2 rounded-lg">Productos</a>
    </section>
</body>
</html>