@extends('dashboard.layout')

@section('title')
  Classes
@stop

@section('content')
  <div class="menu u-spacer">
    <h1 class="u-text-light">Classes</h1>

    <div class="menu__section">
      <div class="menu__section-item">
        <form action="{{ route('classes.index') }}">
          <label class="form-input-group" style="min-width: 350px;">
            <input type="text" class="form-input-group__input" name="query" value="{{ $query }}" placeholder="Search for a class by name (e.g., Amity)" style="min-width: 350px;">

            <div class="form-input-group__button">
              <button class="plain-btn">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </label>
        </form>
      </div>

      <div class="menu__section-item">
        <a href="{{ route('classes.create') }}" class="btn btn--primary">
          Add New Class
        </a>
      </div>
    </div>
  </div>

  <table class="table u-spacer">
    <thead>
      <tr>
        <th style="width: 400px;">Class Name</th>
        <th>Year Level</th>
        <th style="width: 150px;">School Year</th>
        <th style="width: 150px;"></th>
      </tr>
    </thead>

    <tbody>
      @foreach ( $sections as $section )
        <tr>
          <td>
            {{ $section->name }}
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

            <a href="{{ route('classes.edit', $section->id) }}" class="btn">
              Edit
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $sections->appends(['query' => $query])->links('pagination') }}
@stop