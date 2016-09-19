@extends('dashboard.layout')

@section('title')
  Classes
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-pull-left u-text-light">Classes</h1>

    <div class="u-pull-right">
      <a href="{{ route('classes.create') }}" class="btn btn--primary">
        Add New Class
      </a>
    </div>
  </div>

  <table class="table">
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
@stop