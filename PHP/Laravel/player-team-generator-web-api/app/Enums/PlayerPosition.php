<?php

namespace App\Enums;

// Definimos un enum para las posiciones de los jugadores
enum PlayerPosition: string
{
    case Defender = 'defender';
    
    case Midfielder = 'midfielder';
    
    case Forward = 'forward';
}