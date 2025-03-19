<?php

namespace App\Templates;

use App\Pattern;

final class Glider implements Pattern
{
    public function getInstance(): array
    {
        return [
            [0, 1, 0],
            [0, 0, 1],
            [1, 1, 1],
        ];
    }
}
