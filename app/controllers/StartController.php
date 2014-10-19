<?php


Class StartController extends BaseController{


  public function get_index(){


    $gameBoard  = new PlayingGameBoard(array(5,6));

    $gameBoard->get_structure()->fill_cell(1,0);
    $gameBoard->get_structure()->fill_cell(1,1);
    $gameBoard->get_structure()->fill_cell(1,2);

    $player = new Player();


    $gameBoard->start_playing($player);

    return View::make('tetris/gameboard_history')->with('history',$gameBoard->get_history_stages());


    /*
    Event::listen('tetris.drop', function($gameBoard)
    {
      $gameBoard->fill_cell(0,0);
      $gameBoard->fill_cell(1,0);
      $gameBoard->fill_cell(2,0);
      $gameBoard->fill_cell(1,1);
    });
    Event::fire('tetris.drop',array($gameBoard));
    */
  }

}