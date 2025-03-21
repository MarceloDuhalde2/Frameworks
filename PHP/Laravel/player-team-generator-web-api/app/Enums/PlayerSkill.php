<?php

namespace App\Enums;

// Definimos un enum para las habilidades de los jugadores
enum PlayerSkill: string
{
    case Defense = 'defense';
    
    case Attack = 'attack';
    
    case Speed = 'speed';
    
    case Strength = 'strength';
    
    case Stamina = 'stamina';
}