<?php

// /////////////////////////////////////////////////////////////////////////////
// TESTING AREA
// THIS IS AN AREA WHERE YOU CAN TEST YOUR WORK AND WRITE YOUR TESTS
// /////////////////////////////////////////////////////////////////////////////

namespace Tests\Feature;

// Importamos el modelo Player para crear datos de prueba
use App\Models\Player;

class PlayerControllerListingTest extends PlayerControllerBaseTest
{
    public function test_sample()
    {
        $res = $this->get(self::REQ_URI);

        $this->assertNotNull($res);
    }

    // Este método prueba que el endpoint GET /api/player devuelva la lista correctamente
    public function test_listar_jugadores()
    {
        // Creo 2 jugadores de prueba
        Player::create([
            'name' => 'Jugador prueba 1',
            'position' => 'midfielder',
        ]);

        Player::create([
            'name' => 'Jugador prueba 2',
            'position' => 'forward',
        ]);

        // Solicitud GET al endpoint
        $respuesta = $this->getJson(self::REQ_URI);

        // Verificar estado de la respuesta
        $respuesta->assertStatus(200);
        // Verificar que la respuesta contenga dos jugadores
        $respuesta->assertJsonCount(2);
        // Verificar la estructura de la respuesta
        $respuesta->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'position',
                'playerSkills',
            ],
        ]);
        // Verificar nombre del primer jugador en la respuesta
        $respuesta->assertJsonFragment(['name' => 'Jugador prueba 1']);
        // Verificar nombre del segundo jugador en la respuesta
        $respuesta->assertJsonFragment(['name' => 'Jugador prueba 2']);
        // Verificar que las posiciones sean correctas
        $respuesta->assertJsonFragment(['position' => 'midfielder']);
        $respuesta->assertJsonFragment(['position' => 'forward']);
    }

}
