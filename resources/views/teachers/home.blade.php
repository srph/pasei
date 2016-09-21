@extends('teachers.layout')

@section('title')
  Hello, {{ Auth::user()->full_name }}
@stop

@section('content')
  @if ( !$resources->count() )
    <div class="u-size-6">
      @include('info', ['message' => 'It seems that you\'re not assigned to any classes this year.'])
    </div>
  @else
    @foreach ( $resources as $resource )
      <h3 class="u-text-light">Class {{ $resource->section->name }}</h3>
      <h5 class="u-text-light u-text-muted">{{ $resource->subject->name }}</h5>

      <table class="table">
        <thead>
          <tr>
            <th style="width: 700px;">Student</th>
            <th>Grade</th>
            <th style="width: 150px;"></th>
          </tr>
        </thead>

        <tbody>
          @foreach ( $resource->section->students as $student )
            <tr>
              <td>{{ $student->full_name }}</td>
              <td>
                @if ( null == $student->pace_grade ) 
                  <span class="label label--primary">
                    Ungraded
                  </span>
                @else
                  {{ $student->grade }}
                @endif
              </td>

              <td>
                <a href="{{ route('grades.edit', ['subject' => $resource->subject->id, 'student' => $student->id ]) }}" class="btn">
                  Grade
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      @if ( !$loop->last )
        <hr class="u-spacer-large">
      @endif
    @endforeach
  @endif
@stop