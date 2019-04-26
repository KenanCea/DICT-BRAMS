@extends('layouts.app')

@section('content')

<v-content>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <v-card-text>
                            @if ($errors->has('email'))
                            <v-alert :value="true" color="error" icon="mdi-alert-circle" outline>{{ $errors->first('email') }}</v-alert>
                            @endif
                            <v-text-field outline prepend-inner-icon="mdi-account" name="email" label="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus></v-text-field>
                            <v-text-field outline prepend-inner-icon="mdi-lock" name="password" label="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required></v-text-field>
                            <v-spacer></v-spacer>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                            @endif
                            <v-btn color="primary" type="submit">Login</v-btn>
                        </v-card-text>
                    </form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</v-content>
@endsection