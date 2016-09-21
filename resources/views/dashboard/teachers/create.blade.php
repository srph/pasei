@extends('dashboard.layout')

@section('title')
  Register New Teacher
@stop

@section('content')
  <h1 class="u-spacer u-text-light">Enroll New Teacher</h1>

  <form action="{{ route('teachers.store') }}" method="POST">
    <div class="u-size-5">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" placeholder="First Name" class="form-input" value="{{ old('first_name') }}">

        @include('error', ['error' => 'first_name'])
      </div>

      <div class="form-group">
        <label for="middle_name">Middle Name</label>
        <input id="middle_name" name="middle_name" placeholder="Middle Name" class="form-input" value="{{ old('middle_name') }}">

        @include('error', ['error' => 'middle_name'])
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" placeholder="Last Name" class="form-input" value="{{ old('last_name') }}">

        @include('error', ['error' => 'last_name'])
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" placeholder="Email" class="form-input" value="{{ old('email') }}">
        @include('error', ['error' => 'email'])
      </div>

      <div class="u-clearfix">
        <div class="u-pull-left">
          <a href="{{ route('teachers.index') }}" class="btn">
            Cancel
          </a>
        </div>

        <div class="u-pull-right">
          <button class="btn btn--primary">
            Register New Teacher
          </button>
        </div>
      </div>
    </div>
  </form>
@stop