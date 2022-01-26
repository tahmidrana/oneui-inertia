@extends('layouts.base')

@section('title', 'Add New Users')

@section('breadcrumb')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            {{-- <h1 class="flex-sm-fill h3 my-2">
                New User <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Tables transformed with dynamic features.</small>
            </h1> --}}
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Add New User</a>
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
        <h2 class="content-heading">Add New User</h2>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="block block-rounded">
                <div class="block-header">
                    <h3 class="block-title">Create New User</h3>
                </div>

                <div class="block-content block-content-full">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="" required />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="userid">User Code *</label>
                                <input type="text" name="userid" id="userid" class="form-control"
                                    value="{{ old('userid') }}"
                                    required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="gender">Gender *</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
                                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
                                <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dob">Date of Birth *</label>
                                <input type="text" name="dob" id="dob" class="form-control js-datepicker bg-white bg-white"
                                    onchange="updateAge()"
                                    autocomplete="off"
                                    value="{{ old('dob') }}"
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
                                <input type="text" name="age" id="age" value="{{ old('age') }}" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="blood_group">Blood Group</label>
                            <select name="blood_group" id="blood_group" class="form-control">
                                <option value="1" {{ old('blood_group') == 1 ? 'selected' : '' }}>A+</option>
                                <option value="2" {{ old('blood_group') == 2 ? 'selected' : '' }}>A-</option>
                                <option value="3" {{ old('blood_group') == 3 ? 'selected' : '' }}>B+</option>
                                <option value="4" {{ old('blood_group') == 4 ? 'selected' : '' }}>B-</option>
                                <option value="5" {{ old('blood_group') == 5 ? 'selected' : '' }}>O+</option>
                                <option value="6" {{ old('blood_group') == 6 ? 'selected' : '' }}>O-</option>
                                <option value="7" {{ old('blood_group') == 7 ? 'selected' : '' }}>AB+</option>
                                <option value="8" {{ old('blood_group') == 8 ? 'selected' : '' }}>AB-</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control" required/>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district_id">District *</label>
                                <select name="district_id" id="district_id" class="form-control js-select2" required>
                                    <option value="">-Select District-</option>
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="post_code">Post Code *</label>
                                <input type="text" name="post_code" id="post_code" value="{{ old('post_code') }}" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control phone" placeholder="01XXXXXXXXX" required />
                                <small class="helper">11 digit phone no</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control" />
                        <small>png,jpg,jpeg</small>
                    </div>

                    <h2 class="content-heading border-bottom mb-4 pb-2">Emergency Contact</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_name">Name *</label>
                                <input type="text" name="em_contact_name" id="em_contact_name" value="{{ old('em_contact_name') }}" class="form-control" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_relation">Relation with client *</label>
                                <input type="text" name="em_contact_relation" id="em_contact_relation" value="{{ old('em_contact_relation') }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_phone">Phone *</label>
                                <input type="text" name="em_contact_phone" id="em_contact_phone" value="{{ old('em_contact_phone') }}"
                                    class="form-control phone" placeholder="01XXXXXXXXX" required />
                                <small class="helper">11 digit phone no</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="em_contact_email">Email *</label>
                                <input type="email" name="em_contact_email" id="em_contact_email" value="{{ old('em_contact_email') }}" class="form-control" required />
                            </div>
                        </div>
                    </div>

                    <h2 class="content-heading border-bottom mb-4 pb-2">HR Info</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="joining_date">Joining Date</label>
                                <input type="text" name="joining_date" id="joining_date" value="{{ old('joining_date') }}"
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
                                <input type="text" name="last_educational_qual" id="last_educational_qual" value="{{ old('last_educational_qual') }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_type_id">User Type *</label>
                                <select name="user_type_id" id="user_type_id" class="form-control" required>
                                    <option value="">-Select User Type-</option>
                                    @foreach ($user_types as $user_type)
                                    <option value="{{ $user_type->id }}" {{ old('user_type_id') == $user_type->id ? 'selected' : '' }}>{{ $user_type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="other_roles_id">Other Role</label>
                                <select name="other_roles_id[]" id="other_roles_id" class="form-control js-select2" multiple>
                                @foreach ($user_types as $user_type)
                                    <option value="{{ $user_type->id }}"
                                        {{ is_array(old('other_roles_id')) && in_array($user_type->id, old('other_roles_id')) ? 'selected' : '' }}>
                                        {{ $user_type->title }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employment_type">Employment Type *</label>
                                <select name="employment_type" id="employment_type" class="form-control" required>
                                    <option value="1" {{ old('employment_type') == 1 ? 'selected' : '' }}>Permanent</option>
                                    <option value="2" {{ old('employment_type') == 2 ? 'selected' : '' }}>Part time</option>
                                    <option value="3" {{ old('employment_type') == 3 ? 'selected' : '' }}>Contractual</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
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
