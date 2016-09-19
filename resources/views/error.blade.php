@if ( $errors->has($error) )
  <div class="pull-note">
    {{ $errors->first($error) }}
  </div>
@endif