<?php
declare(strict_types=1);

namespace App\Aoc7;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function runTest1(): int
    {
        $this->inputReader->initTest();
        return $this->_run1();
    }

    public function run1(): int
    {
        $this->inputReader->init();
        return $this->_run1();
    }

    private function _run1(): int
    {
        $positions = $this->inputReader->getPositions();
        $fuel = [];
        foreach (range(min(array_keys($positions)), max(array_keys($positions))) as $positionSelected) {
            $fuel[$positionSelected] = 0;
            foreach ($positions as $position => $count) {
                if ($position !== $positionSelected) {
                    $diff = abs($position - $positionSelected);
                    $fuel[$positionSelected] += ($diff > 0) ? ($count * $this->cost1($diff)) : $count;
                }
            }
        }

        return min($fuel);
    }

    private function cost1(int $value): int
    {
        return $value;
    }

    public function runTest2(): int
    {
        $this->inputReader->initTest();
        return $this->_run2();
    }

    public function run2(): int
    {
        $this->inputReader->init();
        return $this->_run2();
    }

    private function _run2(): int
    {
        $positions = $this->inputReader->getPositions();
        $fuel = [];
        foreach (range(min(array_keys($positions)), max(array_keys($positions))) as $positionSelected) {
            $fuel[$positionSelected] = 0;
            foreach ($positions as $position => $count) {
                if ($position !== $positionSelected) {
                    $diff = abs($position - $positionSelected);
                    $fuel[$positionSelected] += ($diff > 0) ? ($count * $this->cost2($diff)) : $count;
                }
            }
        }

        return min($fuel);
    }

    private function cost2(int $value): int
    {
//        static $values;
//        if (!isset($values[$value])) {
//            $values[$value] = array_sum(range(1, $value));
//        }
//        return $values[$value];

        //-- or s. https://de.wikipedia.org/wiki/Gau%C3%9Fsche_Summenformel
        return $value * ($value + 1) /2;
    }
}