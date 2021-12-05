<?php
declare(strict_types=1);

namespace App\Aoc5;

require_once '../../vendor/autoload.php';

$main = new Main('./resources/input1.txt');
echo sprintf('Part 1 (test): %d', $main->runTest(true)) . PHP_EOL;
echo sprintf('Part 1: %d', $main->run(true)) . PHP_EOL;


$main = new Main('./resources/input2.txt');
echo sprintf('Part 2 (test): %d', $main->runTest(false)) . PHP_EOL;
echo sprintf('Part 2: %d', $main->run(false)) . PHP_EOL;

