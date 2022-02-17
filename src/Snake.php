<?php

namespace App;

use App\Vector;

class Snake {

  private $state;
  private $head, $neck;

  public function __construct()
  {
  }

  public function receiveState( $data )
  {
    $this->state = $data;
    $this->head = new Vector( $this->state->you->head );
    $this->neck = new Vector( $this->state->you->body[1] );
  }

  public function possibleMoves()
  {
    $moves = [];
    // Up
    if( $this->head->y < $this->state->board->height-1 )
    {
      if( $this->head->above()->isNot($this->neck) )
      {
        $moves[] = 'up';
      }
    }
    // Right
    if( $this->head->x < $this->state->board->width-1)
    {
      if( $this->head->right()->isNot($this->neck) )
      {
        $moves[] = 'right';
      }
    }
    // Down
    if( $this->head->y > 0 )
    {
      if( $this->head->below()->isNot($this->neck) )
      {
        $moves[] = 'down';
      }
    }
    // Left
    if( $this->head->x > 0 )
    {
      if( $this->head->left()->isNot($this->neck) )
      {
        $moves[] = 'left';
      }
    }
    // error_log("Head is at:");
    // error_log(print_r($this->head, true));
    // error_log("Moves:");
    // error_log(print_r($moves, true));
    return $moves;
  }

  public function randomMove()
  {
    return $this->possibleMoves()[array_rand($this->possibleMoves())];
  }
}