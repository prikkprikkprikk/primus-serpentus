<?php

use App\Snake;
use App\Vector;
use App\GameState;

define('APP_ROOT', __DIR__ . '/..');
include_once('src/monolog.php');

beforeEach(function()
{
    $json_string = file_get_contents('tests/datasets/tester-state.json');

    GameState::load($json_string);
});


it('has correct board size', function ()
{
    expect(GameState::width())->toBe(11);
    expect(GameState::height())->toBe(11);
});


it('has two snakes', function ()
{
    expect(GameState::snakes())->toBeArray();
    expect(count(GameState::snakes()))->toBe(2);
});


it('has "you" snake of length 4', function ()
{
    expect(GameState::you())->toBeInstanceOf(Snake::class);
    expect(GameState::you()->length())->toBe(4);
});

it('has one enemy snake of length 4', function ()
{
    expect(GameState::enemies())->toBeArray();
    expect(GameState::enemies()[0])->toBeInstanceOf(Snake::class);
    expect(GameState::enemies()[0]->length())->toBe(4);
});

it('has one food at 5, 5', function ()
{
    $food = GameState::food()[0];
    expect(GameState::food())->toBeArray();
    expect(GameState::food())->toHaveLength(1);
    expect($food)->toBeInstanceOf(Vector::class);
    expect($food->x)->toBe(5);
    expect($food->y)->toBe(5);
});
