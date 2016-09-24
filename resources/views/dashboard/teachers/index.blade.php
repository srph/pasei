@extends('dashboard.layout')

@section('title')
  Teachers
@stop

@section('content')
  <div class="menu u-spacer">
    <h1 class="u-text-light">Teachers</h1>

    <div class="menu__section">
      <div class="menu__section-item">
        <form action="{{ route('teachers.index') }}">
          <label class="form-input-group">
            <input type="text" class="form-input-group__input" name="query" value="{{ $query }}" placeholder="Search for a teacher by name (e.g., John)" style="min-width: 350px;">

            <div class="form-input-group__button">
              <button class="plain-btn">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </label>
        </form>
      </div>

      <div class="menu__section-item">
        <a href="{{ route('teachers.create') }}" class="btn btn--primary">
          Register New Teacher
        </a>
      </div>
    </div>
  </div>

  <table class="table u-spacer">
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

  {{ $users->appends(['query' => $query])->links('pagination') }}
@stop