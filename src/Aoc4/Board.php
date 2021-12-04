<?php
declare(strict_types=1);

namespace App\Aoc4;

class Board
{
    private array $board = [];
    private array $marked = [];
    private ?int $lastMarked = null;
    private ?int $markedRow = null;
    private ?int $markedColumn = null;

    private function __construct(array $board)
    {
        $this->board = $board;
    }

    private function init(): void
    {
        foreach ($this->board as $rowIndex => $rowValue) {
            foreach ($rowValue as $columnIndex => $columnValue) {
                $this->marked[$rowIndex][$columnIndex] = 0;
            }
        }
    }

    public static function create(array $board): self
    {
        $board = new self($board);
        $board->init();

        return $board;
    }

    public function mark(int $number): void
    {
        foreach ($this->board as $rowIndex => $rowValue) {
            foreach ($rowValue as $columnIndex => $columnValue) {
                if ($this->marked[$rowIndex][$columnIndex]) {
                    continue;
                }
                if ($columnValue === $number) {
                    $this->marked[$rowIndex][$columnIndex] = 1;
                    $this->lastMarked = $number;
                }
            }
        }
    }

    public function bingo(): bool
    {
        foreach ($this->marked as $rowIndex => $rowValues) {
            if (array_sum($rowValues) === count($rowValues)) {
                $this->markedRow = $rowIndex;
                return true;
            }
        }

        for ($columnIndex = 0; $columnIndex < count($this->marked); $columnIndex++) {
            $columnValues = array_column($this->marked, $columnIndex);
            if (array_sum($columnValues) === count($columnValues)) {
                $this->markedColumn = $columnIndex;
                return true;
            }
        }
        return false;
    }


    public function getScore()
    {
        $unmarked = [];
        foreach ($this->board as $rowIndex => $rowValue) {
            foreach ($rowValue as $columnIndex => $columnValue) {
                if ($this->marked[$rowIndex][$columnIndex]) {
                    continue;
                }
                $unmarked[] = $columnValue;
            }
        }

        return array_sum($unmarked) * $this->lastMarked;
    }

}