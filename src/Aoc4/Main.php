<?php
declare(strict_types=1);

namespace App\Aoc4;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function run1Test(): int
    {
        $this->inputReader->initTest();
        return $this->_run1();
    }

    public function run1(): int
    {
        $this->inputReader->init();
        return $this->_run1();
    }

    public function _run1(): int
    {
        $input = $this->inputReader->getInput();
        $boards = [];

        foreach ($this->inputReader->getBoards() as $inputBoard) {
            $boards[] = Board::create($inputBoard);
        }

        foreach ($input as $number) {
            foreach($boards as $board) {
                $board->mark($number);
                if ($board->bingo()) {
                    return $board->getScore();
                }
            }
        }

        return 0;
    }

    public function run2Test(): int
    {
        $this->inputReader->initTest();
        return $this->_run2();
    }

    public function run2(): int
    {
        $this->inputReader->init();
        return $this->_run2();
    }

    public function _run2(): int
    {
        $input = $this->inputReader->getInput();
        $boards = [];

        foreach ($this->inputReader->getBoards() as $inputBoard) {
            $boards[] = Board::create($inputBoard);
        }

        $bingo = [];
        foreach ($input as $number) {
            foreach($boards as $board) {
                if ($board->won()) {
                    continue;
                }
                $board->mark($number);
                if ($board->bingo()) {
                    $bingo[] = $board->getScore();
                }
            }
        }

        return array_pop($bingo);
    }

}