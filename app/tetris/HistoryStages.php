<?php

Namespace Tetris;

Class HistoryStages {

  private $stages;

  private $stage_count;

  public function __construct(){
    $this->stages = array();
    $this->stage_count = 0;
  }

  public function new_record(){
    $this->stage_count++;
    $stage = new History($this->stage_count);
    $this->add_stage( $stage );
    return $stage;
  }

  public function add_stage($add){
    $this->stages[] = $add;
  }

  public function set_stages($new){
    $this->stages = $new;
  }
  public function get_stages(){
    return $this->stages;
  }


}