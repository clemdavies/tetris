@extends('base.base')

@section('content')

{{-- first cell placed is at (0,MAXIMUM_Y) then (1, MAXIMUM_Y) --}}

{{-- loops over stages --}}
<?php $count=1 ?>
@foreach($history->get_stages() as $current_stage)
  <section class='stage'>
    <h3>Stage {{$count}}</h3>
    <h4>Gameboard State</h4>
    @include('tetris.gameBoard',array('gameBoard'=>$current_stage->get_gameboard()))
    <br />

    <h4>GamePiece</h4>
      @include('tetris.gameBoard',array('gameBoard'=>$current_stage->get_gamepiece()))
    <br />

    <h4>Possible Moves ({{count($current_stage->get_possible_moves())}})</h4>
      @foreach($current_stage->get_possible_moves() as $possible_move)
        @include('tetris.gameBoard',array('gameBoard'=>$possible_move) )
        <br />
      @endforeach
    <br />

    <h4>Move Choices ({{count($current_stage->get_move_choices())}})</h4>
      @foreach($current_stage->get_move_choices() as $move_choice)
        @include('tetris.gameBoard',array('gameBoard'=>$move_choice) )
        <br />
      @endforeach
    <br />

    <h4>Chosen Move</h4>
      @include('tetris.gameBoard',array('gameBoard'=>$current_stage->get_committed_move()) )

    {{-- @include('tetris.gameBoard',array( 'gameBoard'=>$current_stage )) --}}
  </section>
  <?php $count++ ?>
@endforeach

@endsection
