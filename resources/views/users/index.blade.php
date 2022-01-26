@extends('layouts.base')

@section('title', 'Manage Users')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Manage Users
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="#">Manage Users</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<x-alert />
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Manage Users</h3>

        <div class="block-options">
            <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal"
                    data-original-title="Filter"
                    data-target="#modal-filter" data-class="d-none">
                <i class="fa fa-flask"></i> Filter
            </button>

            @if(auth()->user()->is_superuser)
            <a href="{{ route('user-bulk-upload.index') }}" class="btn btn-sm btn-alt-primary" data-class="d-none">
                <i class="fa fa-upload"></i> Bulk Upload
            </a>
            @endif
        </div>
    </div>

    <div class="block-content block-content-full">
        @php
            $columns = [
                ['data' => 'id', 'name' => 'id', 'visible' => false, 'searchable' => false],
                ['data' => 'userid', 'name' => 'users.userid', 'visible' => false, 'sortable' => false],
                ['data' => 'photo', 'name' => 'photo', 'searchable' => false, 'sortable' => false, 'className'=> 'text-center'],
                ['data' => 'name', 'name' => 'users.name'],
                ['data' => 'user_type', 'name' => 'user_type', 'sortable' => false, 'th'=> 'User Type'],
                ['data' => 'status', 'name' => 'users.is_active'],
                ['data' => 'joining_date', 'name' => 'users.joining_date', 'searchable' => false, 'th'=> 'Joining Date'],
                ['data' => 'last_login', 'name' => 'users.last_login', 'searchable' => false, 'th'=> 'Last Login'],
                ['data' => 'action', 'name' => 'action', 'searchable' => false, 'sortable' => false]
            ];
            $url = route('users.get-users');
        @endphp
        <x-datatable :columns="$columns" :url="$url" id="users-table"></x-datatable>
    </div>

</div>

<x-modal id="modal-filter" title="Filter Users">
    <form action="" id="userFilterForm">
        @csrf
        @method('PUT')
        <div class="block-content font-size-sm">
            <div class="form-group">
                <label for="is_active">Status</label>
                <select name="is_active" id="is_active" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="block-content block-content-full text-right border-top">
            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" >Submit</button>
        </div>
    </form>
</x-modal>

@endsection


@section('scripts_after')

<script type="text/javascript">
    $(document).ready(function() {

        $('#userFilterForm').submit(function(e) {
            e.preventDefault();

            var is_active = $('#is_active').val();

            var actionUrl = '{{ $url }}' + `?is_active=${is_active}`;

            var dt = $('#users-table').DataTable();
            dt.ajax.url(actionUrl);
            dt.draw();
        })

    })

    function confirmPasswordReset() {
        return confirm('Are you sure want to reset password?');
    }

    function confirmActivate() {
        return confirm('Are you sure want to activate user?');
    }

    function confirmDeactivate() {
        return confirm('Are you sure want to deactivate user?');
    }

</script>

@endsection
