@extends('dashboard.layout')

@section('title')
  Students
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-pull-left u-text-light">Students</h1>

    <div class="u-pull-right">
      <a href="{{ route('students.create') }}" class="btn btn--primary">
        Enroll New Student
      </a>
    </div>
  </div>

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
@stop