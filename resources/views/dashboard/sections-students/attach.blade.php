@extends('dashboard.layout')

@section('title')
  Add Student to {{ $section->name }}
@stop

@section('content')
  <h1 class="u-spacer u-text-light">
    Add Student to {{ $section->name }}
  </h1>

  <form action="{{ route('classes.students.store', $section->id) }}" method="POST">
    <div class="u-size-5">
      <div class="form-group">
        <label for="user_id">Student</label>
        
        <select id="user_id" name="user_id" class="form-input">
          @if ( !$users->count() )
            <option>No assignable student</option>
          @else
            <option>Select a student</option>

            @foreach ( $users as $user )
              <option value="{{ $user->id }}" @selected($user->id == old('user_id'))>
                {{ $user->full_name }}
              </option>
            @endforeach
          @endif
        </select>

        @include('error', ['error' => 'user_id'])
      </div>

      <div class="u-clearfix">
        <div class="u-pull-left">
          <a href="{{ route('classes.show', $section->id) }}" class="btn">
            Cancel
          </a>
        </div>

        <div class="u-pull-right">
          <button class="btn btn--primary">
            Add Student
          </button>
        </div>
      </div>
    </div>
  </form>
@stop