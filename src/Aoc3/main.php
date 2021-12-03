<?php
declare(strict_types=1);

namespace App\Aoc3;

require_once '../../vendor/autoload.php';

$main = new Main('./resources/input1.txt');
echo sprintf('1: %d', $main->run1()) . PHP_EOL;


$main = new Main('./resources/input2.txt');
echo sprintf('2: %d', $main->run2()) . PHP_EOL;


