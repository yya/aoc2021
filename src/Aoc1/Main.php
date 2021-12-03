<?php
declare(strict_types=1);

namespace App\Aoc1;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function run1(): Result
    {
        $increased = 0;
        $measures = $this->inputReader->getSimpleMeasures();
        $measuresCount = count($measures);
        $lastMeasure = array_shift($measures);
        do {
            $currentMeasure = array_shift($measures);
            if ($currentMeasure > $lastMeasure) {
                ++$increased;
            }
            $lastMeasure = $currentMeasure;
        } while (count($measures) > 0);

        return new Result($measuresCount, $increased);
    }

    public function run2(): Result
    {
        $increased = 0;
        $measures = $this->inputReader->getSimpleMeasures();
        $measuresCount = count($measures);
        $lastMeasure = $this->getCurrentMeasure($measures);
        array_shift($measures);

        do {
            $currentMeasure = $this->getCurrentMeasure($measures);
            array_shift($measures);
            if ($currentMeasure > $lastMeasure) {
                ++$increased;
            }
            $lastMeasure = $currentMeasure;
        } while (count($measures) > 2);


        return new Result($measuresCount, $increased);
    }

    private function getCurrentMeasure(array $measures): int
    {
        return array_sum([$measures[0], $measures[1], $measures[2]]);
    }
}