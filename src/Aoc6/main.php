<?php
declare(strict_types=1);

namespace App\Aoc6;

require_once '../../vendor/autoload.php';

$main = new Main('./resources/input1.txt');
echo sprintf('Part 1 (test): %d', $main->runTest(80)) . PHP_EOL;
echo sprintf('Part 1: %d', $main->run(80)) . PHP_EOL;

$main = new Main('./resources/input2.txt');
echo sprintf('Part 2 (test): %d', $main->runTest(256)) . PHP_EOL;
echo sprintf('Part 2: %d', $main->run(256)) . PHP_EOL;
