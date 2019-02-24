@extends('layouts.app')
@section('content')
<v-app id="login" class="primary">
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4 lg4>
                    <v-card class="elevation-1 pa-5">
                        <div class="layout column align-center">
                            <img src="/img/logo.png" alt="Vue Material Admin" width="120" height="120">
                            <h1 class="flex my-4 primary--text">BRAMS 2.0</h1>
                        </div>
                        <v-form method="POST" action="{{ route('login') }}">
                            @csrf
                            <v-text-field append-icon="person" name="username" placeholder="Username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required></v-text-field>
                            {{-- <input type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                name="username" value="{{ old('username') }}" required autofocus>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif --}}
                            <v-text-field append-icon="lock" name="password" type="password" placeholder="Password" required></v-text-field>
                            {{-- <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif --}}
                            {{-- <div class="row">
                                <div class="col-md-5 offset-md-2 pt-xs-5 pb-xs-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
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
                                    <button type="submit" class="btn btn-primary pr-5 pl-5">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div> --}}
                            <v-card-actions>
                                <v-checkbox name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }} label="Remember me"></v-checkbox>
                                <v-spacer></v-spacer>
                                <a class="btn" href="{{ route('password.request') }}">
                                    Forgot Password</a>
                            </v-card-actions>
                            <v-btn block type="submit" color="primary">Login</v-btn>
                        </v-form>

                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    </div>
</v-app>
@endsection
