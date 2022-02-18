<?php

namespace App;

use App\Vector;

it('can create a vector with two ints', function()
{
    $vector = new Vector(1, 2);

    expect($vector)->toBeInstanceOf(Vector::class);
});

it('can add two vectors', function()
{
    $vector1 = new Vector(1, 2);
    $vector2 = new Vector(3, 4);
    $vector3 = $vector1->add($vector2);

    expect($vector3)->toBeInstanceOf(Vector::class);
    expect($vector3->x)->toBe(4);
    expect($vector3->y)->toBe(6);
});

it('can calculate distance to another vector', function()
{
    $vector1 = new Vector(0, 0);
    $vector2 = new Vector(5, 5);

    expect($vector1->distanceTo(new Vector(0, 1)))->toBe(1);
    expect($vector1->distanceTo(new Vector(1, 0)))->toBe(1);
    expect($vector1->distanceTo(new Vector(1, 1)))->toBe(2);

    expect($vector2->distanceTo(new Vector(7, 3)))->toBe(4);
    expect($vector2->distanceTo(new Vector(2, 9)))->toBe(7);
    expect($vector2->distanceTo(new Vector(5, 4)))->toBe(1);

    expect($vector2->distanceTo(new Vector(0, 1)))->toBe(9);
    expect($vector2->distanceTo(new Vector(1, 0)))->toBe(9);
    expect($vector2->distanceTo(new Vector(1, 1)))->toBe(8);
});
