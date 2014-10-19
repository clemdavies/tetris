
{{-- first cell placed is at (0,MAXIMUM_Y) then (1, MAXIMUM_Y) --}}

<section class='gameboard'>
  {{-- loops over Y axis --}}
@for($y=$gameBoard->get_structure()->maximum_y(); $y >= 0 ; $y--)

  {{-- loops over X axis within current Y --}}
  <section class="{{'Y-'.$y}}">
  @for($x=0; $x <= $gameBoard->get_structure()->maximum_x() ; $x++){{--

  --}}<div class="{{'X-'.$x}} {{$gameBoard->get_structure()->cell_on_off($x,$y)}}">{{--$gameBoard->get_structure()->get_cell($x,$y)--}}</div>{{--

  --}}@endfor
  </section>

@endfor
</section>
