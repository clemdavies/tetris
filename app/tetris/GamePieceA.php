<?php

Namespace Tetris;

Class GamePieceA extends GamePiece {


  public function __construct(){
    parent::__construct(array(2,2));

    $this->fill_cell(0,0);
    $this->fill_cell(0,1);
    $this->fill_cell(1,1);
  }


  public function to_string(){
    return 'i am an object of class GamePieceA';
  }
}