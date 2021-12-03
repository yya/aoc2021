<?php
declare(strict_types=1);

namespace App\Aoc3;

final class InputReader {
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getNoises(): array
    {
        return file($this->filePath);
    }



    public function getTestValues(): array
    {
        $string = '00100
11110
10110
10111
10101
01111
00111
11100
10000
11001
00010
01010';

       return explode(PHP_EOL, trim($string));
    }
}