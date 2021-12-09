<?php
declare(strict_types=1);

namespace App\Aoc9;

final class InputReader
{
    private array $points;
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function init(): void
    {
        $this->parse(file_get_contents($this->filePath));
    }

    private function parse(string $fileContent): void
    {
        $this->reset();

        $file = explode(PHP_EOL, $fileContent);

        foreach ($file as $line) {
            $line = trim($line);
            $this->points[] = array_map(static function ($input) {
                return intval($input);
            }, str_split($line));
        }
    }

    private function reset(): void
    {
        $this->points = [];
    }

    public function initTest(): void
    {
        $this->parse($this->getTestRawData());
    }

    public function getTestRawData(): string
    {
        return '2199943210
3987894921
9856789892
8767896789
9899965678';
    }

    public function getPoints(): array
    {
        return $this->points;
    }
}