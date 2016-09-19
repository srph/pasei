@if ( $errors->has($error) )
  <div class="pull-note pull-note--danger">
    <div class="pull-note__icon">
      <i class="fa fa-exclamation-circle"></i>
    </div>

    <div class="pull-note__text">
      {{ $errors->first($error) }}
    </div>
  </div>
@endif