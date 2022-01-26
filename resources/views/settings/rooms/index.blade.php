@extends('layouts.base')

@section('title', 'Rooms Setting')

@section('breadcrumb')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Rooms
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Rooms</a>
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
                    <h3 class="block-title">Rooms</h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-alt-primary" data-toggle="modal" data-target="#modal-add"
                                data-original-title="Filter" data-class="d-none">
                            <i class="fa fa-plus"></i> New Room
                        </button>
                    </div>
                </div>

                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter " id="rooms-table">
                        <thead>
                        <tr>
                            <th>Branch</th>
                            <th>Room No</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>{{ $room->branch ?? '-' }}</td>
                                <td>{{ $room->room_no ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-alt-primary js-tooltip-enabled" data-toggle="modal"
                                            data-original-title="Edit" data-target="#modal-update-{{ $room->id }}">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>

                                    <button type="button" class="btn btn-sm btn-alt-danger js-tooltip-enabled" onclick="confirmDelete('roomDelete{{ $room->id }}')" >
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    <form method="POST" action="{{ route('rooms.destroy', ['room'=> $room->id]) }}" id="roomDelete{{ $room->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <x-modal id="modal-update-{{ $room->id }}" title="Update Room">
                                <form action="{{ route('rooms.update', ['room'=> $room->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="block-content font-size-sm">
                                        <div class="form-group">
                                            <label for="branch{{ $room->id }}">Branch *</label>
                                            <input type="text" class="form-control" id="branch{{ $room->id }}" value="{{ $room->branch }}"
                                                name="branch" />
                                        </div>

                                        <div class="form-group">
                                            <label for="room_no{{ $room->id }}">Room No *</label>
                                            <input type="text" class="form-control" id="room_no{{ $room->id }}" value="{{ $room->room_no }}"
                                                name="room_no" />
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


            <x-modal id="modal-add" title="Add New Room">
                <form action="{{ route('rooms.store') }}" method="POST">
                    @csrf
                    <div class="block-content font-size-sm">
                        <div class="form-group">
                            <label for="branch">Branch *</label>
                            <input type="text" class="form-control" id="branch"
                                name="branch" />
                        </div>

                        <div class="form-group">
                            <label for="room_no">Room No *</label>
                            <input type="text" class="form-control" id="room_no"
                                name="room_no" />
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
            $('#rooms-table').DataTable();
            // toggleBranchRoom();
        })

        function toggleBranchRoom(room_id = '') {
            var service_type = $('#place_of_service' + room_id).val();
            if(service_type == 1) {
                $('#branch_room_wrapper' + room_id).show();
                document.getElementById("branch" + room_id).required = true;
                document.getElementById("room_no" + room_id).required = true;
            } else {
                $('#branch_room_wrapper' + room_id).hide();
                document.getElementById("branch" + room_id).required = false;
                document.getElementById("room_no" + room_id).required = false;
            }
        }
    </script>

@endsection
