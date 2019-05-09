@extends('layouts.app')

@section('content')
<v-content class="white">
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card outlined class="mx-auto pa-3">
                    <v-card-text>
                        <div class="layout column align-center">
                            <img src="/img/logo.png" alt="No logo" width="120" height="120" />
                            <h2 class="my-4 text-md-center">{{ __('Reset Password') }}</h2>
                        </div>


                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            @if ($errors->has('email'))
                            <v-snackbar color="error" top :value="true" timeout="6000">{{ $errors->first('email') }} {{ $errors->first('password') }}
                            </v-snackbar>
                            @endif
                            @if ($errors->has('password'))
                            <v-snackbar color="error" top :value="true" timeout="6000">{{ $errors->first('password') }}
                            </v-snackbar>
                            @endif
                            <v-text-field outline prepend-inner-icon="mdi-email" name="email" label="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus></v-text-field>
                            <v-text-field outline prepend-inner-icon="mdi-lock" name="password" label="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required></v-text-field>
                            <v-text-field outline prepend-inner-icon="mdi-lock" name="password_confirmation" label="Password" id="password-confirm" type="password" class="form-control" required></v-text-field>

                            <v-btn block color="primary" type="submit">Reset Password</v-btn>
                        </form>

                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</v-content>

@endsection