@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-mobile is-centered">
        <div class="column is-half">
            @if (session('status'))
                <notification>{{ session('status') }}</notification>
            @endif

            <h1 class="is-size-3 has-text-centered">@lang('Reset Password')</h1>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="field">
                    <label class="label" for="email">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left">
                        <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
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
                            @lang('Send Password Reset Link')
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
