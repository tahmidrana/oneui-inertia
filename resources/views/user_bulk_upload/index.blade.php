@extends('layouts.base')

@section('title', 'User Bulk Upload')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                User Bulk Upload
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('users.index') }}">Manage Users</a>
                    </li>
                    <li class="breadcrumb-item">User Bulk Upload</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-md-6 offset-3">
        <div class="block block-rounded">
            <form action="{{ route('user-bulk-upload.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block-content block-content-full">
                    <div class="form-group">
                        <label>Bulk Data Excel File Input</label>
                        <div class="custom-file">
                            <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                            <input type="file" class="custom-file-input1" data-toggle="custom-file-input" id="user_bulk_excel" name="user_bulk_excel" required />
                            <label class="custom-file-label" for="user_bulk_excel">Choose Excel file</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>

        <x-alert />

        @if(session()->has('error_data'))
            <div class="alert alert-danger alert-dismissable">
                @foreach(session('error_data') as $error_data)
                    <p class="mb-0">-> USER CODE: {{ $error_data[2] ?? 'n/a' }} / NAME: {{ $error_data[3] ?? 'n/a' }} / PHONE: {{ $error_data[4] ?? 'n/a' }} / EMAIl: {{ $error_data[5] ?? 'n/a' }}</p>
                @endforeach

            </div>
        @endif
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