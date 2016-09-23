@extends('dashboard.layout')

@section('title')
  Teachers
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-pull-left u-text-light">Teachers</h1>

    <div class="u-pull-right">
      <a href="{{ route('teachers.create') }}" class="btn btn--primary">
        Register New Teacher
      </a>
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th style="width: ">Name</th>
        <th style="width: 200px;">Assigned</th>
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
            @if ( $user->is_assigned )
              <i class="fa fa-check u-text-success"></i>
            @else
              <span class="label label--plain-danger">
                Unassigned
              </span>
            @endif
          </td>

          <td>
            <a href="{{ route('teachers.show', $user->id) }}" class="btn">
              View
            </a>

            <a href="{{ route('teachers.edit', $user->id) }}" class="btn">
              Edit
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop