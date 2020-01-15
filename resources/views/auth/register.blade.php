@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-mobile is-centered">
        <div class="column is-half">
            <h1 class="is-size-3 has-text-centered">{{ __('Register') }}</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label class="label" for="name">{{ __('Name') }}</label>
                    <div class="control">
                        <input
                                class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                value="{{ old('name') }}"
                                id="name" name="name" type="text" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label" for="email">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left">
                        <input
                                class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                value="{{ old('email') }}"
                                id="email" name="email" type="email" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label class="label" for="password">{{ __('Password') }}</label>
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
                    <label class="label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <div class="control has-icons-left">
                        <input class="input" id="password_confirmation" name="password_confirmation" type="password" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary is-fullwidth">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
