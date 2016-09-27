@extends('dashboard.layout')

@section('title')
  Home
@stop

@section('content')
  <h4 class="u-text-center u-text-light u-spacer">Rate of Passing Students</h4>
  <svg class="chart u-block-center u-spacer-large" style="display: block;">
  </svg>

  <hr class="u-spacer-large">

  <div class="u-text-center u-spacer-large">
    <p class="lead">Simplicity is the ultimate sophistication.</p>
    <h5>Leonardo da Vinci</h5>
  </div>
@stop

@section('scripts')
  <script>
    ;(function() {
      var grades = {!! $grades !!};

      var tip = new d3tipy({ format: (d) => d3.format(',')(d.value) });

      console.log(tip.show);

      new d3bar({
        target: $('svg')[0],
        barPadding: 1,
        width: 400,
        height: 150,
        // margin: { top: 15, right: 100, bottom: 35, left: 60 },
        // tickSize: 5,
        // barPadding: 30,
        nice: true,
        // type: ' rounded-rect',
        mouseover: tip.show,
        mouseout: tip.hide
      }).update(transform());

      function transform() {
        return Object.keys(grades)
          .map(function(key) {
            return {
              bin: key,
              value: grades[key]
            };
          });
      }
    })();
  </script>
@stop