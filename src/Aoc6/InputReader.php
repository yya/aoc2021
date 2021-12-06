<?php
declare(strict_types=1);

namespace App\Aoc6;

final class InputReader
{
    private array $ages;
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


    public function getAges(): array
    {
        return $this->ages;
    }

    private function parse(string $fileContent): void
    {
        $this->reset();
        $file = explode(PHP_EOL, $fileContent);
        $day0 = array_map(
            static function ($number) {
                return intval($number);
            },
            str_getcsv($file[0], ',')
        );

        foreach ($day0 as $age) {
            isset($this->ages[$age]) || $this->ages[$age] = 0;
            $this->ages[$age]++;
        }
    }

    private function reset(): void
    {
        $this->ages = [];
    }


    public function getTestRawData(): string
    {
        return '3,4,3,1,2';
    }
}