<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['name', 'position'];

    public function playerSkills()
    {
        return $this->hasMany(PlayerSkill::class);
    }
}
