@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-mobile is-centered">
        <div class="column is-half">
            @if (session('status'))
                <div class="notification is-success">
                    <button class="delete"></button>
                    {{ session('status') }}
                </div>
            @endif

            <h1 class="is-size-3 has-text-centered">{{ __('Reset Password') }}</h1>
            <form method="POST" action="{{ route('password.email') }}">
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
                    <div class="control">
                        <button type="submit" class="button is-primary is-fullwidth">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
