@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label class="label">{{ __('E-Mail Address') }}</label>
                        <div class="control has-icons-left">
                            <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" value="{{ old('email') }}" required autofocus>
                            <span class="icon is-small is-left">
                              <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <label class="label">{{ __('Password') }}</label>
                        <div class="control has-icons-left">
                            <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" required>
                            <span class="icon is-small is-left">
                              <i class="fas fa-key"></i>
                            </span>
                        </div>
                        @if ($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <div class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="columns is-vcentered">
                        <div class="column is-2">
                            <p class="control">
                                <button type="submit" class="button is-primary">
                                    {{ __('Login') }}
                                </button>
                            </p>
                        </div>
                        <div class="column">
                            <p class="control">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
