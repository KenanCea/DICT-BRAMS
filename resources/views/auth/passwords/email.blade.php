@extends('layouts.login')

@section('content')
<v-app class="white">
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card outlined class="mx-auto pa-3">
                        <v-btn absolute fab top left large color="primary" href="/login">
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
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection