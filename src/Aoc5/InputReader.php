<?php
declare(strict_types=1);

namespace App\Aoc5;

final class InputReader
{
    private array $vents;
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function init(): void
    {
        $this->parse(file_get_contents($this->filePath));
    }

    public function initTest(): void
    {
        $this->parse($this->getTestRawData());
    }


    public function getVents(): array
    {
        return $this->vents;
    }

    private function parse(string $fileContent): void
    {
        $this->reset();

        $file = explode(PHP_EOL, $fileContent);

        foreach ($file as $line) {
            $line = preg_replace('/\s+/', '', $line);
            $line = trim($line);

            [$point1, $point2] = explode('->', $line);

            $point1 = array_map(
                static function ($number) {
                    return intval($number);
                },
                str_getcsv($point1, ',')
            );

            $point2 = array_map(
                static function ($number) {
                    return intval($number);
                },
                str_getcsv($point2, ',')
            );

            $this->vents[] = [
                'x1' => $point1[0],
                'y1' => $point1[1],
                'x2' => $point2[0],
                'y2' => $point2[1]
            ];
        }

    }

    private function reset(): void
    {
        $this->vents = [];
    }


    public function getTestRawData(): string
    {
        return '0,9 -> 5,9
8,0 -> 0,8
9,4 -> 3,4
2,2 -> 2,1
7,0 -> 7,4
6,4 -> 2,0
0,9 -> 2,9
3,4 -> 1,4
0,0 -> 8,8
5,5 -> 8,2';
    }
}