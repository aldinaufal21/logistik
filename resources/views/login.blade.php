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
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

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
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label>
            {{ __('Remember Me') }}
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">
          {{ __('Login') }}
        </button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <a href="#">I forgot my password</a><br>
  <a href="/register" class="text-center">register</a>
@endsection