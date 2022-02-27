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
    expect(GameState::snakes())->toHaveCount(5);
});


it('has "you" snake of length 5', function ()
{
    expect(GameState::you())->toBeInstanceOf(Snake::class);
    expect(GameState::you()->length())->toBe(5);
});


it('has empty cells where expected', function ()
{
    expect(GameState::isSafe(new Vector(0, 10)))->toBe(true);
    expect(GameState::isSafe(new Vector(4, 3)))->toBe(true);
    expect(GameState::isSafe(new Vector(8, 8)))->toBe(true);
    expect(GameState::isSafe(new Vector(10, 0)))->toBe(true);
});


it('has four enemies', function ()
{
    expect(GameState::enemies())->toBeArray();
    expect(GameState::enemies())->toHaveCount(4);
});


it('has no food', function ()
{
    expect(GameState::food())->toBeArray();
    expect(GameState::hasFood())->toBe(false);
    expect(GameState::food())->toHaveCount(0);
});


it('has no hazards', function ()
{
    expect(GameState::hazards())->toBeArray();
    expect(GameState::hazards())->toHaveCount(0);
});
