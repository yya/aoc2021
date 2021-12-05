<?php
declare(strict_types=1);


namespace App\Aoc5;

final class Vent
{
    private Point $p1;
    private Point $p2;

    public function __construct(Point $p1, Point $p2)
    {
        $this->p1 = $p1;
        $this->p2 = $p2;
    }

    public static function create(array $vent): self
    {
        $p1 = new Point($vent['x1'], $vent['y1']);
        $p2 = new Point($vent['x2'], $vent['y2']);
        return new self($p1, $p2);
    }

    public function isHorizontalOrVertical(): bool
    {
        return $this->isHorizontal() || $this->isVertical();
    }

    private function isHorizontal(): bool
    {
        if ($this->getP1()->getX() === $this->getP2()->getX()) {
            return true;
        }

        return false;
    }

    private function isVertical(): bool
    {
        if ($this->getP1()->getY() === $this->getP2()->getY()) {
            return true;
        }

        return false;
    }

    public function getPoints(): array
    {
        $points = [];
        if ($this->isHorizontal()) {
            $min = min($this->p1->getY(), $this->p2->getY());
            $max = max($this->p1->getY(), $this->p2->getY());
            while($min <= $max) {
                $points[] = new Point($this->p1->getX(), $min++);
            }
        } elseif ($this->isVertical()) {
            $min = min($this->p1->getX(), $this->p2->getX());
            $max = max($this->p1->getX(), $this->p2->getX());
            while($min <= $max) {
                $points[] = new Point($min++, $this->p1->getY());
            }
        } else {
            $diffX = $this->p1->getX() - $this->p2->getX();
            $diffY = $this->p1->getY() - $this->p2->getY();
            $stepX = ($diffX < 0) ? 1 : -1;
            $stepY = ($diffY < 0) ? 1 : -1;

            for ($i = 0; $i <= abs($diffX); $i++) {
                $points[] = new Point($this->p1->getX() + ($i * $stepX), $this->p1->getY() + ($i * $stepY));
            }
        }

        return $points;
    }

    /**
     * @return Point
     */
    public function getP1(): Point
    {
        return $this->p1;
    }

    /**
     * @return Point
     */
    public function getP2(): Point
    {
        return $this->p2;
    }

    public function __toString(): string
    {
        return sprintf('%s -> %s', $this->p1, $this->p2);
    }
}