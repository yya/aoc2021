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
        $noiseDiagnostic = NoiseDiagnostic::create($noises);

        return $noiseDiagnostic->getPowerConsumption();
    }

    public function run2(): int
    {
        $noises = $this->inputReader->getNoises();
        $lifeSupport = LifeSupport::create($noises);

        return $lifeSupport->getLifeSupportRating();
    }
}