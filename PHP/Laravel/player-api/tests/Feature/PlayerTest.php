<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Player;
use App\Models\PlayerSkill;

class PlayerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_player()
    {
        $response = $this->postJson('/api/player', [
            'name' => 'Test Player',
            'position' => 'midfielder',
            'playerSkills' => [
                ['skill' => 'speed', 'value' => 80],
            ],
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'name', 'position', 'playerSkills']);
    }

    public function test_list_players()
    {
        Player::create([
            'name' => 'Player1',
            'position' => 'midfielder'
        ]);

        $response = $this->getJson('/api/player');
        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    public function test_update_player()
    {
        $player = Player::create([
            'name' => 'Player1',
            'position' => 'midfielder'
        ]);

        $response = $this->putJson("/api/player/{$player->id}", [
            'name' => 'Updated Player',
            'position' => 'forward',
            'playerSkills' => [
                ['skill' => 'strength', 'value' => 90],
            ],
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Player']);
    }

    public function test_delete_player()
    {
        $player = Player::create([
            'name' => 'Player1',
            'position' => 'midfielder'
        ]);

        $token = 'SkFabTZibXE1aE14ckpQUUxHc2dnQ2RzdlFRTTM2NFE2cGI4d3RQNjZmdEFITmdBQkE=';
        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->deleteJson("/api/player/{$player->id}");

        $response->assertStatus(204);
    }

    public function test_process_team()
    {
        $player1 = Player::create([
            'name' => 'Player1',
            'position' => 'midfielder'
        ]);
        PlayerSkill::create([
            'player_id' => $player1->id,
            'skill' => 'speed',
            'value' => 90
        ]);

        $player2 = Player::create([
            'name' => 'Player2',
            'position' => 'defender'
        ]);
        PlayerSkill::create([
            'player_id' => $player2->id,
            'skill' => 'strength',
            'value' => 85
        ]);

        $player3 = Player::create([
            'name' => 'Player3',
            'position' => 'defender'
        ]);
        PlayerSkill::create([
            'player_id' => $player3->id,
            'skill' => 'strength',
            'value' => 80
        ]);

        $response = $this->postJson('/api/team/process', [
            ['position' => 'midfielder', 'mainSkill' => 'speed', 'numberOfPlayers' => 1],
            ['position' => 'defender', 'mainSkill' => 'strength', 'numberOfPlayers' => 2],
        ]);

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}