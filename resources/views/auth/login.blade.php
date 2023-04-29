@extends('layouts.app')

@section('content')
<div class="position-relative h-100">
    <div class="card login-card">
        <img src="{{ asset("images/logo.svg")  }}">
        <div class="card-body my-3 mx-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <label for="password" class="mt-3">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <button type="submit" class="btn btn-primary mt-5 w-100">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
