@extends('dashboard.layout')

@section('title')
  Subjects
@stop

@section('content')
  <div class="menu u-spacer">
    <h1 class="u-pull-left u-text-light">Subjects</h1>

    <div class="menu__section">
      <div class="menu__section-item">
        <form action="{{ route('subjects.index') }}">
          <label class="form-input-group">
            <input type="text" class="form-input-group__input" name="query" value="{{ $query }}" placeholder="Search for a subject by name (e.g., Math)" style="min-width: 350px;">

            <div class="form-input-group__button">
              <button class="plain-btn">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </label>
        </form>
      </div>

      <div class="menu__section-item">
        <a href="{{ route('subjects.create') }}" class="btn btn--primary">
          Add New Subject
        </a>
      </div>
    </div>
  </div>

  <table class="table u-spacer">
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
            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn">
              Edit
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $subjects->links('pagination') }}
@stop