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
      <a href="{{ route('teachers.edit', $user->id) }}" class="btn btn--primary">
        Edit Information
      </a>
    </div>
  </div>

  <div class="tabs u-spacer">
    <a href="{{ route('teachers.show', $user->id) }}" class="tabs__link tabs__link--active">
      Classes
    </a>

    <a href="{{ route('teachers.remove', $user->id) }}" class="tabs__link">
      Removal
    </a>
  </div>

  @if( !$resources->count() )
    <div class="u-size-6">
      @include('info', ['message' => 'It looks like this teacher isn\'t assigned to any class and subject yet.'])
    </div>
  @else
    <table class="table">
      <thead>
        <tr>
          <th style="width: 200px;">Class</th>
          <th style="width: 100px;"></th>
          <th style="width: 200px;">Subject</th>
          <th>Year Level</th>
          <th style="width: 150px;">School Year</th>
          <th style="width: 150px;"></th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $resources as $index => $resource )
          <tr>
            <td>
              {{ $resource->section->name }}
            </td>

            <td>
              @if ( $index === 0 )
                <span class="label label--primary">
                  Current
                </span>
              @endif
            </td>

            <td>
              <a href="{{ route('subjects.show', $resource->subject->id) }}">
                {{ $resource->subject->name }}
              </a>
            </td>

            <td> 
              {{ $resource->section->year_level_formatted }}
            </td>

            <td>
              {{ $resource->section->school_year }}
            </td>

            <td>
              <a href="{{ route('classes.show', $resource->section->id) }}" class="btn">
                View
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@stop