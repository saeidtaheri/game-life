<?php

namespace App;

final class Printer
{
    public static function printGrid(int $xx, int $yy, array $aliveCells): void
    {
        for ($y = 0; $y < $yy; $y++) {
            for ($x = 0; $x < $xx; $x++) {
                echo isset($aliveCells["$x,$y"]) ? '■ ' : '□ ';
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }

    public static function removeGrid(): void
    {
        system('clear');
    }
}