<?php
declare(strict_types=1);

namespace App\Aoc5;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function runTest(bool $onlyHorizontalAndVertical): int
    {
        $this->inputReader->initTest();
        return $this->_run($onlyHorizontalAndVertical);
    }

    public function run(bool $onlyHorizontalAndVertical): int
    {
        $this->inputReader->init();
        return $this->_run($onlyHorizontalAndVertical);
    }

    public function _run(bool $onlyHorizontalAndVertical): int
    {
        $vents = Vents::create($onlyHorizontalAndVertical);
        foreach ($this->inputReader->getVents() as $inputVent) {
            $vent = Vent::create($inputVent);
            $vents->add($vent);
        }

        return $vents->getIntersectionPoints();
    }
}