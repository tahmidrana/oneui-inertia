@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<x-alert />

{{-- <div class="text-center">
    <img src="{{ asset('theme/media/phwc-logo.png') }}" alt="" class="">

    <p class="text-muted">
        Welcome, please login.
    </p>
</div> --}}
<!-- Sign In Block -->
<div class="block block-rounded block-themed mb-0">
    <div class="block-header bg-primary-dark">
        <h3 class="block-title">Sign In</h3>
        <div class="block-options">
            @if (Route::has('password-reset.request'))
             <a class="btn-block-option font-size-sm" href="{{ route('password-reset.request') }}">{{ __('Forgot password?') }}</a>
            @endif
            {{-- <a class="btn-block-option" href="#" data-toggle="tooltip" data-placement="left" title="New Account">
                <i class="fa fa-user-plus"></i>
            </a> --}}
        </div>
    </div>

    <div class="block-content">

        <div class="p-sm-3 px-lg-4">
            {{-- <h1 class="h2 mb-1">{{ env('APP_NAME') }}</h1> --}}
            <div class="text-center">
                <img src="{{ asset('theme/media/phwc-logo.png') }}" alt="" class="">

                <p class="text-muted">
                    Welcome, please login.
                </p>
            </div>

            <!-- Sign In Form -->
            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
            <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="py-3">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-alt form-control-lg"
                            id="userid" name="userid"
                            value="{{ old('userid') }}"
                            placeholder="{{ __('User ID') }}"
                            required autofocus />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-alt form-control-lg"
                            id="password" name="password"
                            placeholder="{{ __('Password') }}"
                            required autocomplete="current-password"/>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember"/>
                            <label class="custom-control-label font-w400" for="remember_me">{{ __('Remember me') }}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-xl-5">
                        <button type="submit" class="btn btn-block btn-alt-primary">
                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('Sign in') }}
                        </button>
                    </div>
                </div>
            </form>
            <!-- END Sign In Form -->
        </div>
    </div>
</div>
<!-- END Sign In Block -->

@endsection

