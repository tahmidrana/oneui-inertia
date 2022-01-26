@extends('layouts.base')

@section('title', 'User Profile')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                User Profile
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('users.index') }}">Manage Users</a>
                    </li>
                    <li class="breadcrumb-item">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection



@section('content')

<div class="row">
    <div class="col-md-4">
        <!-- About -->
        <div class="block block-rounded block-link-shadow">
            <div class="block-header block-header-default">
                <h3 class="block-title">About</h3>
            </div>
            <div class="block-content block-content-full text-center">
                <div class="mb-3">
                    <img class="img-avatar img-avatar96" src="{{ $user->photo_path }}" alt="">
                </div>
                <div class="font-size-h5 mb-1">{{ $user->name }}</div>
                <div class="font-size-sm text-muted">#{{ $user->userid }}</div>
            </div>
            <div class="block-content border-top">
                <p class="mb-2">User Roles: {{ $user->roles->implode('title', ', ') }}</p>
                <p class="mb-2">{{ $user->gender_text  }}</p>
                <p class="mb-2">{{ $user->age }} years</p>
                <p class="mb-2">{{ $user->address }}</p>
                <p class="mb-2">Joined On {{ $user->joining_date ? $user->joining_date->format('d M Y') : $user->created_at->format('d M Y') }}</p>
            </div>
            <div class="block-content border-top border-bottom">
                <p class="mb-2">Phone: {{ $user->phone  }}</p>
                <p class="mb-2">Email: {{ $user->email }}</p>
            </div>
            <br>
        </div>
        <!-- END About -->
    </div>

    <div class="col-md-8">
        <div class="block block-rounded">
            <ul class="nav nav-tabs nav-tabs-alt align-items-center" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#ecom-product-info">Basic Info</a>
                </li>
            </ul>
            <div class="block-content tab-content">
                <!-- Info -->
                <div class="tab-pane active" id="ecom-product-info" role="tabpanel">
                    <div class="row">
                        <div class="col-3"><strong>Name</strong></div>
                        <div class="col-6">{{ $user->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3"><strong>Date of Birth</strong></div>
                        <div class="col-6">{{ $user->dob ? $user->dob->format('d M Y') : 'n/a' }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3"><strong>Gender</strong></div>
                        <div class="col-6">{{ $user->gender_text }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3"><strong>Blood Group</strong></div>
                        <div class="col-6">{{ $user->blood_group_text }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3"><strong>Address</strong></div>
                        <div class="col-6">{{ $user->address }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3"><strong>District</strong></div>
                        <div class="col-6">{{ $user->district->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-3"><strong>Post Code</strong></div>
                        <div class="col-6">{{ $user->post_code }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3"><strong>Phone</strong></div>
                        <div class="col-6">{{ $user->phone }}</div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-3"><strong>Email</strong></div>
                        <div class="col-6">{{ $user->email }}</div>
                    </div>
                </div>
                <!-- END Info -->
            </div>
        </div>
        <!-- END Extra Info Tabs -->
    </div>
</div>

@endsection


@section('styles')

@endsection

@section('scripts')

<script>
    $(document).ready(function(){
        // console.log('Page loaded')
    })
</script>

@endsection
