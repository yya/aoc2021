<?php
declare(strict_types=1);

namespace App\Aoc1;

require_once '../../vendor/autoload.php';


$main = new Main('./resources/input1.txt');
$result = $main->run1();
echo $result . PHP_EOL;


$main = new Main('./resources/input2.txt');
$result = $main->run2();
echo $result . PHP_EOL;



