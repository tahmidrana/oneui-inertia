@extends('layouts.base')

@section('title', 'Corporate Services Setting')

@section('breadcrumb')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Corporate Services
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Corporate Services</a>
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
                    <h3 class="block-title">Corporate Services</h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#modal-add"
                                data-original-title="Filter" data-class="d-none">
                            <i class="fa fa-plus"></i> New Corporate Service
                        </button>
                    </div>
                </div>

                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter " id="services-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{!! $service->status !!}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-alt-primary js-tooltip-enabled" data-toggle="modal"
                                            data-original-title="Edit" data-target="#modal-update-{{ $service->id }}">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-alt-danger js-tooltip-enabled" onclick="confirmDelete('corporateServiceDelete{{ $service->id }}')" >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form method="POST" action="{{ route('corporate-services.destroy', ['corporate_service'=> $service->id]) }}" id="corporateServiceDelete{{ $service->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <x-modal id="modal-update-{{ $service->id }}" title="Update Corporate Services">
                                <form action="{{ route('corporate-services.update', ['corporate_service' => $service->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="block-content font-size-sm">
                                        <div class="form-group">
                                            <label for="name">Name *</label>
                                            <input type="text" class="form-control" id="name" value="{{ $service->name }}"
                                                name="name" />
                                        </div>

                                        <div class="form-group">
                                            <label for="is_active">Status *</label>
                                            <select name="is_active" id="is_active" class="form-control" required>
                                                <option value="1" {{ $service->is_active == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $service->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full text-right border-top">
                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </x-modal>

                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>


            <x-modal id="modal-add" title="Add New Corporate Services">
                <form action="{{ route('corporate-services.store') }}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name"
                                name="name" />
                        </div>

                        <div class="form-group">
                            <label for="is_active">Status *</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </x-modal>

        </div>
    </div>

@endsection

@section('styles_before')
    <link rel="stylesheet" href="{{ asset('theme/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('theme/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('theme/js/pages/be_tables_datatables.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#services-table').DataTable();
        })
    </script>

@endsection
