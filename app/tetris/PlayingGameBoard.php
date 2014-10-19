<?php

Namespace Tetris;

Class PlayingGameBoard extends GameBoard{

  private $gameover = false;
  private $history_stages;

  private $pieces;

  public function __construct($params){
    parent::__construct($params);
    $this->create_pieces();
    $this->set_history_stages( new HistoryStages() );
  }

  public function start_playing( $player ){
    // listen for placement of piece.
    // when piece is placed, destroy lines, tally score and create next piece.
    // tell player to make their next move or gameover

    $moves_made = 0;

    while(!$this->gameover){

      $history = $this->history_stages->new_record();
      $this_piece = $this->next_piece();
      $history->pre_record($this,$this_piece);

      //$next_piece = next_piece();
      $res = $player->make_move($this,$this_piece);
      if ($res instanceof PlayingGameBoard) {
        $this->set_structure($res->get_structure());
      }else{
        $this->gameover = true;
      }

      $history->post_record($player);

      if ($moves_made == 10) {
        $this->gameover = true;
      }
      $moves_made++;
    }
  }

  public function next_piece(){
    $index = rand(0,count($this->pieces)-1);
    return $this->pieces[$index];
  }

  // create a controller for $this and gamepieces?
  public function create_pieces(){
    $this->pieces = array(
        new GamePieceA(),
        new GamePieceB()
      );
  }


  /* DEBUGGERS AND HELPERS */
  public function to_string(){

    $str  = 'i am an object of class PlayingGameBoard';
    $str .= '<br>';
    $str .= 'gameover -> '.$this->get_gameover();
    $str .= '<br>';
    $str .= $this->get_structure()->to_string();
    return $str;
  }

  /* GETTERS AND SETTERS */
  public function set_gameover( $new ){
    $this->gameover = $new;
  }
  public function get_gameover(){
    return $this->gameover;
  }
  public function set_history_stages( $new ){
    $this->history_stages = $new;
  }
  public function get_history_stages(){
    return $this->history_stages;
  }

}