<?php

declare(strict_types=1);

namespace App;

use App\Vector;
use App\GameState;

class Snake
{

    private $state;
    private $head, $neck;


    public function __construct($data)
    {
        $this->state = $data;
        $this->head = new Vector($this->state->head);
        $this->neck = new Vector($this->state->body[1]);
    }


    public function length(): int
    {
        return count($this->state->body);
    }


    public function isBody(Vector $vector): bool
    {
        return array_reduce(
            $this->state->body,
            function($found, $square) use ($vector)
            {
                $found = $found || ($square->x === $vector->x && $square->y === $vector->y);
                return $found;
            },
            false
        );
    }


    public function possibleMoves(): array
    {
        $moves = [];
        // Up
        if ($this->head->y < GameState::height() - 1) {
            if (!$this->isBody($this->head->above())) {
                $moves[] = 'up';
            }
        }
        // Right
        if ($this->head->x < GameState::width() - 1) {
            if (!$this->isBody($this->head->right())) {
                $moves[] = 'right';
            }
        }
        // Down
        if ($this->head->y > 0) {
            if (!$this->isBody($this->head->below())) {
                $moves[] = 'down';
            }
        }
        // Left
        if ($this->head->x > 0) {
            if (!$this->isBody($this->head->left())) {
                $moves[] = 'left';
            }
        }
        // error_log("Head is at:");
        // error_log(print_r($this->head, true));
        // error_log("Moves:");
        // error_log(print_r($moves, true));
        return $moves;
    }


    public function randomMove() : string
    {
        return $this->possibleMoves()[array_rand($this->possibleMoves())];
    }


    public function getMove() : string
    {
        return $this->randomMove();
    }
}
