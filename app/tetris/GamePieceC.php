<?php

Namespace Tetris;

Class GamePieceC extends GamePiece {


  public function __construct(){
    parent::__construct(array(3,3));

    $this->get_structure()->fill_cell(0,0);
    //$this->get_structure()->fill_cell(1,0);
    $this->get_structure()->fill_cell(2,0);
    $this->get_structure()->fill_cell(0,1);
    $this->get_structure()->fill_cell(1,1);
    $this->get_structure()->fill_cell(2,1);
    $this->get_structure()->fill_cell(0,2);
    $this->get_structure()->fill_cell(1,2);
    $this->get_structure()->fill_cell(2,2);
  }


  public function to_string(){
    return 'i am an object of class GamePieceA';
  }
}