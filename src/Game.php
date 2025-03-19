<?php

namespace App;

final class Game
{
    private const int DEFAULT_TIMEOUT = 60;
    private array $aliveCells = [];
    private ?int $timeout = null;

    public function __construct(
        public int   $gridX,
        public int   $gridY,
        public array $pattern,
        public int   $PatternX,
        public int   $PatternY,
    )
    {
        $this->seed($pattern, $PatternX, $PatternY);
    }

    public function play(): void
    {
        $endTime = $this->calculateTerminationTime();

        $iteration = 0;
        while (time() < $endTime) {
            Printer::removeGrid();
            Printer::printGrid($this->gridX, $this->gridY, $this->aliveCells);
            echo "Iteration: $iteration\n";
            if ($this->hasReachedEdge()) {
                $this->replay();
                continue;
            }
            $this->move();
            $iteration++;
            usleep(400000);
        }
    }

    public function setTimeout(int $time): self
    {
        $this->timeout = $time;
        return $this;
    }

    private function seed(array $pattern, int $xx, int $yy): void
    {
        $this->aliveCells = [];

        foreach ($pattern as $y => $row) {
            foreach ($row as $x => $cell) {
                if ($cell === 1) {
                    $aliveX = $xx + $x;
                    $aliveY = $yy + $y;
                    $this->aliveCells["$aliveX,$aliveY"] = true;
                }
            }
        }
    }

    private function replay(): void
    {
        $this->seed($this->pattern, 0, 0);
    }

    private function move(): void
    {
        $neighborCounts = $this->getNeighborsCount();
        $this->aliveCells = $this->setCellAlive($neighborCounts);
    }

    private function getNeighborsCount(): array
    {
        $neighborCounts = [];

        foreach ($this->aliveCells as $key => $_) {
            [$x, $y] = explode(',', $key);
            $x = (int)$x;
            $y = (int)$y;

            foreach ($this->getNeighbors($x, $y) as [$nx, $ny]) {
                $neighborCounts["$nx,$ny"] = ($neighborCounts["$nx,$ny"] ?? 0) + 1;
            }
        }

        return $neighborCounts;
    }

    private function getNeighbors(int $x, int $y): array
    {
        $neighbors = [];
        for ($dx = -1; $dx <= 1; $dx++) {
            for ($dy = -1; $dy <= 1; $dy++) {
                if ($dx === 0 && $dy === 0) continue;
                $neighbors[] = [$x + $dx, $y + $dy];
            }
        }
        return $neighbors;
    }

    private function hasReachedEdge(): bool
    {
        foreach ($this->aliveCells as $key => $_) {
            [$x, $y] = explode(',', $key);
            if ($x >= $this->gridX - 1 && $y >= $this->gridY - 1) {
                return true;
            }
        }
        return false;
    }

    private function calculateTerminationTime(): int
    {
        return time() + ($this->timeout != null ? $this->timeout : self::DEFAULT_TIMEOUT);
    }

    private function setCellAlive(array $neighborCounts): array
    {
        $newAliveCells = [];
        foreach ($neighborCounts as $key => $count) {
            if ($count === 3 || ($count === 2 && isset($this->aliveCells[$key]))) {
                $newAliveCells[$key] = true;
            }
        }
        return $newAliveCells;
    }
}
