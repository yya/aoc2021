<?php
declare(strict_types=1);

namespace App\Aoc3;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function run1(): int
    {
        $noises = $this->inputReader->getNoises();
        $strLength = strlen($noises[0]);
        $positions = [];
        foreach ($noises as $noise) {
            for ($position = 0; $position < $strLength; $position++) {
                $bit = substr($noise, $position, 1);
                array_key_exists($position, $positions) || $positions[$position] = [];
                array_key_exists($bit, $positions[$position]) || $positions[$position][$bit] = 0;
                $positions[$position][$bit]++;
            }
        }

        $gamma = $this->getGammaRate($positions);
        $espilon = $this->getEpsilonRate($positions);

        return $gamma * $espilon;
    }

    private function getGammaRate(array $positions): int
    {
        $gamma = [];
        foreach ($positions as $position => $bits) {
            $index = array_search(max($bits), $bits);
            $gamma[$position] = $index;
        }

        return (int)bindec(implode('', $gamma));
    }

    private function getEpsilonRate(array $positions): int
    {
        $epsilon = [];
        foreach ($positions as $position => $bits) {
            $index = array_search(min($bits), $bits);
            $epsilon[$position] = $index;
        }

        return (int)bindec(implode('', $epsilon));
    }

    public function run2(): int
    {
        $noises = $this->inputReader->getNoises();

        $oxygenGeneratorRating = $this->getOxygenGeneratorRatings($noises, 0);
        $co2ScrubberRating = $this->getCo2ScrubberRatings($noises, 0);

        return (int)bindec($oxygenGeneratorRating[0]) * (int)bindec($co2ScrubberRating[0]);
    }

    private function getOxygenGeneratorRatings(array $noises, int $position): array
    {
        if (count($noises) === 1) {
            return $noises;
        }

        $bits = [0 => [], 1 => []];
        foreach ($noises as $noise) {
            $bit = intval(substr($noise, $position, 1));
            array_key_exists($bit, $bits) || $bits[$bit] = [];
            $bits[$bit][] = $noise;
        }
        $countBit0 = count($bits[0]);
        $countBit1 = count($bits[1]);
        if ($countBit1 >= $countBit0) {
            return $this->getOxygenGeneratorRatings($bits[1], ++$position);
        }

        return $this->getOxygenGeneratorRatings($bits[0], ++$position);
    }


    private function getCo2ScrubberRatings(array $noises, int $position): array
    {
        if (count($noises) === 1) {
            return $noises;
        }

        $bits = [0 => [], 1 => []];
        foreach ($noises as $noise) {
            $bit = intval(substr($noise, $position, 1));
            array_key_exists($bit, $bits) || $bits[$bit] = [];
            $bits[$bit][] = $noise;
        }
        $countBit0 = count($bits[0]);
        $countBit1 = count($bits[1]);
        if ($countBit0 <= $countBit1) {
            return $this->getCo2ScrubberRatings($bits[0], ++$position);
        }

        return $this->getCo2ScrubberRatings($bits[1], ++$position);

    }
}