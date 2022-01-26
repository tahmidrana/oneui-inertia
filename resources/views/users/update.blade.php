@extends('layouts.base')

@section('title', 'Update Users')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            {{-- <h1 class="flex-sm-fill h3 my-2">
                New User <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Tables transformed with dynamic features.</small>
            </h1> --}}
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('users.index') }}">Manage Users</a>
                    </li>
                    <li class="breadcrumb-item">Update</li>
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

        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Update User Information</h3>
                </div>

                <div class="block-content block-content-full">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}"
                                    placeholder="" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="gender">Gender *</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Female</option>
                                <option value="3" {{ $user->gender == 3 ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dob">Date of Birth *</label>
                                <input type="text" name="dob" id="dob" class="form-control js-datepicker bg-white"
                                    onchange="updateAge()"
                                    autocomplete="off"
                                    value="{{ $user->dob ? $user->dob->format('d-m-Y') : '' }}"
                                    data-week-start="1"
                                    data-autoclose="true"
                                    data-today-highlight="true"
                                    data-date-format="dd-mm-yyyy"
                                    placeholder="dd-mm-yyyy" required readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" name="age" id="age" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="blood_group">Blood Group</label>
                            <select name="blood_group" id="blood_group" class="form-control">
                                @foreach (Config::get('constants.blood_groups') as $index=>$bg)
                                <option value="{{ $index }}" {{ $user->blood_group == $index ? 'selected' : '' }}>{{ $bg }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control" required/>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district_id">District *</label>
                                <select name="district_id" id="district_id" class="form-control js-select2" required>
                                    <option value="">-Select District-</option>
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ $user->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="post_code">Post Code *</label>
                                <input type="text" name="post_code" id="post_code" value="{{ $user->post_code }}" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control phone" placeholder="01XXXXXXXXX" required />
                                <small class="helper">11 digit phone no</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control" />
                                <small>png,jpg,jpeg</small><br>
                                <a href="{{ url($user->photo_path) }}">View Photo</a>
                            </div>
                        </div>
                    </div>

                    <h2 class="content-heading border-bottom mb-4 pb-2">Emergency Contact</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_name">Name *</label>
                                <input type="text" name="em_contact_name" id="em_contact_name"
                                    value="{{ $user->em_contact_name }}" class="form-control" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_relation">Relation with client *</label>
                                <input type="text" name="em_contact_relation" id="em_contact_relation"
                                    value="{{ $user->em_contact_relation }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_phone">Phone *</label>
                                <input type="text" name="em_contact_phone" id="em_contact_phone"
                                    value="{{ $user->em_contact_phone }}" class="form-control phone" placeholder="01XXXXXXXXX" required />
                                    <small class="helper">11 digit phone no</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_email">Email *</label>
                                <input type="email" name="em_contact_email" id="em_contact_email"
                                    value="{{ $user->em_contact_email }}" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <h2 class="content-heading border-bottom mb-4 pb-2">HR Info</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="joining_date">Joining Date</label>
                                <input type="text" name="joining_date" id="joining_date"
                                    value="{{ $user->joining_date ? $user->joining_date->format('d-m-Y') : '' }}"
                                    autocomplete="off"
                                    data-week-start="1"
                                    data-autoclose="true"
                                    data-today-highlight="true"
                                    data-date-format="dd-mm-yyyy"
                                    placeholder="dd-mm-yyyy"
                                    class="form-control js-datepicker bg-white" readonly />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_educational_qual">Last Educational Qualification</label>
                                <input type="text" name="last_educational_qual" id="last_educational_qual"
                                    value="{{ $user->last_educational_qual }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employment_type">Employment Type *</label>
                                <select name="employment_type" id="employment_type" class="form-control" required>
                                    <option value="1" {{ $user->employment_type == 1 ? 'selected' : '' }}>Permanent</option>
                                    <option value="2" {{ $user->employment_type == 2 ? 'selected' : '' }}>Part time</option>
                                    <option value="3" {{ $user->employment_type == 3 ? 'selected' : '' }}>Contractual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>

            </div>

        </form>

    </div>
</div>

@endsection


@section('styles_before')
<link rel="stylesheet" href="{{ asset('theme/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('theme/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('theme/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('theme/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    jQuery(function(){One.helpers(['datepicker', 'select2']);});
    $(document).ready(function(){
        // console.log('Page loaded')
        updateAge();
        $(".phone").mask("99999999999");
    })

    function updateAge()
    {
        var dob = $('#dob').val()
        if(dob.length) {
            var year = dob.split('-').pop();
            var currentYear = new Date().getFullYear();
            $('#age').val((currentYear - parseInt(year)))
        }
    }
</script>

@endsection
