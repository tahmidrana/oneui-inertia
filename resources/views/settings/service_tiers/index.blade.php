@extends('layouts.base')

@section('title', 'Service Tiers')

@section('breadcrumb')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Service Tiers
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Service Tiers</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-xl-10 offset-xl-1 col-sm-12">
            <x-alert />

            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Service Tiers</h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal"
                            data-target="#modal-add" data-original-title="Filter" data-class="d-none">
                            <i class="fa fa-plus"></i> New Service Tier
                        </button>
                    </div>
                </div>

                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter " id="service-tiers-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Assessment Duration</th>
                                <th>Assessment Price</th>
                                <th>Follow up Duration</th>
                                <th>Follow up Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($service_tiers as $service_tier)
                                <tr>
                                    <td>{{ $service_tier->name }}</td>
                                    <td>{{ $service_tier->duration_assessment }} hr</td>
                                    <td>{{ $service_tier->price_assessment }}</td>
                                    <td>{{ $service_tier->duration_followup }} hr</td>
                                    <td>{{ $service_tier->price_followup }}</td>
                                    <td>{!! $service_tier->status !!}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-alt-primary js-tooltip-enabled"
                                            data-toggle="modal" data-original-title="Edit"
                                            data-target="#modal-update-{{ $service_tier->id }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-alt-danger js-tooltip-enabled"
                                            onclick="confirmDelete('serviceDelete{{ $service_tier->id }}')">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('service-tiers.destroy', ['service_tier' => $service_tier->id]) }}"
                                            id="serviceDelete{{ $service_tier->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <x-modal id="modal-update-{{ $service_tier->id }}" title="Update Service Tier">
                                    <form
                                        action="{{ route('service-tiers.update', ['service_tier' => $service_tier->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="block-content font-size-sm">
                                            <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ $service_tier->name }}" name="name" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="duration_assessment">Assessment Duration <small>(In
                                                        Hour)</small> *</label>
                                                <input type="number" class="form-control" id="duration_assessment" min="0"
                                                    step=".01" value="{{ $service_tier->duration_assessment }}"
                                                    name="duration_assessment" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="price_assessment">Assessment Price *</label>
                                                <input type="number" class="form-control" id="price_assessment" min="0"
                                                    step="any" value="{{ $service_tier->price_assessment }}"
                                                    name="price_assessment" required />
                                            </div>

                                            <div class="form-group">
                                                <label for="duration_followup">Follow up Duration <small>(In Hour)</small>
                                                    *</label>
                                                <input type="number" class="form-control" id="duration_followup" min="0"
                                                    step=".01" value="{{ $service_tier->duration_followup }}"
                                                    name="duration_followup" required/>
                                            </div>

                                            <div class="form-group">
                                                <label for="price_followup">Follow up Price *</label>
                                                <input type="number" class="form-control" id="price_followup" min="0"
                                                    step="any" value="{{ $service_tier->price_followup }}"
                                                    name="price_followup" required/>
                                            </div>

                                            <div class="form-group">
                                                <label for="is_active">Status</label>
                                                <select name="is_active" id="is_active" class="form-control">
                                                    <option value="1"
                                                        {{ $service_tier->is_active == 1 ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="0"
                                                        {{ $service_tier->is_active == 0 ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="block-content block-content-full text-right border-top">
                                            <button type="button" class="btn btn-alt-primary mr-1"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </x-modal>

                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>


            <x-modal id="modal-add" title="Add New Service Tier">
                <form action="{{ route('service-tiers.store') }}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" required />
                        </div>

                        <div class="form-group">
                            <label for="duration_assessment">Assessment Duration <small>(In Hour)</small> *</label>
                            <input type="number" class="form-control" id="duration_assessment" min="0" step=".01"
                                name="duration_assessment" required />
                        </div>

                        <div class="form-group">
                            <label for="price_assessment">Assessment Price *</label>
                            <input type="number" class="form-control" id="price_assessment" min="0" step="any"
                                name="price_assessment" required />
                        </div>

                        <div class="form-group">
                            <label for="duration_followup">Follow up Duration <small>(In Hour)</small> *</label>
                            <input type="number" class="form-control" id="duration_followup" min="0" step=".01"
                                name="duration_followup" required />
                        </div>

                        <div class="form-group">
                            <label for="price_folowup">Follow up Price *</label>
                            <input type="number" class="form-control" id="price_followup" min="0" step="any"
                                name="price_followup" required />
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
        $(document).ready(function() {
            $('#service-tiers-table').DataTable();
        })
    </script>

@endsection
