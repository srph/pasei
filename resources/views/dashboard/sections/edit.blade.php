@extends('dashboard.layout')

@section('title')
  Edit Class ({{ $section->name }})
@stop

@section('content')
  <h1 class="u-spacer u-text-light">
    Edit Class ({{ $section->name }})
  </h1>

  <form action="{{ route('classes.update', $section->id) }}" method="POST">
    {{ method_field('PUT') }}

    <div class="u-size-5">
      <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" placeholder="Name" class="form-input" value="{{ $section->name }}">

        @include('error', ['error' => 'name'])
      </div>

      <div class="form-group">
        <label for="year_level">Year Level</label>

        <select name="year_level" id="year_level" class="form-input">
          @foreach(range(1, 4) as $level)
            <option value="{{ $level }}" @selected($level == $section->year_level)>
              {{ ordinal($level) }} Year
            </option>
          @endforeach
        </select>

        @include('error', ['error' => 'year_level'])
      </div>

      <div class="u-clearfix">
        <div class="u-pull-left">
          <a href="{{ route('classes.index') }}" class="btn">
            Cancel
          </a>
        </div>

        <div class="u-pull-right">
          <button class="btn btn--primary">
            Edit New Class
          </button>
        </div>
      </div>
    </div>
  </form>
@stop