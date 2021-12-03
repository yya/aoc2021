<?php
declare(strict_types=1);


namespace App\Aoc3;

final class LifeSupport
{
    private array $noises;

    private function __construct(array $noises)
    {
        $this->noises = $noises;
    }

    public static function create(array $noises): self
    {
        return new self($noises);
    }

    public function getLifeSupportRating(): int
    {
        return $this->getOxygenGeneratorRating() * $this->getCo2ScrubberRating();
    }

    private function getOxygenGeneratorRating(): int
    {
        $oxygenGeneratorRating = $this->getOxygenGeneratorRatings($this->noises, 0);
        return (int)bindec($oxygenGeneratorRating[0]);
    }

    private function getCo2ScrubberRating(): int
    {
        $co2ScrubberRating = $this->getCo2ScrubberRatings($this->noises, 0);
        return (int)bindec($co2ScrubberRating[0]);
    }

    private function getOxygenGeneratorRatings(array $noises, int $position): array
    {
        if (count($noises) === 1) {
            return $noises;
        }

        $bits = $this->getBits($noises, $position);

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

        $bits = $this->getBits($noises, $position);

        $countBit0 = count($bits[0]);
        $countBit1 = count($bits[1]);
        if ($countBit0 <= $countBit1) {
            return $this->getCo2ScrubberRatings($bits[0], ++$position);
        }

        return $this->getCo2ScrubberRatings($bits[1], ++$position);
    }

    private function getBits(array $noises, int $position): array
    {
        $bits = [0 => [], 1 => []];
        foreach ($noises as $noise) {
            $bit = intval(substr($noise, $position, 1));
            array_key_exists($bit, $bits) || $bits[$bit] = [];
            $bits[$bit][] = $noise;
        }

        return $bits;
    }
}