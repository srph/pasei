@extends('dashboard.layout')

@section('title')
  {{ $user->full_name }}
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-text-gray u-text-light u-pull-left">
      {{ $user->full_name }}
    </h1>

    <div class="u-pull-right">
      <a href="{{ route('students.edit', $user->id) }}" class="btn btn--primary">
        Edit Information
      </a>
    </div>
  </div>

  @if( !$user->sections->count() )
    <div class="u-size-6">
      @include('info', ['message' => 'It looks like this student isn\'t assigned to any class yet.'])
    </div>
  @else
    <table class="table">
      <thead>
        <tr>
          <th style="width: 400px;">Class</th>
          <th style="width: 150px;"></th>
          <th>Year Level</th>
          <th style="width: 150px;">School Year</th>
          <th style="width: 150px;"></th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $user->sections as $index => $section )
          <tr>
            <td>
              {{ $section->name }}
            </td>

            <td>
              @if ( $index === 0 )
                <span class="label label--primary">
                  Current
                </span>
              @endif
            </td>

            <td> 
              {{ $section->year_level_formatted }}
            </td>

            <td>
              {{ $section->school_year }}
            </td>

            <td>
              <a href="{{ route('classes.show', $section->id) }}" class="btn">
                View
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@stop