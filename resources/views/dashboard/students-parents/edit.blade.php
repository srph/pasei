@extends('dashboard.layout')

@section('title')
  Edit Parent {{ $parent->name }}
@stop

@section('content')
  <h1 class="u-spacer u-text-light">
    Edit Parent {{ $parent->name }}
  </h1>

  <form action="{{ route('parents.update', ['student' => $user->id, 'parent' => $parent->id]) }}" method="POST">
    {{ method_field('PUT') }}

    <div class="u-size-5">
      <div class="form-group">
        <label for="name">Name</label>
        <input id="name" name="name" placeholder="Name" class="form-input" value="{{ $parent->name }}">
        @include('error', ['error' => 'name'])
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" placeholder="Email" class="form-input" value="{{ $parent->email }}">
        @include('error', ['error' => 'email'])
      </div>

      <div class="u-clearfix">
        <div class="u-pull-left">
          <a href="{{ route('parents.index', $user->id) }}" class="btn">
            Cancel
          </a>
        </div>

        <div class="u-pull-right">
          <button class="btn btn--primary">
            Update Information
          </button>
        </div>
      </div>
    </div>
  </form>
@stop