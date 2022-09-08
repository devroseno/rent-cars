<?php

namespace App\Enums;

enum CarStatus: int
{
    case Available = 1;
    case Occupied = 2;

    public function getLabel()
    {
        return match(this)
        {
            CarStatus::Available => [
                'background' => 'sucess',
                'name' => 'Disponível',
            ],

            CarStatus::Occupied => [
                'background' => 'warning',
                'name' => 'Ocupado'
            ]
        };
    }
}