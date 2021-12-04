<?php
declare(strict_types=1);

namespace App\Aoc4;

final class InputReader {
    private array $input;
    private array $boards;
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

    public function getInput(): array
    {
        return $this->input;
    }

    public function getBoards(): array
    {
        return $this->boards;
    }

    private function parse(string $fileContent): void
    {
        $this->reset();

        $file = explode(PHP_EOL, $fileContent);

        $this->input = array_map(
            static function ($number) {
                return intval($number);
            },
            str_getcsv(array_shift($file), ',')
        );

        $board = [];
        foreach ($file as $line) {
            $line =  preg_replace('/\s+/', ' ', $line);
            $line = trim($line);
            if ($line === '') {
                $board = [];
                continue;
            }
            $board[] = array_map(
                static function ($number) {
                    return intval($number);
                },
                str_getcsv($line, ' ')
            );

            if (count($board) === 5) {
                $this->boards[] = $board;
            }
        }
    }

    private function reset(): void
    {
        $this->input = [];
        $this->boards = [];
    }


    public function getTestRawData(): string
    {
        return '7,4,9,5,11,17,23,2,0,14,21,24,10,16,13,6,15,25,12,22,18,20,8,19,3,26,1

22 13 17 11  0
 8  2 23  4 24
21  9 14 16  7
 6 10  3 18  5
 1 12 20 15 19

 3 15  0  2 22
 9 18 13 17  5
19  8  7 25 23
20 11 10 24  4
14 21 16 12  6

14 21 17 24  4
10 16 15  9 19
18  8 23 26 20
22 11 13  6  5
 2  0 12  3  7';
    }
}