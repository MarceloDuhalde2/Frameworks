<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerSkill extends Model
{
    protected $fillable = ['player_id', 'skill', 'value'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
