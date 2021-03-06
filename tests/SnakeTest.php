<?php

namespace App;

use App\Snake;


beforeEach(function()
{
    GameState::load(file_get_contents('tests/datasets/avoid-walls/turn-003.json'));
});


test('bottom right is not snake', function()
{
    $vector = new Vector(4, 4);
    expect(GameState::you()->occupies($vector))->toBe(false);
});


test('top left is not snake', function()
{
    $vector = new Vector(0, 0);
    expect(GameState::you()->occupies($vector))->toBe(false);
});


test('known snake squares are found', function()
{
    $head = new Vector(0, 1);
    $body = new Vector(1,1);
    $tail = new Vector(2,1);
    expect(GameState::you()->occupies($head))->toBe(true);
    expect(GameState::you()->occupies($body))->toBe(true);
    expect(GameState::you()->occupies($tail))->toBe(true);
});

test('possible moves are correct', function()
{
    $possibleMoves = GameState::you()->possibleMoves();

    expect($possibleMoves)->toBeArray();
    expect($possibleMoves)->toHaveCount(2);
    expect(in_array('up', $possibleMoves))->toBe(true);
    expect(in_array('down', $possibleMoves))->toBe(true);
});
