@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row vh-1">
        <div class="col-md-6 pbc-1 p-0">
            <div class="text-center mt-5">
                <img src="/img/logo.png" class="img-fluid" alt="BRAMS logo">
            </div>
            <div class="mt-5">
                    <img src="/img/lines.png" class="img-fluid" style="bottom:0px; position:absolute" alt="Responsive image">
                </div>
        </div>
        <div class="col-md-6 p-5">
            <h1 class="text-center mt-3 mb-5 pc-1">Barangay Record Automation Management System</h1>
            <h6 class="text-center mb-4">Welcome! Please login to your account.</h6>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 offset-md-2 pt-xs-5 pb-xs-5">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label text-md-left" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}</a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-md-5 mt-3">
                        <button type="submit" class="btn bg-blue pr-5 pl-5">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
