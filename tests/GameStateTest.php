<?php

use App\Snake;
use App\GameState;

beforeEach(function()
{
    $json_data = file_get_contents('tests/datasets/avoid-walls/startdata.json');

    GameState::load($json_data);
});


it('has correct board size', function ()
{
    expect(GameState::width())->toBe(5);
    expect(GameState::height())->toBe(5);
});


it('has one snake', function ()
{
    expect(GameState::snakes())->toBeArray();
    expect(count(GameState::snakes()))->toBe(1);
});


it('has "you" snake of length 3', function ()
{
    expect(GameState::you())->toBeInstanceOf(Snake::class);
    expect(GameState::you()->length())->toBe(3);
});
