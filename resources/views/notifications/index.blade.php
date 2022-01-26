@extends('layouts.base')

@section('title', 'Notifications')

@section('breadcrumb')

@endsection

@section('content')
<x-alert />

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
                <p class="mb-2">Joined On {{ $user->created_at->format('d M Y') }}</p>
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
        <livewire:notification-panel />
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