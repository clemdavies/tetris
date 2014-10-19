<?php

Namespace Structure;


Class Cell implements CellInterface{

  private $DIMENSION_X;
  private $DIMENSION_Y;

  private $cells;


  public function __construct( $dimensions ){
    $this->set_cells(array());
    $this->init_dimensions($dimensions);
    $this->init_cells();
  }

  public function reconstruct( $dimensions ){
    $this->set_cells(array());
    $this->init_dimensions($dimensions);
    $this->init_cells();
  }

  public function init_dimensions( $dimensions ){
    if ( count($dimensions) == 2 ) {
      $this->DIMENSION_X = $dimensions[0];
      $this->DIMENSION_Y = $dimensions[1];
    }
  }

  public function init_cells(){
    for ($x=0; $x < $this->get_DIMENSION_X() ; $x++) {
      $this->cells[$x] = array();
      for ($y=0; $y < $this->get_DIMENSION_Y() ; $y++) {
        $this->cells[$x][$y] = 0;
      }
    }
  }

  public function rotate_clockwise(){

    $oldStructure = clone $this;

    $this->reconstruct( array($this->get_DIMENSION_Y(), $this->get_DIMENSION_X()) );
    $newStructure = $this;
    for ($old_X=0 , $new_Y = $newStructure->maximum_y() ; $old_X < $oldStructure->get_DIMENSION_X() ; $old_X++ , $new_Y-- ) {
      for ($old_Y=0, $new_X = 0; $old_Y < $oldStructure->get_DIMENSION_Y() ; $old_Y++, $new_X++) {
        if ( $oldStructure->get_cell($old_X,$old_Y) ) {
          $newStructure->fill_cell($new_X,$new_Y);
        }
      }
    }

  }

  public function rotate_anticlockwise(){

    $oldStructure = clone $this;

    $this->reconstruct( array($this->get_DIMENSION_Y(), $this->get_DIMENSION_X()) );
    $newStructure = $this;
    for ($old_X=0 , $new_Y=0 ; $old_X < $oldStructure->get_DIMENSION_X() ; $old_X++ , $new_Y++ ) {
      for ($old_Y=0, $new_X=$newStructure->maximum_x() ; $old_Y < $oldStructure->get_DIMENSION_Y() ; $old_Y++, $new_X--) {
        if ( $oldStructure->get_cell($old_X,$old_Y) ) {
          $newStructure->fill_cell($new_X,$new_Y);
        }
      }
    }
  }

  public function matches_any_other($others){
    foreach ($others as $other) {
      if ($this->matches_other($other)) {
        return true;
      }
    }
    return false;
  }

  public function matches_other($other){

    if ($this->get_DIMENSION_X() !== $other->get_DIMENSION_X() ||
        $this->get_DIMENSION_Y() !== $other->get_DIMENSION_Y()) {
      return false;
    }

    for ($y=0; $y < $this->get_DIMENSION_Y() ; $y++) {
      for ($x=0; $x < $this->get_DIMENSION_X() ; $x++) {
        if ($this->get_cell($x,$y) !== $other->get_cell($x,$y)) {
          return false;
        }
      }
    }
    return true;
  }

  public function maximum_x(){
    return $this->DIMENSION_X - 1;
  }

  public function maximum_y(){
    return $this->DIMENSION_Y - 1;
  }

  public function coordinates_are_valid($x,$y){
    if ( $x < 0 || $x >= count($this->cells) ){
      return false;
    }elseif( $y < 0 || $y >= count($this->cells[$x]) ) {
      return false;
    }else {
      return true;
    }

  }

  public function fill_cell( $x, $y ){
    if( $this->coordinates_are_valid($x,$y) && !$this->cells[$x][$y]) {
      $this->cells[$x][$y] = 1;
      return true;
    }else{
      return false;
    }

  }
  public function clear_cell( $x, $y ){
    $this->cells[$x][$y] = 0;
  }
  public function get_cell( $x, $y ){
    if( $this->coordinates_are_valid($x,$y) ) {
      return $this->cells[$x][$y];
    }else{
      return false;
    }
  }
  public function cell_on_off( $x, $y ){
    if ($this->get_cell($x,$y)) {
      return 'on';
    }else{
      return 'off';
    }
  }
  public function get_linear(){
    $linear = array();
    for ($y=0,$i=0; $y < $this->maximum_y() ; $y++) {
      for ($x=0; $x < $this->maximum_x() ; $x++,$i++) {
        $linear[$i]['x'] = $x;
        $linear[$i]['y'] = $y;
        $linear[$i]['value'] = $this->get_cell($x,$y);
      }
    }
    return $linear;
  }

  /* DEBUGGERS AND HELPERS */
  public function to_string(){
    return 'I am an object of type \Structure\Cell';
  }


  /* GETTERS AND SETTERS */
  public function get_cells(){
    return $this->cells;
  }
  public function set_cells($new){
    $this->cells = $new;
  }

  public function get_DIMENSION_X(){
    return $this->DIMENSION_X;
  }
  public function set_DIMENSION_X($new){
    $this->DIMENSION_X = $new;
  }

  public function get_DIMENSION_Y(){
    return $this->DIMENSION_Y;
  }
  public function set_DIMENSION_Y($new){
    $this->DIMENSION_Y = $new;
  }

}