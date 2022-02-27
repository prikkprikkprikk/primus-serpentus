<?php

declare(strict_types=1);

namespace App;

class GameState
{
    private static object $state;
    private static array $board;
    private static string $youID;
    private static Snake $you;
    private static array $enemies;
    private static array $food;
    private static array $hazards;

    public static function load( string $state_json ) : void
    {
        self::$state = json_decode($state_json);

        self::$youID = self::$state->you->id;
        self::$you = new Snake(self::$state->you);

        self::$enemies = [];
        foreach (self::$state->board->snakes as $snake) {
            if ($snake->id !== self::$youID) {
                self::$enemies[] = new Snake($snake);
            }
        }

        self::$food = array_map(
            function ($food)
            {
                return new Vector($food->x, $food->y);
            },
            self::$state->board->food
        );

        self::$hazards = array_map(
            function ($hazard)
            {
                return new Vector($hazard->x, $hazard->y);
            },
            self::$state->board->hazards
        );

        self::hydrateBoard();
    }


    private static function hydrateBoard() : void
    {
        for ($y = 0; $y < self::$state->board->height; $y++) {
            for ($x = 0; $x < self::$state->board->width; $x++) {
                self::$board[$y][$x] = 'empty';
                // For each snake, check if it occupies this cell
                foreach (self::snakes() as $snake) {
                    if ($snake->occupies(new Vector($x, $y))) {
                        self::$board[$y][$x] = 'snake';
                    }
                }
                // For each food, check if it occupies this cell
                foreach (self::$state->board->food as $food) {
                    if ($food->x === $x && $food->y === $y) {
                        self::$board[$y][$x] = 'food';
                    }
                }
                // For each hazard, check if it occupies this cell
                foreach (self::$state->board->hazards as $hazard) {
                    if ($hazard->x === $x && $hazard->y === $y) {
                        self::$board[$y][$x] = 'hazard';
                    }
                }
            }
        }
    }

    public static function width() : int
    {
        return self::$state->board->width;
    }


    public static function height() : int
    {
        return self::$state->board->height;
    }


    public static function snakes() : array
    {
        return array_merge([self::$you], self::$enemies);
    }


    public static function you() : Snake
    {
        return self::$you;
    }


    public static function enemies() : array
    {
        return self::$enemies;
    }


    public static function food() : array
    {
        return self::$food;
    }


    public static function hasFood() : bool
    {
        return count(self::$food) > 0;
    }


    public static function hazards() : array
    {
        return self::$hazards;
    }


    public static function isSafe( Vector $pos ) : bool
    {
        return (
            self::$board[$pos->y][$pos->x] === 'empty'
            || self::$board[$pos->y][$pos->x] === 'food'
        );
    }


    public static function closestFood( Vector|null $pos = null ) : Vector
    {
        if ($pos === null) {
            $pos = self::you()->head();
        }
        $closestFood = array_reduce(
            self::$food,
            function (Vector $closest, Vector $food) use ($pos) {
                $currentClosestDistance = $pos->distanceTo($closest);
                $distance = $pos->distanceTo($food);
                if ($distance < $currentClosestDistance) {
                    $closest = $food;
                }
                return $closest;
            },
            self::$food[0]
        );
        return $closestFood;
    }
}