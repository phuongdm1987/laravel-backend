@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-mobile is-centered">
        <div class="column is-half">
            @if (session('status'))
                <notification>{{ session('status') }}</notification>
            @endif

            <h1 class="is-size-3 has-text-centered">{{ __('Reset Password') }}</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">
                    <label class="label">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left">
                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" type="email" value="{{ $email ?? old('email') }}" required autofocus>
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
                    <label class="label">{{ __('Confirm Password') }}</label>
                    <div class="control has-icons-left">
                        <input class="input" name="password_confirmation" type="password" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary is-fullwidth">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
