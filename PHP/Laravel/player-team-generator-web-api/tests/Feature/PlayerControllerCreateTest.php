<?php


// /////////////////////////////////////////////////////////////////////////////
// TESTING AREA
// THIS IS AN AREA WHERE YOU CAN TEST YOUR WORK AND WRITE YOUR TESTS
// /////////////////////////////////////////////////////////////////////////////

namespace Tests\Feature;


class PlayerControllerCreateTest extends PlayerControllerBaseTest
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

        $res = $this->postJson(self::REQ_URI, $data);

        $this->assertNotNull($res);
    }

    // Este método prueba que el endpoint POST /api/player cree un jugador en la db
    public function test_crear_jugador()
    {
        $datos = [
            'name' => 'Test Jugador',
            'position' => 'midfielder',
            'playerSkills' => [
                [   'skill' => 'speed', 
                    'value' => 80
                ],
            ],
        ];

        // Solicitud POST al endpoint
        $respuesta = $this->postJson(self::REQ_URI, $datos);

        // Verifico codigo de la respuesta
        $respuesta->assertStatus(201);
    }
}
