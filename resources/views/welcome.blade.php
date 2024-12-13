<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #ff5722;
            font-size: 2.5rem;
            margin: 0;
        }

        h2 {
            font-size: 1.5rem;
            margin: 10px 0 30px;
            color: #555;
        }

        .options-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .option-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 15px 30px;
            border-radius: 30px;
            text-decoration: none;
            color: #fff;
            background-color: #ff7043;
            font-weight: bold;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .option-link:hover {
            transform: translateY(-5px);
            background-color: #e64a19;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #777;
        }

        footer a {
            color: #ff5722;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1 class="text-3xl text-center">Bienvenido</h1>
    <h2>Seleccione las siguientes opciones:</h2>
    <section class="options-container">
        <a href="{{ route('categories.index') }}" class="option-link">Categorías</a>
        <a href="{{ route('products.index') }}" class="option-link">Productos</a>
    </section>

    <footer>
        <p>&copy; 2024 Mi Tienda. Diseñado por <a href="#">Wilson y Williams</a>.</p>
    </footer>
</body>
</html>