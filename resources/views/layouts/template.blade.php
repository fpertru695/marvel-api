<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personajes de Marvel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-image: url('{{ asset('img/bg.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .table-area {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
    }
</style>
<body class="bg-gray-100 flex flex-col justify-between h-screen">

<header class="bg-gray-800 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('index') }}" class="text-xl font-bold">Página Principal</a>
        <img src="{{ asset('img/marvel_logo.png') }}" alt="Marvel Logo" class="ml-2 h-8">
        <a href="{{ route('login') }}" class="text-xl font-bold">Login</a>
    </div>
</header>

@yield('content')

<footer class="bg-gray-800 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="bg-gray-800 p-2">
            <img src="{{ asset('img/marvel_logo.png') }}" alt="Deadpool GIF" class="h-12">
        </div>
        <div class="text-center">
            <p>Enlaces de interés:</p>
            <a href="https://developer.marvel.com/" class="text-blue-500">Página web oficial de la API de Marvel</a>
        </div>
        <div class="bg-gray-800 p-2">
            <img src="{{ asset('img/spoderman.webp') }}" alt="Spiderman GIF" class="h-12">
        </div>
    </div>
</footer>
</body>
</html>
