<?php
declare(strict_types=1);


namespace App\Aoc8;

final class Signal
{
    const EASY_DIGITS = [2, 3, 4, 7];
    private array $uniqueSignalPatterns;
    private array $fourDigitOutputValues;

    private function __construct(array $uniqueSignalPatterns, array $fourDigitOutputValues)
    {
        $this->uniqueSignalPatterns = $uniqueSignalPatterns;
        $this->fourDigitOutputValues = $fourDigitOutputValues;
    }

    public static function create(array $uniqueSignalPatterns, array $fourDigitOutputValues): self
    {
        return new self($uniqueSignalPatterns, $fourDigitOutputValues);
    }

    public function getEasyDigits(): int
    {
        $easyDigits = [];
        foreach ($this->fourDigitOutputValues as $fourDigitOutputValue) {
            if (in_array(strlen($fourDigitOutputValue), self::EASY_DIGITS)) {
                $easyDigits[] = $fourDigitOutputValue;
            }
        }

        return count($easyDigits);
    }

    public function isEasyDigit(string $fourDigitOutputValue): bool
    {
        return (in_array(strlen($fourDigitOutputValue), self::EASY_DIGITS));
    }

    public function decode(): int
    {
        $table = [
            0 => null,
            1 => null,
            2 => null,
            3 => null,
            4 => null,
            5 => null,
            6 => null,
            7 => null,
            8 => null,
            9 => null,
        ];

        $this->findEasyDigits($table);
        $this->findDigits5($table);
        $this->findDigits6($table);

        $value = [];
        foreach ($this->fourDigitOutputValues as $fourDigitOutputValue) {
            $value[] = $table[$fourDigitOutputValue];
        }

        return (int)implode('', $value);
    }

    private function findEasyDigits(array &$table): void
    {
        foreach ($this->uniqueSignalPatterns as $uniqueSignalPattern) {
            $strLength = strlen($uniqueSignalPattern);
            if ($this->isEasyDigit($uniqueSignalPattern)) {
                switch ($strLength) {
                    case 2:
                        $table[1] = $uniqueSignalPattern;
                        $table[$uniqueSignalPattern] = 1;
                        break;
                    case 3:
                        $table[7] = $uniqueSignalPattern;
                        $table[$uniqueSignalPattern] = 7;
                        break;
                    case 4:
                        $table[4] = $uniqueSignalPattern;
                        $table[$uniqueSignalPattern] = 4;
                        break;
                    case 7:
                        $table[8] = $uniqueSignalPattern;
                        $table[$uniqueSignalPattern] = 8;
                        break;
                }
            }
        }
    }

    private function findDigits5(array &$table): void
    {
        foreach ($this->uniqueSignalPatterns as $uniqueSignalPattern) {
            $strLength = strlen($uniqueSignalPattern);

            if ($strLength === 5) {
                $input = str_split($uniqueSignalPattern);
                $chars4 = str_split($table[4]);
                $chars7 = str_split($table[7]);

                if (count(array_intersect($chars4, $input)) === 3 && count(array_intersect($chars7, $input)) === 2) {
                    $table[5] = $uniqueSignalPattern;
                    $table[$uniqueSignalPattern] = 5;
                    continue;
                }

                if (count(array_intersect($chars4, $input)) === 3 && count(array_intersect($chars7, $input)) === 3) {
                    $table[3] = $uniqueSignalPattern;
                    $table[$uniqueSignalPattern] = 3;
                    continue;
                }

                $table[2] = $uniqueSignalPattern;
                $table[$uniqueSignalPattern] = 2;

            }
        }
    }

    private function findDigits6(array &$table): void
    {
        foreach ($this->uniqueSignalPatterns as $uniqueSignalPattern) {
            $strLength = strlen($uniqueSignalPattern);
            if ($strLength === 6) {
                $input = str_split($uniqueSignalPattern);
                $chars4 = str_split($table[4]);
                $chars7 = str_split($table[7]);

                if (count(array_intersect($chars4, $input)) === 4 && count(array_intersect($chars7, $input)) === 3) {
                    $table[9] = $uniqueSignalPattern;
                    $table[$uniqueSignalPattern] = 9;
                    continue;
                }

                if (count(array_intersect($chars4, $input)) === 3 && count(array_intersect($chars7, $input)) === 2) {
                    $table[6] = $uniqueSignalPattern;
                    $table[$uniqueSignalPattern] = 6;
                    continue;
                }

                $table[0] = $uniqueSignalPattern;
                $table[$uniqueSignalPattern] = 0;
            }
        }
    }

    private function normalize(string $pattern): string
    {
        $chars = str_split($pattern);
        asort($chars);
        return implode('', $chars);
    }
}