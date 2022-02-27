<?php

use App\Snake;
use App\Vector;
use App\GameState;

beforeEach(function()
{
    $json_data = file_get_contents('tests/datasets/find-food/turn-099.json');

    GameState::load($json_data);
});


it('has correct board size', function ()
{
    expect(GameState::width())->toBe(19);
    expect(GameState::height())->toBe(19);
});


it('has one snake', function ()
{
    expect(GameState::snakes())->toBeArray();
    expect(GameState::snakes())->toHaveCount(1);
});


it('has "you" snake of length 3', function ()
{
    expect(GameState::you())->toBeInstanceOf(Snake::class);
    expect(GameState::you()->length())->toBe(3);
});


it('has no enemies', function ()
{
    expect(GameState::enemies())->toBeArray();
    expect(GameState::enemies())->toHaveCount(0);
});


it('has two food', function ()
{
    expect(GameState::food())->toBeArray();
    expect(GameState::hasFood())->toBe(true);
    expect(GameState::food())->toHaveCount(2);
});


it('has no hazards', function ()
{
    expect(GameState::hazards())->toBeArray();
    expect(GameState::hazards())->toHaveCount(0);
});


test('closest food is 19 squares away', function ()
{
    $closestFood = GameState::closestFood();

    expect(GameState::you()->head()->distanceTo($closestFood))->toBe(19);
});


it('moves towards closest food', function ()
{
    $move = GameState::you()->moveTowardClosestFood();
    expect($move)->toBeIn(['right','down']);
});
