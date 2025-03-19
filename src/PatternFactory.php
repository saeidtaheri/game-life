<?php

namespace App;

use App\Templates\Glider;

final class PatternFactory
{
    public static function create(PatternType $patternType): Pattern
    {
        return match ($patternType) {
            PatternType::GLIDER => new Glider(),
        };
    }
}