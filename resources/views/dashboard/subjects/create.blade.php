@extends('dashboard.layout')

@section('title')
  Add New Subject
@stop

@section('content')
  <h1 class="u-spacer u-text-light">Add New Subject</h1>

  <form action="{{ route('subjects.store') }}" method="POST">
    <div class="u-size-5">
      <div class="form-group">
        <input id="name" name="name" placeholder="Subject Name" class="form-input" value="{{ old('name') }}">

        @include('error', ['error' => 'name'])
      </div>

      <div class="u-clearfix">
        <div class="u-pull-left">
          <a href="{{ route('subjects.index') }}" class="btn">
            Cancel
          </a>
        </div>

        <div class="u-pull-right">
          <button class="btn btn--primary">
            Enroll Student
          </button>
        </div>
      </div>
    </div>
  </form>
@stop