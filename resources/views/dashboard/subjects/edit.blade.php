@extends('dashboard.layout')

@section('title')
  Edit Subject Information
@stop

@section('content')
  <div class="u-spacer u-clearfix">
    <h1 class="u-pull-left u-text-light">Edit Subject Information</h1>

    <div class="u-pull-right">
      <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn--primary">
        View Subject
      </a>
    </div>
  </div>

  <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
    {{ method_field('PUT') }}

    <div class="u-size-5">
      <div class="form-group">
        <input id="name" name="name" placeholder="Subject Name" class="form-input" value="{{ $subject->name }}">

        @include('error', ['error' => 'name'])
      </div>

      <div class="form-group">
        <label>
          <input id="has_conv" name="has_conv" type="checkbox" value="1" @checked($subject->has_conv)>
          Conventional
        </label>

        @include('error', ['error' => 'has_conv'])
      </div>

      <div class="u-clearfix">
        <div class="u-pull-left">
          <a href="{{ route('subjects.index') }}" class="btn">
            Cancel
          </a>
        </div>

        <div class="u-pull-right">
          <button class="btn btn--primary">
            Update
          </button>
        </div>
      </div>
    </div>
  </form>
@stop