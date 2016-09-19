@extends('dashboard.layout')

@section('title')
  Subjects
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-pull-left u-text-light">Subjects</h1>

    <div class="u-pull-right">
      <a href="{{ route('subjects.create') }}" class="btn btn--primary">
        Add New Subject
      </a>
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th style="width: ">Name</th>
        <th style="width: 200px;">Actions</th>
      </tr>
    </thead>

    <tbody>
      @foreach ( $subjects as $subject )
        <tr>
          <td>
            {{ $subject->name }}
          </td>

          <td>
            <a href="{{ route('subjects.show', $subject->id) }}" class="btn">
              View
            </a>

            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn">
              Edit
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop