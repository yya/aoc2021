<?php
declare(strict_types=1);

namespace App\Aoc6;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function runTest(int $until): int
    {
        $this->inputReader->initTest();
        return $this->_run($until);
    }

    public function run(int $until): int
    {
        $this->inputReader->init();
        return $this->_run($until);
    }

    public function _run(int $until): int
    {
        $ages = $this->inputReader->getAges();
        while ($until > 0) {
            $tmpAge = 0;
            foreach (range(0, 8) as $age) {
                if ($age === 0) {
                    $tmpAge = $ages[$age] ?? 0;
                    $ages[$age] = $ages[$age + 1] ?? 0;
                } elseif ($age === 6) {
                    $ages[$age] = ($ages[$age + 1] ?? 0) + $tmpAge;
                } elseif ($age === 8) {
                    $ages[$age] = $tmpAge;
                } else {
                    $ages[$age] = $ages[$age + 1] ?? 0;
                }
            }
            --$until;
        }

        return array_sum($ages);
    }
}