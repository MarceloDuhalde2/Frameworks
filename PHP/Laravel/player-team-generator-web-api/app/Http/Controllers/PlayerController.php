<?php

// /////////////////////////////////////////////////////////////////////////////
// PLEASE DO NOT RENAME OR REMOVE ANY OF THE CODE BELOW. 
// YOU CAN ADD YOUR CODE TO THIS FILE TO EXTEND THE FEATURES TO USE THEM IN YOUR WORK.
// /////////////////////////////////////////////////////////////////////////////

namespace App\Http\Controllers;

// Importo el modelo player
use App\Models\Player;

// Importo el modelo PlayerSkill
use App\Models\PlayerSkill;

// Importo Request 
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    // Metodo para listar jugadores con sus habilidades
    public function index()
    {
        // Obtengo los jugadores
        $jugadores = Player::all();
        // Mapeo la respuesta para obtener solo los datos requeridos
        $respuesta = $jugadores->map(function ($jugador) {
            return [
                'id' => $jugador->id,
                'name' => $jugador->name,
                'position' => $jugador->position->value,
                'playerSkills' => $jugador->skills->map(function ($habilidad) {
                    return [
                        'skill' => $habilidad->skill->value,
                        'value' => $habilidad->value, 
                    ];
                })->all(), // Colección de habilidades a array
            ];
        });
        // Devuelvo la respuesta en formato JSON con código 200 (éxito)
        return response()->json($respuesta, 200);
    }

    public function show()
    {
        return response("Failed", 500);
    }

    // Metodo para almacenar un jugador en db
    public function store(Request $request)
    {
        // Validacion de datos
        $datos = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|in:defender,midfielder,forward',
            'playerSkills' => 'required|array|min:1',
            'playerSkills.*.skill' => 'required|in:defense,attack,speed,strength,stamina', 
            'playerSkills.*.value' => 'required|integer|min:0|max:100',
        ]);

        // Creo el jugador
        $jugador = Player::create([
            'name' => $datos['name'],
            'position' => $datos['position'],
        ]);

        // Se agregan todas las habilidades al jugador
        foreach ($datos['playerSkills'] as $habilidad) {
            $jugador->skills()->create($habilidad);
        }

        // formateo la respuesta
        $respuesta = [
            'id' => $jugador->id,
            'name' => $jugador->name,
            'position' => $jugador->position->value,
            'playerSkills' => $jugador->skills->map(function ($habilidad) {
                return [
                    'skill' => $habilidad->skill->value,
                    'value' => $habilidad->value,
                ];
            })->all(),
        ];

        // Devuelvo respuesta en formato json y codigo 201
        return response()->json($respuesta, 201);
    }

    // Metodo para actualizar un jugador
    public function update(Request $request, $id)
    {
        // Busco el jugador por ID
        $jugador = Player::find($id);
        
        // Validacion de datos
        $datos = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|in:defender,midfielder,forward',
            'playerSkills' => 'required|array|min:1',
            'playerSkills.*.skill' => 'required|in:defense,attack,speed,strength,stamina',
            'playerSkills.*.value' => 'required|integer|min:0|max:100',
        ]);

        // Actualizo datos del jugador
        $jugador->update([
            'name' => $datos['name'],
            'position' => $datos['position'],
        ]);

        // Elimino habilidades
        $jugador->skills()->delete();
        // Creo las habilidades con los datos nuevos
        foreach ($datos['playerSkills'] as $habilidad) {
            $jugador->skills()->create($habilidad);
        }

        // formateo la respuesta
        $respuesta = [
            'id' => $jugador->id,
            'name' => $jugador->name,
            'position' => $jugador->position->value,
            'playerSkills' => $jugador->skills->map(function ($habilidad) {
                return [
                    'skill' => $habilidad->skill->value,
                    'value' => $habilidad->value,
                ];
            })->all(),
        ];

        // Devuelvo respuesta en formato JSON y código 200
        return response()->json($respuesta, 200);
    }

    // Metodo para eliminar un jugador
    public function destroy($id)
    {
        // Obtengo el jugador por ID
        $player = Player::findOrFail($id);
        // Elimino jugador de la db
        $player->delete();
        // Devuelvo respuesta vacía y código 204
        return response()->json(null, 204);
    }

    // Este método selecciona los mejores jugadores según los requerimientos
    public function processTeam(Request $request)
    {
        // Validacion de datos
        $requerimientos = $request->validate([
            '*' => 'required|array',
            '*.position' => 'required|in:defender,midfielder,forward',
            '*.mainSkill' => 'required|in:defense,attack,speed,strength,stamina',
            '*.numberOfPlayers' => 'required|integer|min:1',
        ]);

        $resultado = [];
        // creo array para controlar los jugadores usados
        $jugadores_usados = [];

        // Recorro cada requerimiento
        foreach ($requerimientos as $req) {
            $posicion = $req['position'];
            $habilidad_principal = $req['mainSkill'];
            $numero_jugadores = $req['numberOfPlayers'];

            // Busco jugadores con la posición especificada
            $jugadores = Player::where('position', $posicion)
                            ->with('skills') 
                            ->whereNotIn('id', $jugadores_usados)
                            ->get();

            // Verifico si hay suficientes jugadores
            if ($jugadores->count() < $numero_jugadores) {
                // Si no hay, error 400
                return response()->json([
                    'message' => "Insufficient number of players for position: $posicion"
                ], 400);
            }

            // Ordeno los jugadores por la habilidad principal o habilidad maxima
            $jugadores_ordenados = $jugadores->sortByDesc(function ($jugador) use ($habilidad_principal) {
                $habilidad = $jugador->skills->firstWhere('skill', $habilidad_principal);
                // Devuelvo el valor de la habilidad o el máximo si no existe
                return $habilidad ? $habilidad->value : $jugador->skills->max('value');
            })->take($numero_jugadores);

            // Agrego los jugadores seleccionados al resultado
            foreach ($jugadores_ordenados as $jugador) {
                $jugadores_usados[] = $jugador->id;
                // Construyo respuesta
                $resultado[] = [
                    'name' => $jugador->name,
                    'position' => $jugador->position->value,
                    'playerSkills' => $jugador->skills->map(function ($habilidad) {
                        return [
                            'skill' => $habilidad->skill->value,
                            'value' => $habilidad->value,
                        ];
                    })->all(),
                ];
            }
        }

        // Devuelvo lista de jugadores seleccionados
        return response()->json($resultado, 200);
    }
}
