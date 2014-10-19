@extends('base.base')

@section('content')

{{-- first cell placed is at (0,MAXIMUM_Y) then (1, MAXIMUM_Y) --}}

{{-- loops over stages --}}
<?php $count=1 ?>
@foreach($gameBoardStages as $current_stage)
  <section class='stage'>
    <h3>Stage {{$count}}</h3>
    @include('tetris.gameBoard',array( 'gameBoard'=>$current_stage ))
  </section>
  <?php $count++ ?>
@endforeach

@endsection
