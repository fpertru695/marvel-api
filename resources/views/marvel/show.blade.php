@extends('layouts.template')

@section('content')
    <div class="container mx-auto py-8">
        <div class="table-area bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <h1 class="text-3xl font-bold mb-4">Detalles del personaje</h1>
            <table class="min-w-full divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap" style="max-width: 250px; height: 250px">
                        <img src="{{ $character['thumbnail']['path'] . '.' . $character['thumbnail']['extension'] }}" alt="THUMBNAIL" class="w-48 h-48">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <h2 class="text-xl font-bold">{{ $character['name'] }}</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="px-6 py-4 whitespace-nowrap">
                        <p><strong>Descripción:</strong>
                            @empty($character['description'])
                                &nbsp;&nbsp;&nbsp;&nbsp; información desconocida o clasificada
                            @else
                                {{ $character['description'] }}
                            @endempty</p>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><strong>Cómics disponibles:</strong></td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $character['comics']['available'] }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><strong>Series disponibles:</strong></td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $character['series']['available'] }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><strong>Historias disponibles:</strong></td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $character['stories']['available'] }}</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><strong>Eventos disponibles:</strong></td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $character['events']['available'] }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
