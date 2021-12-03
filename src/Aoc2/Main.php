<?php
declare(strict_types=1);

namespace App\Aoc2;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath, string $delimiter)
    {
        $this->inputReader = new InputReader($filePath, $delimiter);
    }

    public function run1(): int
    {
        $moves = $this->inputReader->getMoves();
        $course = Course1::create();

        foreach ($moves as $move) {
            list($command, $value) = $move;
            $course->move($command, intval($value));
        }

        return $course->getFinalPosition();
    }

    public function run2(): int
    {
        $moves = $this->inputReader->getMoves();
        $course = Course2::create();

        foreach ($moves as $move) {
            list($command, $value) = $move;
            $course->move($command, intval($value));
        }

        return $course->getFinalPosition();
    }
}