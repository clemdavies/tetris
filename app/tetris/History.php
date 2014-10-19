<?php

Namespace Tetris;

Class History {

  private $stage_number;

  private $gameboard;
  private $gamepiece;
  private $possible_moves;
  private $move_choices;
  private $committed_move;


  public function __construct($stage_number){
    $this->stage_number = $stage_number;
  }



  public function pre_record($gameboard,$gamepiece){
    $this->set_gameboard(clone $gameboard);
    $this->set_gamepiece($gamepiece);
  }
  public function post_record($player){
    $this->set_possible_moves($player->get_possible_moves());
    $this->set_committed_move($player->get_last_move());
    $this->set_move_choices($player->get_move_choices());
  }

  public function set_gameboard($new){
    $this->gameboard = $new;
  }
  public function get_gameboard(){
    return $this->gameboard;
  }

  public function set_gamepiece($new){
    $this->gamepiece = $new;
  }
  public function get_gamepiece(){
    return $this->gamepiece;
  }

  public function set_possible_moves($new){
    $this->possible_moves = $new;
  }
  public function get_possible_moves(){
    return $this->possible_moves;
  }

  public function set_committed_move($new){
    $this->committed_move = $new;
  }
  public function get_committed_move(){
    return $this->committed_move;
  }

  public function set_stage_number($new){
    $this->stage_number = $new;
  }
  public function get_stage_number(){
    return $this->stage_number;
  }

  public function set_move_choices($new){
    $this->move_choices = $new;
  }
  public function get_move_choices(){
    return $this->move_choices;
  }


}