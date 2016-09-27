@extends('dashboard.layout')

@section('title')
  Remove {{ $user->full_name }}
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
    <a href="{{ route('teachers.show', $user->id) }}" class="tabs__link">
      Classes
    </a>

    <a href="{{ route('teachers.remove', $user->id) }}" class="tabs__link tabs__link--active">
      Removal
    </a>
  </div>

  @if ( null == $user->deleted_at )
    <div class="pull-note pull-note--danger u-spacer u-size-5">
      <div class="pull-note__icon">
        <i class="fa fa-exclamation-circle"></i>
      </div>

      <div class="pull-note__text">
        This will make the teacher inactive, <em>but</em> will not delete any data.
      </div>
    </div>

    <form action="{{ route('teachers.destroy', $user->id) }}" method="POST">
      {{ method_field('DELETE') }}
      <button class="btn btn--danger">
        Set as Inactive
      </button>
    </form>
  @else
    <div class="pull-note pull-note--primary u-spacer u-size-5">
      <div class="pull-note__icon">
        <i class="fa fa-lightbulb-o"></i>
      </div>

      <div class="pull-note__text">
        This will make the teacher active once again.
      </div>
    </div>

    <form action="{{ route('teachers.restore', $user->id) }}" method="POST">
      {{ method_field('PUT') }}
      <button class="btn btn--primary">
        Set as Active
      </button>
    </form>
  @endif
@stop