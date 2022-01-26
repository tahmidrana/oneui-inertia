@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <x-auth-validation-errors class="mb-4" :errors="$errors" />
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
            <h3 class="block-title">Password Reset</h3>
            <div class="block-options">
                @if (Route::has('login'))
                    <a class="btn-block-option font-size-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
            </div>
        </div>

        <div class="block-content">

            <div class="p-sm-3 px-lg-4">
                {{-- <h1 class="h2 mb-1">{{ env('APP_NAME') }}</h1> --}}
                <div class="text-center">
                    <img src="{{ asset('theme/media/phwc-logo.png') }}" alt="" class="">

                    <p class="text-muted">
                        Password Reset
                    </p>
                </div>

                <form method="POST" action="{{ route('password-reset.post') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control form-control-alt form-control-lg"
                               id="userid" name="userid"
                               placeholder="{{ __('User ID') }}"
                               required autofocus />
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn btn-block btn-alt-primary">
                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Sign In Block -->

@endsection
