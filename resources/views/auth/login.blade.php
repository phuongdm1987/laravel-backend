@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <h1 class="is-size-3 has-text-centered">@lang('Login')</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label class="label" for="email">@lang('E-Mail Address')</label>
                        <div class="control has-icons-left">
                            <input
                                    class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                    value="{{ old('email') }}"
                                    id="email" name="email" type="email" required autofocus>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <label class="label" for="password">@lang('Password')</label>
                        <div class="control has-icons-left">
                            <input
                                    class="input{{ $errors->has('password') ? ' is-danger' : '' }}"
                                    id="password" name="password" type="password" required>
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
                                <input
                                        {{ old('remember') ? 'checked' : '' }}
                                        type="checkbox" name="remember">
                                @lang('Remember Me')
                            </label>
                        </div>
                    </div>

                    <div class="columns is-vcentered">
                        <div class="column is-2">
                            <p class="control">
                                <button type="submit" class="button is-primary">
                                    @lang('Login')
                                </button>
                            </p>
                        </div>
                        <div class="column">
                            <p class="control">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        @lang('Forgot Your Password?')
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
