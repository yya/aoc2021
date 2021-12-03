<?php
declare(strict_types=1);

namespace App\Aoc1;

final class InputReader {
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getSimpleMeasures(): array
    {
        return file($this->filePath);
    }
}