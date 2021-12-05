<?php
declare(strict_types=1);


namespace App\Aoc5;

final class Vents
{
    private array $vents = [];
    private bool $onlyHorizontalAndVertical;
    private array $points = [];

    private function __construct(bool $onlyHorizontalAndVertical)
    {
        $this->onlyHorizontalAndVertical = $onlyHorizontalAndVertical;
    }

    public static function create(bool $onlyHorizontalAndVertical): self
    {
        return new self($onlyHorizontalAndVertical);
    }

    public function add(Vent $newVent): void
    {
        if ($this->onlyHorizontalAndVertical && !$newVent->isHorizontalOrVertical()) {
            return;
        }

        foreach ($newVent->getPoints() as $point) {
            array_key_exists((string)$point, $this->points) || $this->points[(string)$point] = 0;
            $this->points[(string)$point]++;
        }
    }

    public function getIntersectionPoints(): int
    {
        $intersectionPoints = array_filter($this->points, function ($value) {
            return $value > 1;
        });

        return count($intersectionPoints);
    }
}