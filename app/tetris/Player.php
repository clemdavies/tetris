<?php

Namespace Tetris;

Class Player {

  // holds instances of GameBoard
  // all possible moves
  private $possible_moves;
  // moves that are commited to playing game board
  private $committed_moves;

  private $move_choices;


  public function __construct(){
    $this->set_possible_moves(array());
  }
  public function reset(){
    $this->set_possible_moves(array());
    $this->set_move_choices(array());
  }

  public function make_move($gameBoard,$gamePiece){
    $this->reset();
    // enforce gamePiece must lie within gameBoard constraints.
    // rotate first then select coords for placement

    //$coordinates = array(4,1);
    //$gamePiece->rotate_clockwise();
    //$gameBoard->place_piece($gamePiece,$coordinates);


    $this->find_possible_moves($gameBoard,$gamePiece);

    if (!count($this->get_possible_moves())) {
      return false;
    }

    $this->choose_move();

    if (!count($this->get_move_choices())) {
      return false;
    }

    return $this->get_last_move();
  }

  public function find_possible_moves($gameBoard,$gamePiece){
    // iterate over possible landing positions only

    $rotatedStructures = array();

    for ($orientation=0; $orientation < 4 ; $orientation++) {

      if (!$gamePiece->get_structure()->matches_any_other($rotatedStructures)) {
        for ($x=0; $x <= $gameBoard->get_structure()->maximum_x(); $x++) {
          for ($y=0; $y <= $gameBoard->get_structure()->maximum_y() ; $y++) {
            $cloneGameBoard = clone $gameBoard;
            if ( $cloneGameBoard->place_piece( $gamePiece, array($x,$y) ) ) {
              $this->add_possability( $cloneGameBoard );
            }

          }
        }
      }
      $rotatedStructures[] = clone $gamePiece->get_structure();
      $gamePiece->rotate_clockwise();
    }

  }

  public function choose_move(){


    // best placements:
    // leave room for other pieces
    // dont leave holes
    foreach ($this->get_possible_moves() as $possability) {
      if ($possability->has_no_holes()) {

        $this->add_move_choice($possability);

      }
    }
    //choses random choice
    if (count($this->get_move_choices())) {
      $index = rand( 0,count($this->get_move_choices())-1 );
      $this->add_committed_move($this->move_choices[$index]);
    }
  }


  public function to_string(){

    return 'i am an object of class Player';
  }


  public function get_last_move(){
    return $this->committed_moves[ count($this->get_committed_moves()) - 1 ];
  }

  public function add_possability($add){
    $this->possible_moves[] = $add;
  }
  public function add_committed_move($add){
    $this->committed_moves[] = $add;
  }
  public function add_move_choice($add){
    $this->move_choices[] = $add;
  }

  public function get_possible_moves(){
    return $this->possible_moves;
  }
  public function set_possible_moves($new){
    $this->possible_moves = $new;
  }

  public function get_committed_moves(){
    return $this->committed_moves;
  }
  public function set_committed_moves($new){
    $this->committed_moves = $new;
  }

  public function get_move_choices(){
    return $this->move_choices;
  }
  public function set_move_choices($new){
    $this->move_choices = $new;
  }

}