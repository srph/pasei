@extends('dashboard.layout')

@section('title')
  Reports - Class {{ $section->name }}
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

    <a href="{{ route('classes.subjects.index', $section->id) }}" class="tabs__link">
      Subjects
    </a>

    <a href="{{ route('classes.reports.index', $section->id) }}" class="tabs__link tabs__link--active">
      Reports
    </a>
  </div>

  <form action="{{ route('classes.reports.generate', $section->id) }}">
    <button class="btn btn--primary">
      Generate Reports
    </button>
  </form>
@stop