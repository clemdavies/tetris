<?php

Namespace Tetris;

Class GamePieceB extends GamePiece {


  public function __construct(){
    parent::__construct(array(3,1));

    $this->get_structure()->fill_cell(0,0);
    $this->get_structure()->fill_cell(1,0);
    $this->get_structure()->fill_cell(2,0);
  }


  public function to_string(){
    return 'i am an object of class GamePieceA';
  }
}