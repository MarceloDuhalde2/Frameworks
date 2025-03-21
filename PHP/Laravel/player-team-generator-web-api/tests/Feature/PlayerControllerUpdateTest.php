<?php

// /////////////////////////////////////////////////////////////////////////////
// TESTING AREA
// THIS IS AN AREA WHERE YOU CAN TEST YOUR WORK AND WRITE YOUR TESTS
// /////////////////////////////////////////////////////////////////////////////

namespace Tests\Feature;

// importo el modelo
use App\Models\Player;

class PlayerControllerUpdateTest extends PlayerControllerBaseTest
{
    public function test_sample()
    {
        $data = [
            "name" => "test",
            "position" => "defender",
            "playerSkills" => [
                0 => [
                    "skill" => "attack",
                    "value" => 60
                ],
                1 => [
                    "skill" => "speed",
                    "value" => 80
                ]
            ]
        ];

        $res = $this->putJson(self::REQ_URI . '1', $data);

        $this->assertNotNull($res);
    }

    // Este método prueba que el endpoint PUT /api/player/{id} actualice un jugador y devuelva estado 200
    public function test_actualizar_jugador()
    {
        // Crea un jugador de prueba para tener algo que actualizar
        $jugador = Player::create([
            'name' => 'Jugador Prueba',
            'position' => 'midfielder',
        ]);

        // Define los datos actualizados para el jugador
        $datos_actualizados = [
            'name' => 'Jugador Actualizado',
            'position' => 'forward',
            'playerSkills' => [
                ['skill' => 'strength', 'value' => 90],
            ],
        ];

        // Se hace solicitud Put con el id del jugador y los datos actualizados
        $respuesta = $this->putJson(self::REQ_URI . $jugador->id, $datos_actualizados);

        // Se verifica respuesta con código 200
        $respuesta->assertStatus(200);
    }
}
