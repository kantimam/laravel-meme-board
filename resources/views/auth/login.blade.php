@extends('layouts.app')

@section('content')
<div class="inner centerText">
    <div class="margin0Auto logSignWrapper fancyShadow">
        <h1>LogIn</h1>
        <form method="POST" class="mainForm" action="{{ route('login') }}">
            @csrf

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

            <div id="rememberForgotPasswordWrapper">
                <div class="checkInputWrapper">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                    <label for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                
                @if (Route::has('password.request'))
                    <a id="forgotPassword" class="innerLink" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            
            
            <button type="submit" class="mainSubmit mainColor">
                {{ __('Login') }}
            </button>        
        </form>
    </div>
</div>
<script src="{{ asset('js/form.js') }}">
</script>
@endsection
