<?php

declare(strict_types=1);

namespace App;

class GameState
{
    private static object $state;
    private static ?Snake $you;

    public static function load( string $state_json ) : void
    {
        self::$state = json_decode($state_json);
        self::$you = new Snake(self::$state->you);
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
        return self::$state->board->snakes;
    }


    public static function you() : Snake
    {
        return self::$you;
    }
}