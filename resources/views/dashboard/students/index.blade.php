@extends('dashboard.layout')

@section('title')
  Students
@stop

@section('content')
  <div class="menu u-spacer">
    <h1 class="u-text-light">
      Students
    </h1>

    <div class="menu__section">
      <div class="menu__section-item">
        <form action="{{ route('students.index') }}">
          <label class="form-input-group">
            <input type="text" class="form-input-group__input" name="query" value="{{ $query }}" placeholder="Search for a student by name (e.g., John)" style="min-width: 350px;">

            <div class="form-input-group__button">
              <button class="plain-btn">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </label>
        </form>
      </div>

      <div class="menu__section-item">
        <a href="{{ route('students.create') }}" class="btn btn--primary">
          Enroll New Student
        </a>
      </div>
    </div>
  </div>

  <div class="u-spacer">
    <table class="table">
      <thead>
        <tr>
          <th style="width: ">Name</th>
          <th>Year Level</th>
          <th style="width: 150px;">Current Class</th>
          <th style="width: 200px;">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $users as $user )
          <tr>
            <td>
              {{ $user->full_name }}
            </td>

            <td>
              {{ $user->last_section ? $user->last_section->year_level_formatted : '' }}
            </td>

            <td>
              @if ( $user->current_section )
                <a href="{{ route('classes.show', $user->current_section->id) }}">
                  {{ $user->current_section->name }}
                </a>
              @else
                <span class="label label--danger">
                  Unenrolled
                </span>
              @endif
            </td>

            <td>
              <a href="{{ route('students.show', $user->id) }}" class="btn">
                View
              </a>

              <a href="{{ route('students.edit', $user->id) }}" class="btn">
                Edit
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $users->appends(['query' => $query])->links('pagination') }}
@stop