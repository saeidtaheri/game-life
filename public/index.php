<?php
require __DIR__.'/../vendor/autoload.php';

use App\Exceptions\InvalidPatternException;
use App\Game;
use App\PatternFactory;
use App\PatternType;

if (!isset($argv[1])) {
    throw new InvalidPatternException();
}
$patternTemplate = $argv[1];
$pattern = PatternFactory::create(PatternType::from(strtoupper($patternTemplate)));
$game = new Game(25, 25, $pattern->getInstance(), 11, 11);

if (isset($argv[2]) && is_numeric($argv[2]) && $argv[2] > 0) {
    $game = $game->setTimeout((int)$argv[2]);
}

$game->play();