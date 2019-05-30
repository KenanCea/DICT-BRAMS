@extends('layouts.login')

@section('content')
<v-app>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card outlined class="mx-auto pa-3">
                    <v-card-text>
                        <div class="layout column align-center">
                            <img src="/img/logo.png" alt="No logo" width="120" height="120" />
                            <h2 class="my-4 text-md-center">Barangay Records Automation Management System</h2>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if ($errors->has('email'))
                            <v-snackbar color="error" top :value="true" timeout="6000">{{ $errors->first('email') }}
                            </v-snackbar>
                            @endif
                            <v-text-field outlined prepend-inner-icon="mdi-email" name="email" label="Email" type="email" required autofocus></v-text-field>
                            <v-text-field outlined prepend-inner-icon="mdi-lock" name="password" label="Password" id="password" type="password" required></v-text-field>
                            <v-spacer></v-spacer>
                            <v-btn block color="primary" type="submit">Login</v-btn>
                            @if (Route::has('password.request'))
                            <v-btn block text href="{{ route('password.request') }}">Forgot your password?</v-btn>
                            @endif
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</v-app>
@endsection