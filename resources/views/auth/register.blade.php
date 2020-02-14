@extends('layouts.app')

@section('content')
<div class="inner centerText">
    <div class="margin0Auto logSignWrapper fancyShadow">
        <h1>{{ __('Register') }}</h1>

        <form class="mainForm"  method="POST" action="{{ route('register') }}">
            @csrf

            <div class="textInputWrapper">
                <label for="name">{{ __('Name') }}</label>

                <input class="textInput" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="textInputWrapper">
                <label for="email">{{ __('E-Mail Address') }}</label>

                <input class="textInput" id="email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="textInputWrapper">
                <label for="password">{{ __('Password') }}</label>

                <input class="textInput" id="password" type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="textInputWrapper">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                <input class="textInput" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">    

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="mainSubmit mainColor">
                {{ __('Login') }}
            </button>
        </form>
</div>
</div>
@endsection
