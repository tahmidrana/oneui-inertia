@extends('layouts.base')

@section('title', 'Password Change')


@section('content')

<x-alert />
<div class="row">
    <div class="col-md-6 offset-3">

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Change Password</h3>
            </div>

            <div class="block-content block-content-full">
                <div class="row justify-content-center py-sm-3 py-md-5">
                    <div class="col-sm-10 col-md-8">
                        <form action="{{ route('password-change.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_password">Current Password *</label>
                                <input type="password" class="form-control form-control-alt" id="current_password" name="current_password" placeholder="Enter your current password.." required />
                            </div>
                            <div class="form-group">
                                <label for="password">New Password *</label>
                                <input type="password" class="form-control form-control-alt" id="password" name="password" placeholder="Enter your new password.." required />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password *</label>
                                <input type="password" class="form-control form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password.." required />
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">
                                Change Password
                            </button>
                            <button type="reset" class="btn btn-sm btn-alt-primary">
                                Reset
                            </button>
                            <br> <br>
                            <small class="text-danger">N.B: After password change, you will be logged out from the system</small>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection


@section('styles')

@endsection

@section('scripts')


@endsection
