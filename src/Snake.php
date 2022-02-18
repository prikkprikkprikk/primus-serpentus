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
            if (GameState::isSafe($this->head()->up()))
            {
                $moves[] = 'up';
            }
        }
        // Right
        if ($this->head()->x < GameState::width() - 1)
        {
            if (GameState::isSafe($this->head()->right()))
            {
                $moves[] = 'right';
            }
        }
        // Down
        if ($this->head()->y > 0)
        {
            if (GameState::isSafe($this->head()->down()))
            {
                $moves[] = 'down';
            }
        }
        // Left
        if ($this->head()->x > 0)
        {
            if (GameState::isSafe($this->head()->left()))
            {
                $moves[] = 'left';
            }
        }

        return $moves;
    }


    public function randomMove() : string
    {
        return $this->possibleMoves()[array_rand($this->possibleMoves())];
    }


    public function moveTowardClosestFood() : string
    {
        // Go through each possible move, and find the one(s) closest to food
        $possibleMoves = $this->possibleMoves();
        $shortestDistance = PHP_INT_MAX;
        $closestMoves = [];

        foreach ($possibleMoves as $move) {
            $newPos = $this->head()->{$move}();
            $closestFood = GameState::closestFood($newPos);
            $distance = $newPos->distanceTo($closestFood);
            $closestMoves[$move] = $distance;
            if ($distance < $shortestDistance) {
                $shortestDistance = $distance;
            }
        }
        $moves = array_filter(
            $closestMoves,
            function ($distance) use ($shortestDistance) {
                return $distance === $shortestDistance;
            }
        );
        return array_rand($moves);
    }


    public function getMove() : string
    {
        return $this->moveTowardClosestFood();
    }
}
