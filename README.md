Base de Datos: Marvel

### 1. Usar clave API

 ```
   MARVEL_PUBLIC_KEY=tu_clave_publica_de_marvel
   MARVEL_PRIVATE_KEY=tu_clave_privada_de_marvel
   MARVEL_BASE_URL=https://gateway.marvel.com
```


- Configurar services.php para usar la clave API:
 ```
    'marvel' => ['public_key' => env('MARVEL_PUBLIC_KEY'), 
    'private_key' => env('MARVEL_PRIVATE_KEY'),
    'base_url' => env('MARVEL_BASE_URL'),
    ],
```
  

### 2. Migraciones y modelos
 Para la tabla personaje se definen los siguientes modelos:
   - id: Numero identificativo del personaje.
   - name: ombre del personaje.
   - description:descripción del personaje. Es nullable porque algunos personajes pueden no tener descripción.
   - thumbnail: Almacena la URL de la imagen del personaje.
   - resource_uri: Almacena la URI de recursos asociados al personaje.
   - comics_available, series_available, stories_available, events_available: Campos para almacenar la cantidad de cómics, series, historias y eventos disponibles para el personaje respectivamente.
   - timestamps: Campos para almacenar las fechas de creación y actualización del registro.

Para el modelo de Personaje, incluimos en $fillable todos los elementos mencionados anteriormente y protegemos los elementos created_at y updated_at.

### 3. Controlador
Se genera PersonajeController para definir las funciones con las que trabajar, serán las siguientes:

  - __construct: Donde obtenemos los credenciales desde la configuración
  - index: Se usa para la página principal. Aquí se hacen consultas en la base de datos y en la API.
  - show: se usa para una vista dinámica donde se muestra a los personajes de forma individual.
  - MakeRequest: se usa para realizar las solicitudes a la API de Marvel.

### 4. Vistas

1. index: Muestra una lista con paginación de resultados de los personajes de marvel. También incluye un buscador que filtra por el nombre de personajes.
2. show: Muestra de forma individual a un personaje de Marvel que hayamos visto en la vista index.

### 5. Adicionales
- Implementar paginación de resultados.  **(WIP)**
- Buscador, filtra por nombre de personaje.
- Al cargar personajes en la vista index, se realiza una consulta a la BD y los guarda si no están guardados.
- Si el personaje existe en la BD local o se han agotado consultas en la API, carga directamente el personaje localmente **(WIP)**
