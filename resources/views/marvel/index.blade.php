@extends('layouts.template')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Personajes de Marvel</h1>
        <form action="{{ route('index') }}" method="GET" class="mb-4">
            <div class="flex">
                <input type="text" name="search" class="form-input w-full rounded-l-md" placeholder="Buscar por nombre">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md">Buscar</button>
            </div>
        </form>
        <div class="mx-auto table-area">
            <table class="w-full">
                <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($characters as $character)
                    <tr>
                        <td class="px-4 py-2" style="max-width: 250px;">
                            <img src="{{ $character['thumbnail']['path'] . '.' . $character['thumbnail']['extension'] }}" alt="THUMBNAIL" style="max-width: 250px; max-height: 250px;">
                        </td>
                        <td class="px-4 py-2">{{ $character['name'] }}</td>
                        <td class="px-4 py-2"><a href="{{ route('show', $character['id']) }}" class="text-blue-500">Ver detalles</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mx-auto py-8">

        <div class="flex justify-between">
            @if($offset != 0)
                <a href="{{route('index', $offset - 20)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Anterior</a>
            @else
                <a href="{{route('index', $offset - 20)}}" class="bg-blue-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed">Anterior</a>
            @endif

            @if($total >= $offset + 20)
                <a href="{{route('index', $offset + 20)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Siguiente</a>
            @else
                <a href="{{route('index', $offset + 20)}}" class="bg-blue-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed">Siguiente</a>
            @endif
        </div>
    </div>

@endsection

