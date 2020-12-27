@extends('template.auth')

@section('title')
    login
@endsection

@section('title-content')
    Silahkan Login
@endsection

@section('content')

<form action="{{ route('login') }}" method="POST">
    @csrf

    <div class="form-group has-feedback">
      <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="{{ __('Username') }}">
      <span class="glyphicon glyphicon-user form-control-feedback"></span>

      @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="row">
      <!-- /.col -->
      <div class="col-xs-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat">
          {{ __('Login') }}
        </button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <a href="/register" class="text-center">register</a>
@endsection