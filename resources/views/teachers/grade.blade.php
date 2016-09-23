@extends('teachers.layout')

@section('title')
  Grade {{ Auth::user()->full_name }}
@stop

@section('content')
  <h3 class="u-text-light">
    Grade {{ $student->full_name }}
  </h3>

  <h5 class="u-text-light u-text-muted u-spacer">
    Class {{ $resource->section->name }} &mdash;
    <strong>{{ $subject->name }}</strong>
  </h5>

  <form action="{{ route('grades.update', ['subject' => $subject->id, 'student' => $student->id ]) }}" method="POST">
    {{ method_field('PUT') }}

    <div class="u-size-5">
      @if ( !$subject->is_conventional )
        <div class="form-group">
          <label for="pace_grade">PACE Grade</label>
          <input name="pace_grade" id="pace_grade" type="number" min="0" max="99" placeholder="e.g., 90" class="form-input" value="{{ $grade->pace_grade }}">
          @include('error', ['error' => 'pace_grade'])
        </div>

        <div class="form-group">
          <label for="conventional_grade">Conventional Grade</label>
          <input name="conventional_grade" id="conventional_grade" type="number" min="0" max="99" placeholder="e.g., 85" class="form-input" value="{{ $grade->conventional_grade }}">
          @include('error', ['error' => 'conventional_grade'])
        </div>

        <div class="grid">
          <div class="grid__cell u-size-6">
            <div class="form-group">
              <label>Final Grade</label>
              <p id="final" class="form-placeholder">{{ $grade->final_grade }}</p>
            </div>
          </div>

          <div class="grid__cell u-size-6">
            <div class="form-group">
              <label>&nbsp;</label>

              <p class="form-placeholder">
                <span id="status" class="label label--danger" @if ( !$grade->isFailing($subject->is_conventional) ) style="opacity: 0"@endif>
                  Failing
                </span>
              </p>
            </div>
          </div>
        </div>
      @else
        <div class="form-group">
          <label for="conventional_grade">Grade</label>
          <input name="conventional_grade" id="conventional_grade" type="number" min="0" max="99" placeholder="e.g., 85" class="form-input" value="{{ $grade->conventional_grade }}">
          @include('error', ['error' => 'conventional_grade'])
        </div>

        <div class="form-group">
          <span id="status" class="label label--danger" @if ( !$grade->isFailing($subject->is_conventional) ) style="opacity: 0" @endif>
            Failing
          </span>
        </div>
      @endif

      <button class="btn btn--primary">
        Grade
      </button>
    </div>
  </form>
@stop

@section('scripts')
  @if ( !$subject->is_conventional )
    <script>
      ;(function($) {
        var $pace = $('#pace_grade');
        var $conv = $('#conventional_grade');
        var $final = $('#final');
        var $status = $('#status');

        $('form :input').on('change', function() {
          var pace = parseFloat($pace.val() || 0, 10);
          var conv = parseFloat($conv.val(), 10);
          var grade = ((pace * .9) + (conv * .1));

          $final.html(grade.toFixed(2));

          if ( grade < 75 ) {
            $status.animate({ opacity: 1 });
          } else {
            $status.animate({ opacity: 0 });
          }
        });
      })(jQuery);
    </script>
  @else
    <script>
      ;(function($) {
        var $conv = $('#conventional_grade');
        var $status = $('#status');

        $('form :input').on('change', function() {
          var grade = parseFloat($conv.val(), 10);
          console.log(grade);

          if ( grade < 75 ) {
            console.log('in');
            $status.animate({ opacity: 1   });
          } else {
            $status.animate({ opacity: 0 });
          }
        });
      })(jQuery);
    </script>
  @endif
@stop