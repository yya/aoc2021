<?php
declare(strict_types=1);

namespace App\Aoc2;

use RuntimeException;

class Course2
{
    public const FORWARD = 'forward';
    public const UP = 'up';
    public const DOWN = 'down';

    private int $horizontal;
    private int $depth;
    private int $aim;

    private function __construct()
    {
        $this->horizontal = 0;
        $this->depth = 0;
        $this->aim = 0;
    }

    public static function create(): self
    {
        return new self();
    }

    public function getFinalPosition(): int
    {
        return $this->horizontal * $this->depth;
    }

    public function move(string $direction, int $value): void
    {
        switch ($direction) {
            case self::FORWARD:
                $this->moveForward($value);
                break;
            case self::UP:
                $this->moveUp($value);
                break;
            case self::DOWN:
                $this->moveDown($value);
                break;
            default:
                throw new RuntimeException();
        }
    }

    private function moveForward(int $value): void
    {
        $this->horizontal += $value;
        $this->depth += ($this->aim * $value);
    }

    private function moveUp(int $value): void
    {
        $this->aim -= $value;
    }

    private function moveDown(int $value): void
    {
        $this->aim += $value;
    }
}