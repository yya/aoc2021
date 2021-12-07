<?php
declare(strict_types=1);

namespace App\Aoc7;

final class InputReader
{
    private array $positions;
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


    public function getPositions(): array
    {
        return $this->positions;
    }

    private function parse(string $fileContent): void
    {
        $this->reset();
        $file = explode(PHP_EOL, $fileContent);
        $line1 = array_map(
            static function ($number) {
                return intval($number);
            },
            str_getcsv($file[0], ',')
        );

        foreach ($line1 as $position) {
            isset($this->positions[$position]) || $this->positions[$position] = 0;
            $this->positions[$position]++;
        }
    }

    private function reset(): void
    {
        $this->positions = [];
    }


    public function getTestRawData(): string
    {
        return '16,1,2,0,4,2,7,1,2,14';
    }
}