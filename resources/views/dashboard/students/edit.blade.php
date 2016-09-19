@extends('dashboard.layout')

@section('title')
  Edit Student Information
@stop

@section('content')
  <h1 class="u-spacer u-text-light">Edit Student Information</h1>

  <form action="{{ route('students.update', $user->id) }}" method="POST">
    {{ method_field('PUT') }}

    <div class="u-size-5">
      <div class="form-group">
        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" placeholder="First Name" class="form-input" value="{{ $user->first_name }}">

        @include('error', ['error' => 'first-name'])
      </div>

      <div class="form-group">
        <label for="middle_name">Middle Name</label>
        <input id="middle_name" name="middle_name" placeholder="Middle Name" class="form-input" value="{{ $user->middle_name }}">

        @include('error', ['error' => 'middle_name'])
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" placeholder="Last Name" class="form-input" value="{{ $user->last_name }}">

        @include('error', ['error' => 'last_name'])
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" placeholder="Email" class="form-input" value="{{ $user->email }}">

        @include('error', ['error' => 'email'])
      </div>

      <button class="btn btn--primary">
        Update
      </button>
    </div>
  </form>
@stop