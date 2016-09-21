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
          <th>Subject</th>
          <th>Teacher</th>
          <th>Grade</th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $section->resources as $resource )
          <tr>
            <td>{{ $resource->subject->name }}</td>
            <td>{{ $resource->teacher->full_name }}</td>
            <td>98.00</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@stop