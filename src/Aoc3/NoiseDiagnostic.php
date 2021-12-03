<?php
declare(strict_types=1);

namespace App\Aoc3;

class NoiseDiagnostic
{
    private array $noises = [];
    private array $positions = [];

    private function __construct(array $noises)
    {
        $this->noises = $noises;
    }

    private function parse(): void
    {
        $strLength = strlen($this->noises[0]);
        $this->positions = [];
        foreach ($this->noises as $noise) {
            for ($position = 0; $position < $strLength; $position++) {
                $bit = substr($noise, $position, 1);
                array_key_exists($position, $this->positions) || $this->positions[$position] = [];
                array_key_exists($bit, $this->positions[$position]) || $this->positions[$position][$bit] = 0;
                $this->positions[$position][$bit]++;
            }
        }
    }

    public static function create(array $noises): self
    {
        $noiseDiagnostic = new self($noises);
        $noiseDiagnostic->parse();

        return $noiseDiagnostic;
    }

    public function getPowerConsumption(): int
    {
        return $this->getGammaRate() * $this->getEpsilonRate();
    }

    private function getGammaRate(): int
    {
        $gamma = [];
        foreach ($this->positions as $position => $bits) {
            $index = array_search(max($bits), $bits);
            $gamma[$position] = $index;
        }

        return (int)bindec(implode('', $gamma));
    }


    private function getEpsilonRate(): int
    {
        $epsilon = [];
        foreach ($this->positions as $position => $bits) {
            $index = array_search(min($bits), $bits);
            $epsilon[$position] = $index;
        }

        return (int)bindec(implode('', $epsilon));
    }

}