@extends('dashboard.layout')

@section('title')
  Parents - {{ $user->full_name }}
@stop

@section('content')
  <div class="u-clearfix u-spacer">
    <h1 class="u-text-gray u-text-light u-pull-left">
      {{ $user->full_name }}
    </h1>

    <div class="u-pull-right">
      <a href="{{ route('students.edit', $user->id) }}" class="btn btn--primary">
        Edit Information
      </a>
    </div>
  </div>

  <div class="tabs u-spacer">
    <a href="{{ route('students.show', $user->id) }}" class="tabs__link">
      Classes
    </a>

    <a href="{{ route('parents.index', $user->id) }}" class="tabs__link tabs__link--active">
      Parents
    </a>
  </div>

  @if( !$user->parents->count() )
    <div class="u-size-6">
      @include('info', [
        'message' => 'It looks like this student does\'nt have any listed parents yet. ' .
          '<a href="' . route('parents.create', $user->id) . '" class="pull-note__link">Click here to add one</a>.'
      ])
    </div>
  @else
    <div class="u-clearfix u-spacer">
      <a href="{{ route('parents.create', $user->id) }}" class="u-pull-right btn btn--primary">
        Add New Parent
      </a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th style="width: 400px;">Name</th>
          <th style="width: 400px;">Email</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        @foreach ( $user->parents as $parent )
          <tr>
            <td>
              {{ $parent->name }}
            </td>

            <td> 
              {{ $parent->email }}
            </td>

            <td>
              <a href="{{ route('parents.edit', ['student' => $user->id, 'parent' => $parent->id ]) }}" class="btn">
                Edit
              </a>

              <form action="{{ route('parents.destroy', ['student' => $user->id, 'parent' => $parent->id ]) }}" method="POST" style="display: inline-block;">
                {{ method_field('DELETE') }}
                <button class="btn btn--plain-danger">
                  Remove
                </button>
              <form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
@stop