@extends('layouts.base')

@section('title', 'Dashboard')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Corporate Service Types
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Service Types</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-8 offset-xl-2 col-sm-12">
        <x-alert />

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Corporate Service Types</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option mr-2" data-toggle="modal" data-target="#modal-add">
                        <i class="fa fa-plus mr-1"></i> New Service Type
                    </button>
                    {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button> --}}
                </div>
            </div>

            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter " id="menu-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($service_types as $service)
                        <tr>
                            <td>{{ $service->title }}</td>
                            <td>{!! $service->status !!}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-alt-primary js-tooltip-enabled" data-toggle="modal"
                                    data-original-title="Edit" data-target="#modal-update-{{ $service->id }}">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>

                                {{-- @if($timeslot->is_active)
                                    <a href="{{ route('service-types.deactivate', ['service_type'=> $service->id]) }}" class="btn btn-sm btn-alt-info mr-1" title="Deactivate"><i class="fa fa-fw fa-thumbs-down"></i></a>
                                @else
                                    <a href="{{ route('service-types.activate', ['service_type'=> $service->id]) }}" class="btn btn-sm btn-alt-info mr-1" title="Activate"><i class="fa fa-fw fa-thumbs-up"></i></a>
                                @endif --}}

                                <button type="button" class="btn btn-sm btn-alt-danger js-tooltip-enabled" onclick="confirmDelete('serviceDelete{{ $service->id }}')" >
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                                <form method="POST" action="{{ route('service-types.destroy', ['service_type'=> $service->id]) }}" id="serviceDelete{{ $service->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <x-modal id="modal-update-{{ $service->id }}" title="Update Corporate Service Type">
                            <form action="{{ route('service-types.update', ['service_type' => $service->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="block-content font-size-sm">
                                    <div class="form-group">
                                        <label for="title{{ $service->id }}">Name *</label>
                                        <input type="text" class="form-control" id="title{{ $service->id }}"
                                            value="{{ $service->title }}"
                                            name="title" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="is_active{{ $service->id }}">Status</label>
                                        <select name="is_active" id="is_active{{ $service->id }}" class="form-control">
                                            <option value="1" {{ $service->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $service->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-right border-top">
                                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" >Update</button>
                                </div>
                            </form>
                        </x-modal>

                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>



        <x-modal id="modal-add" title="Add New Corporate Service Type">
            <form action="{{ route('service-types.store') }}" method="POST">
                @csrf
                <div class="block-content font-size-sm">
                    <div class="form-group">
                        <label for="title">Name *</label>
                        <input type="text" class="form-control" id="title"
                            name="title" required />
                    </div>

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
