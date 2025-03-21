<?php

// /////////////////////////////////////////////////////////////////////////////
// TESTING AREA
// THIS IS AN AREA WHERE YOU CAN TEST YOUR WORK AND WRITE YOUR TESTS
// /////////////////////////////////////////////////////////////////////////////

namespace Tests\Feature;

// Importo el modelo
use App\Models\Player;

class TeamControllerTest extends PlayerControllerBaseTest
{
    public function test_sample()
    {
        $requirements =
            [
                'position' => "defender",
                'mainSkill' => "speed",
                'numberOfPlayers' => 1
            ];


        $res = $this->postJson(self::REQ_TEAM_URI, $requirements);

        $this->assertNotNull($res);
    }

    // Este método prueba que el endpoint POST /api/team/process devuelva un código 200
    public function test_procesar_equipo()
    {
        // Creacion de  jugadores
        $jugador_1 = Player::create([
            'name' => 'test jugador 1',
            'position' => 'midfielder',
        ]);
        $jugador_1->skills()->createMany([
            ['skill' => 'speed', 'value' => 80],
            ['skill' => 'attack', 'value' => 60],
        ]);

        $jugador_2 = Player::create([
            'name' => 'test jugador 2',
            'position' => 'defender',
        ]);

        $jugador_2->skills()->createMany([
            ['skill' => 'strength', 'value' => 90],
            ['skill' => 'defense', 'value' => 70],
        ]);

        // Definir los requerimientos para el equipo
        $requerimientos_de_equipo = [
            [
                'position' => 'midfielder',
                'mainSkill' => 'speed',
                'numberOfPlayers' => 1
            ],
            [
                'position' => 'defender',
                'mainSkill' => 'strength',
                'numberOfPlayers' => 1
            ]
        ];

        $respuesta = $this->postJson(self::REQ_TEAM_URI, $requerimientos_de_equipo);
        // verificacion de respuesta
        $respuesta->assertStatus(200);
    }
}
