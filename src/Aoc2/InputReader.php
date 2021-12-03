<?php
declare(strict_types=1);

namespace App\Aoc2;

final class InputReader {
    private string $filePath;
    private string $delimiter;

    public function __construct(string $filePath, string $delimiter)
    {
        $this->filePath = $filePath;
        $this->delimiter = $delimiter;
    }

    public function getMoves(): array
    {
        $delimiter = $this->delimiter;
        return array_map(
            static function ($csvLine) use ($delimiter) {
                return str_getcsv($csvLine, $delimiter);
            },
            file($this->filePath)
        );
    }

    public function getTestValues(): array
    {

        $string = 'forward 5
down 5
forward 8
up 3
down 8
forward 2';

        $delimiter = $this->delimiter;
        return array_map(
            static function ($csvLine) use ($delimiter) {
                return str_getcsv($csvLine, $delimiter);
            },
            explode(PHP_EOL, trim($string))
        );
    }
}