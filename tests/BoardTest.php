<?php

use App\Snake;
use App\Vector;
use App\GameState;

beforeEach(function()
{
    $json_data = file_get_contents('tests/datasets/avoid-other-battlesnakes/startdata.json');

    GameState::load($json_data);
});


it('has correct board size', function ()
{
    expect(GameState::width())->toBe(11);
    expect(GameState::height())->toBe(11);
});


it('has five snakes', function ()
{
    expect(GameState::snakes())->toBeArray();
    expect(count(GameState::snakes()))->toBe(5);
});


it('has "you" snake of length 5', function ()
{
    expect(GameState::you())->toBeInstanceOf(Snake::class);
    expect(GameState::you()->length())->toBe(5);
});


it('has empty cells where expected', function ()
{
    expect(GameState::isEmpty(new Vector(0, 10)))->toBe(true);
    expect(GameState::isEmpty(new Vector(4, 3)))->toBe(true);
    expect(GameState::isEmpty(new Vector(8, 8)))->toBe(true);
    expect(GameState::isEmpty(new Vector(10, 0)))->toBe(true);
});


it('has four enemies', function ()
{
    expect(GameState::enemies())->toBeArray();
    expect(count(GameState::enemies()))->toBe(4);
});
