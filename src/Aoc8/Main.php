<?php
declare(strict_types=1);

namespace App\Aoc8;

final class Main
{
    private InputReader $inputReader;

    public function __construct(string $filePath)
    {
        $this->inputReader = new InputReader($filePath);
    }

    public function runTest1(): int
    {
        $this->inputReader->initTest();
        return $this->_run1();
    }

    public function run1(): int
    {
        $this->inputReader->init();
        return $this->_run1();
    }

    private function _run1(): int
    {
        $inputSignals = $this->inputReader->getSignals();

        $easyDigits=0;
        foreach ($inputSignals as $inputSignal) {
            $signal = Signal::create($inputSignal['uniqueSignalPatterns'], $inputSignal['fourDigitOutputValue']);
            $easyDigits += $signal->getEasyDigits();
        }

        return $easyDigits;
    }

    public function runTest2(): int
    {
        $this->inputReader->initTest();
        return $this->_run2();
    }

    public function run2(): int
    {
        $this->inputReader->init();
        return $this->_run2();
    }

    private function _run2(): int
    {
        $inputSignals = $this->inputReader->getSignals();
        $result = 0;
        $table = [];
        foreach ($inputSignals as $inputSignal) {
            $signal = Signal::create($inputSignal['uniqueSignalPatterns'], $inputSignal['fourDigitOutputValue']);
            $result += $signal->decode();
        }

        return $result;
    }

    public function isEasyDigit(string $digit): bool
    {
        return (in_array(strlen($digit), Signal::EASY_DIGITS));
    }

    private function learn(array &$table, string $digit)
    {
        //        const SEGMENT_COUNT = [
        //            2 => [1],
        //            3 => [7],
        //            4 => [4],
        //            7 => [8],
        //            5 => [2, 3, 5],
        //            6 => [0, 6, 9],
        //        ];

        $digits = str_split($digit);
        asort($digits);
        $digit = implode($digits);

        if (isset($table[$digit])) {
            return;
        }

        $strLength = strlen($digit);

        if ($this->isEasyDigit($digit)) {
            switch ($strLength) {
                case 2:
                    $table[$digit] = 1;
                    break;
                case 3:
                    $table[$digit] = 7;
                    break;
                case 4:
                    $table[$digit] = 4;
                    break;
                case 7:
                    $table[$digit] = 8;
                    break;
            }
        } elseif ($strLength === 5) {
            // 2, 3, 5
            $one = array_search(1, $table);
            if ($one) {
                if (strstr($digit, $one)) {
                    $table[$digit] = 5;
                }
            } else {

            }
        } elseif ($strLength === 6) {
            // 0, 6, 9
            $one = array_search(1, $table);
            if ($one) {
                if (strstr($digit, $one)) {
                    // 0 | 9

                }
            } else {
                $table[$digit] = 6;
            }
        }
    }

}