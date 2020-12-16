@extends('template.auth')

@section('title')
    register
@endsection

@section('title-content')
    Register Akun
@endsection

@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf

    <div class="form-group has-feedback">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="{{ __('Name') }}" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group has-feedback">
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group has-feedback">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group has-feedback">
      <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox"> I agree to the <a href="#">terms</a>
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  <a href="/login" class="text-center">saya punya akun</a>
@endsection