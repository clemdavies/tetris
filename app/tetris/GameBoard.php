<?php

Namespace Tetris;

/*
  This uses the mathematical coordinate system.
  That being the bottom left cell is (0,0).
*/

Abstract Class GameBoard {

  private $structure;

  public function __construct( $dimensions = array() ){
    $this->set_structure( new \Structure\Cell( $dimensions ) );
  }

  /*
    Attempts to update the structure of this GameBoard with a piece.
    @returns Bool true if structure was updated with piece.
  */
  public function place_piece( $piece,$coordinates ){


    $cloneStructure = clone $this->get_structure();

    if ( !$this->piece_is_seated($piece,$coordinates) ) {
      return false;
    }


    for ( $piece_pointer_y = 0, $gameboard_pointer_y = $coordinates[1];
          $piece_pointer_y <= $piece->maximum_y();
          $piece_pointer_y++, $gameboard_pointer_y++ ) {

      for ( $piece_pointer_x = 0, $gameboard_pointer_x = $coordinates[0];
            $piece_pointer_x <= $piece->maximum_x();
            $piece_pointer_x++, $gameboard_pointer_x++ ) {
        if ($piece->get_cell($piece_pointer_x,$piece_pointer_y)) {
          if ( !$cloneStructure->fill_cell( $gameboard_pointer_x,$gameboard_pointer_y ) ) {
            // cell already occupied, discard changes.

            return false;
          }
        }else{
          // gamepiece has no cell at thise coord
        }
      }
    }
    $this->set_structure($cloneStructure);
    return true;
  }

  public function piece_is_seated($gamepiece,$coordinates){

    $gameboard_pointer_y=$coordinates[1] - 1;

    if ($gameboard_pointer_y < 0) {
      //piece is seated on bottom
      return true;
    }

    // grab all the lowest points of gamepiece
    $lowest_points = $gamepiece->get_lowest_points();

    //are any of the lowest points seated?
    foreach($lowest_points as $lowest_point){
      $gameboard_pointer_x = $coordinates[0] + $lowest_point[0] + 0;// x stays the same
      $gameboard_pointer_y = $coordinates[1] + $lowest_point[1] - 1;// y moves down 1 from lowest point
      if ($this->get_structure()->get_cell($gameboard_pointer_x,$gameboard_pointer_y)) {
        return true;
      }
    }
    return false;


    /*
    for ($gameboard_pointer_x = $coordinates[0], $piece_pointer_x = 0;
         $gameboard_pointer_x < ($coordinates[0] + $piece->get_structure()->get_DIMENSION_X() );
         $gameboard_pointer_x++, $piece_pointer_x++) {
      if($this->get_structure()->get_cell($gameboard_pointer_x,$gameboard_pointer_y) &&
         $piece->get_structure()->get_cell($piece_pointer_x,0) ){
        // piece seated on valid target
        return true;
      }
    }
    return false;
    */
  }


  /**
   * traverses from top left to bottom right
   **/
  public function process_cells_down($process,&$data){

    for ( $y = $this->get_structure()->get_DIMENSION_Y(); $y >= 0 ; $y-- ) {
      for ( $x = 0; $x < $this->get_structure()->get_DIMENSION_X(); $x++ ) {
        if ( !$process($x,$y,$this,$data) ){
          return false;
        }
      }
    }
    return true;
  }

  /**
   * traverses from bottom left to top right
   **/
  public function process_cells_up($process,&$data){
    for ( $y = 0; $y < $this->get_structure()->get_DIMENSION_Y(); $y++ ) {
      for ( $x = 0; $x < $this->get_structure()->get_DIMENSION_X(); $x++ ) {
        if ( !$process($x,$y,$this,$data) ){
          return false;
        }
      }
    }
    return true;
  }

  public function array_contains($search_array,$search_val){
    foreach($search_array as $current_aray_val ){
      if ($search_val == $current_aray_val) {
        echo 'already processed';
        return true;
      }
    }
    return false;
  }

  public function has_no_holes(){

    $data = array();
    $data['processed'] = array();


    $result = $this->process_cells_down(function($x,$y,$that,&$data){

      $processed = $data['processed'];
      $structure = $that->get_structure();

      if ($structure->get_cell($x,$y) && !$that->array_contains( $processed,array($x,$y) )) {
        //traverse down the Y axis until end
        for ($y -= 1; $y >= 0; $y--) {
          $processed[] = array($x,$y);
          // if empty hole is apparent
          if ($structure->coordinates_are_valid($x,$y) && !$structure->get_cell($x,$y) ) {
            return false;
          }
        }
      }

      return true;
    },$data);


    return $result;
  }

  /* GETTERS AND SETTERS */
  public function set_structure( $new ){
    $this->structure = $new;
  }
  public function get_structure(){
    return $this->structure;
  }

}