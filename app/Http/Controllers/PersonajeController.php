<?php

namespace App\Http\Controllers;

use App\Models\MarvelCharacter;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PersonajeController extends Controller
{
    private mixed $publicKey;
    private mixed $privateKey;
    private mixed $baseUrl;

    public function __construct()
    {
        // Obtenemos las credenciales de la configuración
        $this->publicKey = config('services.marvel.public_key');
        $this->privateKey = config('services.marvel.private_key');
        $this->baseUrl = config('services.marvel.base_url');
    }

    public function index(Request $request, $offset=0)
    {
        // Realizar la solicitud a la API de Marvel para obtener 100 personajes de Marvel.
        $response = Http::get('https://gateway.marvel.com/v1/public/characters?offset=' . $offset . '&', [
            'apikey' => config('services.marvel.public_key'),
            'ts' => time(),
            'hash' => md5(time() . config('services.marvel.private_key') . config('services.marvel.public_key')),
            'nameStartsWith' => $request->input('search') // Utilizamos el parámetro 'nameStartsWith' para la búsqueda
        ]);

        // Decodificar la respuesta JSON
        $data = $response->json();

        // Verificar si la solicitud fue exitosa
        if ($response->ok() && $data['code'] == 200) {
            // Recuperar los personajes de la respuesta
            $characters = $data['data']['results'];

            // Iterar sobre los personajes y guardarlos en la base de datos
            foreach ($characters as $characterData) {
                // Verificar si el personaje ya existe en la base de datos
                $existingCharacter = MarvelCharacter::where('id', $characterData['id'])->first();

                if (!$existingCharacter) {
                    // Crear un nuevo registro si el personaje no existe
                    $character = new MarvelCharacter();
                    $character->id = $characterData['id'];
                    $character->name = $characterData['name'];
                    $character->description = $characterData['description'] ?? null;
                    $character->thumbnail = $characterData['thumbnail']['path'] . '.' . $characterData['thumbnail']['extension'];
                    $character->resource_uri = $characterData['resourceURI'];
                    $character->comics_available = $characterData['comics']['available'];
                    $character->series_available = $characterData['series']['available'];
                    $character->stories_available = $characterData['stories']['available'];
                    $character->events_available = $characterData['events']['available'];

                    $character->save();
                }
            }
            $total = $data['data']['total'];

            return view('marvel.index', ['characters'=>$characters, 'offset'=>$offset, 'total'=>$total]);
        } else {
            // Mostrar un mensaje de error si la solicitud no fue exitosa
            return back()->with('error', 'Error al recuperar los personajes de Marvel desde la API.');
        }
    }

    public function show($id)
    {
        // Método para mostrar detalles de un personaje específico
        $response = $this->makeRequest("/v1/public/characters/{$id}");
        $character = $response->json('data.results.0');

        return view('marvel.show', compact('character'));
    }

    private function makeRequest($endpoint)
    {
        // Método para realizar la solicitud a la API de Marvel
        $timestamp = now()->timestamp;
        $hash = md5("{$timestamp}{$this->privateKey}{$this->publicKey}");

        return Http::get("{$this->baseUrl}{$endpoint}", [
            'apikey' => $this->publicKey,
            'ts' => $timestamp,
            'hash' => $hash,
        ]);
    }
}
