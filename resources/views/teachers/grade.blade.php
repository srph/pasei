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
      <div class="form-group">
        <label for="pace_grade">PACE Grade</label>
        <input name="pace_grade" id="pace_grade" type="number" min="0" max="99" placeholder="e.g., 90" class="form-input" value="{{ $grade->pace_grade }}">
        @include('error', ['error' => 'pace_grade'])
      </div>

      @if ( $subject->has_conv )
        <div class="form-group">
          <label for="conv_grade">Conv Grade</label>
          <input name="conv_grade" id="conv_grade" type="number" min="0" max="99" placeholder="e.g., 85" class="form-input" value="{{ $grade->conv_grade }}">
          @include('error', ['error' => 'conv_grade'])
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

              <p id="status" class="form-placeholder">
                <span class="label label--danger" @if ( !$grade->isFailing($subject->has_conv) ) style="display: none"@endif>
                  Failing
                </span>
              </p>
            </div>
          </div>
        </div>
      @endif

      <button class="btn btn--primary">
        Grade
      </button>
    </div>
  </form>
@stop

@section('scripts')
  @if ( $subject->has_conv )
    <script>
      ;(function($) {
        var $pace = $('#pace_grade');
        var $conv = $('#conv_grade');
        var $final = $('#final');
        var $status = $('#status');

        $('form :input').on('change', function() {
          var pace = parseFloat($pace.val(), 10);
          var conv = parseFloat($conv.val() || 0, 10);
          var grade = ((pace * .9) + (conv * .1));

          $final.html(grade.toFixed(2));

          if ( grade < 75 ) {
            $status.fadeIn();
          } else {
            $status.fadeOut();
          }
        });
      })(jQuery);
    </script>
  @endif
@stop