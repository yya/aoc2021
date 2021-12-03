<?php
declare(strict_types=1);

namespace App\Aoc1;

final class Result
{
    private int $measures;
    private int $increased;

    public function __construct(int $measures, int $increased)
    {
        $this->measures = $measures;
        $this->increased = $increased;
    }

    /**
     * @return int
     */
    public function getMeasures(): int
    {
        return $this->measures;
    }

    /**
     * @return int
     */
    public function getIncreased(): int
    {
        return $this->increased;
    }

    public function __toString(): string
    {
        return sprintf('measures:%d, increased:%d', $this->measures, $this->increased);
    }
}