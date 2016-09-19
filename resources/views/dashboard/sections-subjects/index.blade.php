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
    <a href="{{ route('classes.show', $section->id) }}" class="tabs__link">
      Students
    </a>

    <a href="{{ route('classes.subjects.index', $section->id) }}" class="tabs__link tabs__link--active">
      Subjects
    </a>
  </div>

  @if( !$resources->count() )
    <div class="u-size-6">
      @include('info', [
        'message' => 'It looks like this class doesn\'t have any subjects yet.' .
        '<br /><a href="' . route('classes.subjects.attach', $section->id). '" class="pull-note__link">' .
        'Add a subject to this class</a>.'
      ])
    </div>
  @else
    <div class="u-clearfix u-spacer">
      <a href="{{ route('classes.subjects.attach', $section->id) }}" class="u-pull-right btn btn--primary">
        Add Subject
      </a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Subject</th>
          <th>Teacher</th>
          <th style="width: 200px;">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $resources as $resource )
          <tr>
            <td>
              <a href="{{ route('subjects.show', $resource->subject->id) }}">
                {{ $resource->subject->name }}
              </a>
            </td>

            <td>
              <a href="{{ route('teachers.show', $resource->subject->id) }}">
                {{ $resource->teacher->full_name }}
              </a>
            </td>

            <td>
              <form action="{{ route('classes.subjects.detach', $resource->subject->id) }}" method="POST" style="display: inline-block;">
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