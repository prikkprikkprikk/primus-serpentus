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
