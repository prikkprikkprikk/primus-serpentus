<?php

namespace App;

class Vector
{
    public $x, $y;

    public function __construct($a, $b = null)
    {
        if (
            (gettype($a) == Vector::class)
            || (gettype($a) == 'object')
        ) {
            $this->x = $a->x;
            $this->y = $a->y;
        } elseif (is_int($a) && is_int($b)) {
            $this->x = $a;
            $this->y = $b;
        } else {
            throw new Exception('Wrong arguments for Vector constructor');
        }
    }

    public function add($vector)
    {
        return new self(
            $this->x + $vector->x,
            $this->y + $vector->y
        );
    }

    public function equals($vector)
    {
        return ($this->x == $vector->x && $this->y == $vector->y);
    }

    public function distanceTo($vector)
    {
        return abs($vector->x - $this->x) + abs($vector->y - $this->y);
    }

    public function isNot($vector)
    {
        return !($this->x == $vector->x && $this->y == $vector->y);
    }

    public function up()
    {
        return new self($this->x, $this->y + 1);
    }

    public function right()
    {
        return new self($this->x + 1, $this->y);
    }

    public function down()
    {
        return new self($this->x, $this->y - 1);
    }

    public function left()
    {
        return new self($this->x - 1, $this->y);
    }
}
