@extends('layouts.login')

@section('content')
<v-app class="white">
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xl2 lg4 md6 sm8>
                    <v-card outlined class="mx-auto pa-3">
                        <v-btn absolute fab top left large href="/login" depressed id="back-button">
                            <v-icon>mdi-arrow-left</v-icon>
                        </v-btn>
                        <v-card-text>
                            @if (session('status'))
                            <v-snackbar color="success" top :value="true">
                                {{ session('status') }}
                            </v-snackbar>
                            @endif
                            <div class="layout column align-center">
                                <img src="/img/logo.png" alt="No logo" width="120" height="120" />
                                <h2 class="my-4 text-md-center">Reset Password</h2>
                            </div>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                @if ($errors->has('email'))
                                <v-snackbar color="error" top :value="true">{{ $errors->first('email') }}
                                </v-snackbar>
                                @endif
                                <v-text-field outlined prepend-inner-icon="mdi-email" name="email" label="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus></v-text-field>
                                <v-spacer></v-spacer>
                                <v-btn block color="primary" type="submit">Send Password Reset Link</v-btn>
                            </form>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
</v-app>
@endsection