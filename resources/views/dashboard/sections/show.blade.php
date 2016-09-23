@extends('dashboard.layout')

@section('title')
  Class {{ $section->name }}
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-text-gray u-text-light u-pull-left">
      Class {{ $section->name }}
    </h1>

    <div class="u-pull-right">
      <a href="{{ route('classes.edit', $section->id) }}" class="btn btn--primary">
        Edit Information
      </a>
    </div>
  </div>

  <div class="tabs u-spacer">
    <a href="{{ route('classes.show', $section->id) }}" class="tabs__link tabs__link--active">
      Students
    </a>

    <a href="{{ route('classes.subjects.index', $section->id) }}" class="tabs__link">
      Subjects
    </a>
  </div>

  @if( !$students->count() )
    <div class="u-size-6">
      @include('info', [
        'message' => 'It looks like this class doesn\'t have any students yet.' .
        '<br /><a href="' . route('classes.students.attach', $section->id). '" class="pull-note__link">' .
        'Add a student to this class</a>.'
      ])
    </div>
  @else
    <div class="u-clearfix u-spacer">
      <a href="{{ route('classes.students.attach', $section->id) }}" class="u-pull-right btn btn--primary">
        Add Student
      </a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th style="width: 200px;">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $students as $student )
          <tr>
            <td>
              {{ $student->full_name }}
            </td>

            <td>
              <a href="{{ route('students.show', $student->id) }}" class="btn">
                View
              </a>

              <form action="{{ route('classes.students.detach', ['class' => $section->id, 'student' => $student->id ]) }}" method="POST" style="display: inline-block;">
                {{ method_field('DELETE') }}

                <button class="btn btn--plain-danger">
                  Remove
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@stop