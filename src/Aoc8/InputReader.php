<?php
declare(strict_types=1);

namespace App\Aoc8;

final class InputReader
{
    private array $signals;
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


    public function getSignals(): array
    {
        return $this->signals;
    }

    private function parse(string $fileContent): void
    {
        $this->reset();

        $file = explode(PHP_EOL, $fileContent);

        foreach ($file as $line) {
            $line = trim($line);
            $line = str_replace(' | ', '|', $line);

            [$uniqueSignalPatterns, $fourDigitOutputValues] = explode('|', $line);

            $normalize = static function ($input) {
                $chars = str_split($input);
                asort($chars);
                return implode('', $chars);
            };

            $uniqueSignalPatterns = array_map($normalize, str_getcsv($uniqueSignalPatterns, ' '));
            $fourDigitOutputValues = array_map($normalize, str_getcsv($fourDigitOutputValues, ' '));

            $this->signals[] = [
                'uniqueSignalPatterns' => $uniqueSignalPatterns,
                'fourDigitOutputValue' => $fourDigitOutputValues,
            ];
        }
    }

    private function reset(): void
    {
        $this->signals = [];
    }


    public function getTestRawData(): string
    {
        return 'be cfbegad cbdgef fgaecd cgeb fdcge agebfd fecdb fabcd edb | fdgacbe cefdb cefbgd gcbe
edbfga begcd cbg gc gcadebf fbgde acbgfd abcde gfcbed gfec | fcgedb cgb dgebacf gc
fgaebd cg bdaec gdafb agbcfd gdcbef bgcad gfac gcb cdgabef | cg cg fdcagb cbg
fbegcd cbd adcefb dageb afcb bc aefdc ecdab fgdeca fcdbega | efabcd cedba gadfec cb
aecbfdg fbg gf bafeg dbefa fcge gcbea fcaegb dgceab fcbdga | gecf egdcabf bgf bfgea
fgeab ca afcebg bdacfeg cfaedg gcfdb baec bfadeg bafgc acf | gebdcfa ecba ca fadegcb
dbcfg fgd bdegcaf fgec aegbdf ecdfab fbedc dacgb gdcebf gf | cefg dcbef fcge gbcadfe
bdfegc cbegaf gecbf dfcage bdacg ed bedf ced adcbefg gebcd | ed bcgafe cdgba cbgef
egadfb cdbfeg cegd fecab cgb gbdefca cg fgcdab egfdb bfceg | gbdfcae bgc cg cgb
gcafb gcf dcaebfg ecagb gf abcdeg gaef cafbge fdbac fegbdc | fgae cfgab fg bagce';
    }
}