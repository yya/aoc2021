<?php
declare(strict_types=1);

namespace App\Aoc9;

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

    private function _run1(): int
    {
        $result = 0;
        $points = $this->inputReader->getPoints();
        $lowestPoints = $this->getLowestPoints($points);
        foreach ($lowestPoints as $lowestPoint) {
            $result += $points[$lowestPoint[0]][$lowestPoint[1]] + 1;
        }

        return $result;
    }

    private function getLowestPoints(array $points): array
    {
        $result = [];

        foreach ($points as $i => $location) {
            foreach ($location as $j => $point) {
                if ($this->isLowest($points, $i, $j)) {
                    $result[] = [$i, $j];
                }
            }
        }

        return $result;
    }

    private function isLowest($points, $i, $j): bool
    {
        return $points[$i][$j] < min($this->getAdjacentsValues($points, $i, $j));
    }

    private function getAdjacentsValues(array $points, int $iCurrent, int $jCurrent): array
    {
        return array_map(
            static function (array $adjacent) use ($points) {
                return $points[$adjacent[0]][$adjacent[1]];
            },
            $this->findAdjacents($points, $iCurrent, $jCurrent)
        );
    }

    private function findAdjacents(array $points, int $iCurrent, int $jCurrent): array
    {
        $top = isset($points[$iCurrent - 1][$jCurrent]) ? [$iCurrent - 1, $jCurrent] : null;
        $down = isset($points[$iCurrent + 1][$jCurrent]) ? [$iCurrent + 1, $jCurrent] : null;
        $left = isset($points[$iCurrent][$jCurrent - 1]) ? [$iCurrent, $jCurrent - 1] : null;
        $right = isset($points[$iCurrent][$jCurrent + 1]) ? [$iCurrent, $jCurrent + 1] : null;

        return array_filter(
            [$left, $top, $right, $down],
            static function ($value) {
                return $value !== null;
            }
        );
    }

    public function run1(): int
    {
        $this->inputReader->init();
        return $this->_run1();
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
        $result = [];
        $basins = [];
        $points = $this->inputReader->getPoints();
        $lowestPoints = $this->getLowestPoints($points);

        foreach ($lowestPoints as $lowestPoint) {
            $basin = count(array_filter($this->findBasin($points, $lowestPoint[0], $lowestPoint[1], []), static function ($value) {
                return $value !== false;
            }));
            $basins[] = $basin;
        }

        arsort($basins);

        return array_product(array_splice($basins, 0, 3));
    }

    private function findBasin(array $points, int $iCurrent, int $jCurrent, array $basin): array
    {
        do {
            $adjacents = $this->findAdjacents($points, $iCurrent, $jCurrent);

            foreach ($adjacents as $adjacent) {
                if (isset($basin[$adjacent[0] . 'x' . $adjacent[1]])) {
                    continue;
                }
                if ($points[$adjacent[0]][$adjacent[1]] === 9) {
                    $basin[$adjacent[0] . 'x' . $adjacent[1]] = false;
                    continue;
                }

                $basin[$adjacent[0] . 'x' . $adjacent[1]] = true;
                $basin = array_merge([$iCurrent . 'x' . $jCurrent => true], $this->findBasin($points, $adjacent[0], $adjacent[1], $basin));
            }

        } while (count($adjacents) === 0);

        return $basin;
    }

}