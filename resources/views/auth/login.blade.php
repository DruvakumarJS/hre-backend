@extends('layouts.app_noheader')

@section('content')

    <div class="container">

        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <img  src="{{asset('images/login_image.svg')}}" style="margin-top: 50px">
            </div>
            <div class="col-md-3">
                <div class="login">
                    <h3>Hello! Welcome back</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email">{{ __('Email Address') }}</label>
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="">{{ __('Password') }}</label>

                            <div class="col">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password" required
                                       autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center align-items-center mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <!--  <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                        </button>

@if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                            </a>
@endif
                        </div>
                    </div> -->
                    </form>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

    </div>
@endsection
