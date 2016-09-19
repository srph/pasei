@extends('dashboard.layout')

@section('title')
  Add New Class
@stop

@section('content')
  <h1 class="u-spacer u-text-light">Add New Class</h1>

  <form action="{{ route('classes.store') }}" method="POST">
    <div class="u-size-5">
      <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" placeholder="Name" class="form-input" value="{{ old('name') }}">

        @include('error', ['error' => 'name'])
      </div>

      <div class="form-group">
        <label for="year_level">Year Level</label>

        <select name="year_level" id="year_level" class="form-input">
          @foreach(range(1, 4) as $level)
            <option value="{{ $level }}" @selected($level == old('year_level'))>
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
            Add New Class
          </button>
        </div>
      </div>
    </div>
  </form>
@stop