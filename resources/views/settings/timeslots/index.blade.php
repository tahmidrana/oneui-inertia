@extends('layouts.base')

@section('title', 'Dashboard')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Time slots
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Settings</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Time slots</a>
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
                <h3 class="block-title">Time slots</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option mr-2" data-toggle="modal" data-target="#modal-add-timeslot">
                        <i class="fa fa-plus mr-1"></i> New Time slot
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
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($timeslots as $timeslot)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($timeslot->start_time)->format('h:i a') }}</td>
                            <td>{{ \Carbon\Carbon::parse($timeslot->end_time)->format('h:i a') }}</td>
                            <td>{!! $timeslot->status !!}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-sm btn-alt-primary js-tooltip-enabled" data-toggle="modal"
                                    data-original-title="Edit" data-target="#modal-timeslot-{{ $timeslot->id }}">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button> --}}

                                @if($timeslot->is_active)
                                    <a href="{{ route('timeslots.deactivate', ['timeslot'=> $timeslot->id]) }}" class="btn btn-sm btn-alt-info mr-1" title="Deactivate"><i class="fa fa-fw fa-thumbs-down"></i></a>
                                @else
                                    <a href="{{ route('timeslots.activate', ['timeslot'=> $timeslot->id]) }}" class="btn btn-sm btn-alt-info mr-1" title="Activate"><i class="fa fa-fw fa-thumbs-up"></i></a>
                                @endif

                                {{-- <button type="button" class="btn btn-sm btn-alt-danger js-tooltip-enabled" onclick="confirmDelete('menuDelete{{ $timeslot->id }}')" >
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                                <form method="POST" action="{{ route('timeslots.destroy', ['timeslot'=> $timeslot->id]) }}" id="menuDelete{{ $timeslot->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form> --}}
                            </td>
                        </tr>

                        <x-modal id="modal-timeslot-{{ $timeslot->id }}" title="Update Timeslot">
                            <form action="{{ route('timeslots.update', ['timeslot' => $timeslot->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="block-content font-size-sm">
                                    <div class="form-group">
                                        <label for="start_time{{ $timeslot->id }}">Start Time *</label>
                                        <input type="text" class="js-flatpickr form-control bg-white" id="start_time{{ $timeslot->id }}"
                                            value="{{ $timeslot->start_time }}"
                                            name="start_time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="end_time{{ $timeslot->id }}">End Time *</label>
                                        <input type="text" class="js-flatpickr form-control bg-white" id="end_time{{ $timeslot->id }}"
                                            value="{{ $timeslot->end_time }}"
                                            name="end_time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="is_active">Status</label>
                                        <select name="is_active" id="is_active{{ $timeslot->id }}" class="form-control">
                                            <option value="1" {{ $timeslot->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $timeslot->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="block-content block-content-full text-right border-top">
                                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" >Submit</button>
                                </div>
                            </form>
                        </x-modal>

                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>



        <x-modal id="modal-add-timeslot" title="Create New Timeslot">
            <form action="{{ route('timeslots.store') }}" method="POST">
                @csrf
                <div class="block-content font-size-sm">
                    <div class="form-group">
                        <label for="start_time">Start Time *</label>
                        <input type="text" class="js-flatpickr form-control bg-white" id="start_time"
                            name="start_time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" required />
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time *</label>
                        <input type="text" class="js-flatpickr form-control bg-white" id="end_time"
                            name="end_time" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" required />
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
<link rel="stylesheet" href="{{ asset('theme/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('theme/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('theme/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script>
    jQuery(function(){One.helpers(['flatpickr', 'datepicker']);});
    $(document).ready(function(){
        // console.log('Page loaded')
    })
</script>

@endsection
