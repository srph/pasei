@extends('students.layout')

@section('title')
  Hello, {{ Auth::user()->full_name }}
@stop

@section('content')
  @if ( null == $section )
    <div class="u-size-6">
      @include('info', ['message' => 'It seems that you\'re not enrolled to any classes this year.'])
    </div>
  @else
    <h4 class="u-text-light">Class {{ $section->name }}</h4>

    <table class="table">
      <thead>
        <tr>
          <th style="width: 350px;">Subject</th>
          <th>Teacher</th>
          <th style="width: 150px;">Grade</th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $section->resources as $resource )
          <tr>
            <td>{{ $resource->subject->name }}</td>
            <td>{{ $resource->teacher->full_name }}</td>
            <td>
                @if ( null == $resource->subject->pace_grade ) 
                  <span class="label label--primary">
                    Ungraded
                  </span>
                @else
                  {{ $resource->subject->grade }}

                  @if ( $resource->subject->is_failing )
                    <span class="label label--danger" style="margin-left: 20px;">
                      Failing
                    </span>
                  @endif
                @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@stop