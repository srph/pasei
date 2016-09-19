@extends('dashboard.layout')

@section('title')
  Add Subject to {{ $section->name }}
@stop

@section('content')
  <h1 class="u-spacer u-text-light">
    Add Subject to {{ $section->name }}
  </h1>

  <form action="{{ route('classes.subjects.store', $section->id) }}" method="POST">
    <div class="u-size-5">
      <div class="form-group">
        <label for="subject_id">Subject</label>
        
        <select id="subject_id" name="subject_id" class="form-input">
          @if ( !$subjects->count() )
            <option>No assignable subject</option>
          @else
            <option>Select a subject</option>

            @foreach ( $subjects as $subject )
              <option value="{{ $subject->id }}" @selected($subject->id == old('subject_id'))>
                {{ $subject->name }}
              </option>
            @endforeach
          @endif
        </select>

        @include('error', ['error' => 'subject_id'])
      </div>

      <div class="form-group">
        <label for="user_id">Teacher</label>

        <select id="user_id" name="user_id" class="form-input">
          @if ( !$teachers->count() )
            <option>No assignable teacher</option>
          @else
            <option>Select a teacher</option>

            @foreach ( $teachers as $teacher )
              <option value="{{ $teacher->id }}" @selected($teacher->id == old('user_id'))>
                {{ $teacher->full_name }}
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
            Add Subject
          </button>
        </div>
      </div>
    </div>
  </form>
@stop