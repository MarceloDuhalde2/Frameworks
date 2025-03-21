<?php

// /////////////////////////////////////////////////////////////////////////////
// TESTING AREA
// THIS IS AN AREA WHERE YOU CAN TEST YOUR WORK AND WRITE YOUR TESTS
// /////////////////////////////////////////////////////////////////////////////

namespace Tests\Feature;

// importo el modelo
use App\Models\Player;

class PlayerControllerDeleteTest extends PlayerControllerBaseTest
{

    public function test_sample()
    {
        $res = $this->delete(self::REQ_URI . '1');

        $this->assertNotNull($res);
    }

    // Este método prueba que el endpoint DELETE /api/player/{id} devuelva 401 sin token y 204 con token válido
    public function test_eliminar_jugador()
    {
        // Creamos un jugador de prueba
        $jugador = Player::create([
            'name' => 'Jugador Prueba',
            'position' => 'midfielder',
        ]);

        // PRIMER CASO: Verificamos que devuelva 401 sin token
        $respuesta_sin_token = $this->delete(self::REQ_URI . $jugador->id);
        $respuesta_sin_token->assertStatus(401);
        $respuesta_sin_token->assertJson(['message' => 'Unauthorized']);

        // SEGUNDO CASO: Verificamos que devuelva 204 con token válido
        $token = 'SkFabTZibXE1aE14ckpQUUxHc2dnQ2RzdlFRTTM2NFE2cGI4d3RQNjZmdEFITmdBQkE=';
        $respuesta_con_token = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                                ->delete(self::REQ_URI . $jugador->id);
        $respuesta_con_token->assertStatus(204);
    }
}
