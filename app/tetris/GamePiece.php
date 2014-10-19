<?php

Namespace Tetris;
Use Structure\CellInterface;

Class GamePiece implements CellInterface{

  private $structure;

  public function __construct( $dimensions = array() ){
    $this->set_structure( new \Structure\Cell( $dimensions ) );
  }

  public function reconstruct( $dimensions ){
    $this->get_structure()->reconstruct($dimensions);
  }

  public function init_dimensions( $dimensions ){
    $this->get_structure()->init_dimensions($dimensions);

  }
  public function init_cells(){
    $this->get_structure()->init_cells();
  }


  /* DEBUGGERS AND HELPERS */
  public function to_string(){
    return 'i am an object of class GamePiece';
  }

  public function rotate_clockwise(){
    $this->get_structure()->rotate_clockwise();
  }
  public function rotate_anticlockwise(){
    $this->get_structure()->rotate_anticlockwise();
  }
  public function maximum_x(){
    return $this->get_structure()->maximum_x();
  }

  public function maximum_y(){
    return $this->get_structure()->maximum_y();
  }

  public function fill_cell( $x, $y ){
    return $this->get_structure()->fill_cell($x,$y);
  }
  public function clear_cell( $x, $y ){
    return $this->get_structure()->clear_cell($x,$y);
  }
  public function get_cell( $x, $y ){
    return $this->get_structure()->get_cell($x,$y);
  }
  public function cell_on_off( $x, $y ){
    return $this->get_structure()->cell_on_off($x,$y);
  }
  public function get_lowest_points(){
    $structure = $this->get_structure();

    $lowest_points = array();

    for ($x=0; $x < $structure->get_DIMENSION_X(); $x++) {
      for ($y=0; $y < $structure->get_DIMENSION_Y(); $y++) {
        if ($structure->get_cell($x,$y)) {
          $lowest_points[] = array($x,$y);
          break;
        }
      }
    }
    return $lowest_points;
  }


  /* GETTERS AND SETTERS */


  public function set_structure( $new ){
    $this->structure = $new;
  }
  public function get_structure(){
    return $this->structure;
  }
}