<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PlayerSkill;

class PlayerSkillFactory extends Factory
{
    protected $model = PlayerSkill::class;

    public function definition()
    {
        return [
            'player_id' => Player::factory(),
            'skill' => $this->faker->randomElement(['defense', 'attack', 'speed', 'strength', 'stamina']),
            'value' => $this->faker->numberBetween(0, 100),
        ];
    }
}