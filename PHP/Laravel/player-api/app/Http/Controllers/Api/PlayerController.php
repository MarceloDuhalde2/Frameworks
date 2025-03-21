<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerSkill;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        return Player::with('playerSkills')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|in:defender,midfielder,forward',
            'playerSkills' => 'required|array|min:1',
            'playerSkills.*.skill' => 'required|in:defense,attack,speed,strength,stamina',
            'playerSkills.*.value' => 'required|integer|min:0|max:100',
        ]);

        $player = Player::create([
            'name' => $data['name'],
            'position' => $data['position'],
        ]);

        $skills = [];
        foreach ($data['playerSkills'] as $skill) {
            $skills[] = $player->playerSkills()->create($skill)->toArray();
        }

        $response = [
            'id' => $player->id,
            'name' => $player->name,
            'position' => $player->position,
            'playerSkills' => $skills, // Usamos 'playerSkills' en lugar de 'player_skills'
        ];

        return response()->json($response, 201);
    }

    public function update(Request $request, Player $player)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|in:defender,midfielder,forward',
            'playerSkills' => 'required|array|min:1',
            'playerSkills.*.skill' => 'required|in:defense,attack,speed,strength,stamina',
            'playerSkills.*.value' => 'required|integer|min:0|max:100',
        ]);

        $player->update([
            'name' => $data['name'],
            'position' => $data['position'],
        ]);

        $player->playerSkills()->delete();
        foreach ($data['playerSkills'] as $skill) {
            $player->playerSkills()->create($skill);
        }

        return Player::with('playerSkills')->find($player->id);
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json(null, 204);
    }

    public function processTeam(Request $request)
    {
        $requirements = $request->validate([
            '*' => 'required|array',
            '*.position' => 'required|in:defender,midfielder,forward',
            '*.mainSkill' => 'required|in:defense,attack,speed,strength,stamina',
            '*.numberOfPlayers' => 'required|integer|min:1',
        ]);

        $result = [];
        $usedPlayers = [];

        foreach ($requirements as $req) {
            $position = $req['position'];
            $mainSkill = $req['mainSkill'];
            $numPlayers = $req['numberOfPlayers'];

            $players = Player::where('position', $position)
                ->with('playerSkills')
                ->whereNotIn('id', $usedPlayers)
                ->get();

            if ($players->count() < $numPlayers) {
                return response()->json([
                    'message' => "Insufficient number of players for position: $position"
                ], 400);
            }

            $sorted = $players->sortByDesc(function ($player) use ($mainSkill) {
                $skill = $player->playerSkills->firstWhere('skill', $mainSkill);
                return $skill ? $skill->value : $player->playerSkills->max('value');
            })->take($numPlayers);

            foreach ($sorted as $player) {
                $usedPlayers[] = $player->id;
                $result[] = [
                    'name' => $player->name,
                    'position' => $player->position,
                    'playerSkills' => $player->playerSkills->map(function ($skill) {
                        return [
                            'skill' => $skill->skill,
                            'value' => $skill->value,
                        ];
                    })->all(),
                ];
            }
        }

        return response()->json($result, 200);
    }
}