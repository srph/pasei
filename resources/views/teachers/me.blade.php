@extends('teachers.layout')

@section('title')
  Change Account Information
@stop

@section('content')
  <h3 class="u-text-light">
    Change Account Information
  </h3>

  <form action="{{ route('me.update') }}" method="POST">
    {{ method_field('PUT') }}

    <div class="u-size-5">
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" id="email" type="email" placeholder="your@email.com" class="form-input" value="{{ $user->email }}">
        @include('error', ['error' => 'email'])
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input name="password" id="password" type="password" placeholder="*****" class="form-input">
        @include('error', ['error' => 'password'])
      </div>

      <div class="form-group">
        <label for="password_confirmation">Password Confirmation</label>
        <input name="password_confirmation" id="password_confirmation" type="password_confirmation" placeholder="*****" class="form-input">
        @include('error', ['error' => 'password_confirmation'])
      </div>

      <button class="btn btn--primary">
        Update Account
      </button>
    </div>
  </form>
@stop