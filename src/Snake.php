<?php

declare(strict_types=1);

namespace App;

use App\Vector;
use App\GameState;

class Snake
{

    private $state;


    public function __construct($data)
    {
        $this->state = $data;
    }


    public function id() : string
    {
        return $this->state->id;
    }


    public function length(): int
    {
        return count($this->state->body);
    }


    public function head() : Vector
    {
        return new Vector($this->state->head->x, $this->state->head->y);
    }


    public function occupies(Vector $vector): bool
    {
        foreach ($this->state->body as $body) {
            if ($body->x === $vector->x && $body->y === $vector->y) {
                return true;
            }
        }
        return false;
    }


    public function possibleMoves(): array
    {
        $moves = [];
        // Up
        if ($this->head()->y < GameState::height() - 1)
        {
            if (GameState::isEmpty($this->head()->above()))
            {
                $moves[] = 'up';
            }
        }
        // Right
        if ($this->head()->x < GameState::width() - 1)
        {
            if (GameState::isEmpty($this->head()->right()))
            {
                $moves[] = 'right';
            }
        }
        // Down
        if ($this->head()->y > 0)
        {
            if (GameState::isEmpty($this->head()->below()))
            {
                $moves[] = 'down';
            }
        }
        // Left
        if ($this->head()->x > 0)
        {
            if (GameState::isEmpty($this->head()->left()))
            {
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
