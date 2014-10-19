<?php

Namespace Structure;

Interface CellInterface{

  public function reconstruct( $dimensions );
  public function init_dimensions( $dimensions );
  public function init_cells();
  public function rotate_clockwise();
  public function rotate_anticlockwise();
  public function maximum_x();
  public function maximum_y();
  public function fill_cell( $x, $y );
  public function clear_cell( $x, $y );
  public function get_cell( $x, $y );
  public function cell_on_off( $x, $y );
}