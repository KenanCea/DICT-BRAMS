@extends('layouts.login')

@section('content')
<v-app>
    <v-content style="background-color:white;">
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xl2 lg4 md6 sm8>
                    <v-card outlined class="mx-auto pa-3">
                        <v-btn absolute fab top left large href="/" depressed id="back-button">
                            <v-icon>mdi-arrow-left</v-icon>
                        </v-btn>
                        @if($message = Session::get('success'))
                            <div class="alert alert-success" style='margin-top:15px;'>
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @if($message = Session::get('warning'))
                            <div class="alert alert-warning" style='margin-top:15px;'>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <v-card-text>
                            <div class="layout column align-center">
                                <img src="/img/logo.png" alt="No logo" width="120" height="120" />
                                <h2 class="my-4 text-md-center">Barangay Records Automation Management System</h2>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                @if ($errors->has('email'))
                                <v-snackbar color="error" top :value="true">{{ $errors->first('email') }}
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
    </v-content>
</v-app>
@endsection