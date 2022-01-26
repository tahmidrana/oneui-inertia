@extends('layouts.base')

@section('title', 'Dashboard')

@section('breadcrumb')

@endsection



@section('content')

<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left mb-3">
    <div class="flex-sm-fill">
        <h1 class="h3 font-w700 mb-2">
            Main Dashboard
        </h1>
        <h2 class="h6 font-w500 text-muted mb-0">
            Welcome <a class="font-w600" href="javascript:void(0)">{{ auth()->user()->name }}</a>,
            you are logged in as <strong>{{ auth()->user()->is_superuser ? 'Super Admin' : (session()->has('role') ? session('role')->title : '') }}</strong>
        </h2>
    </div>
</div>

<div class="row row-deck">
    <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $active_clients }}</dt>
                    <dd class="text-muted mb-0">Active Clients</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-users font-size-h3 text-primary"></i>
                </div>
            </div>
            {{-- <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                    View all orders
                    <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                </a>
            </div> --}}
        </div>
    </div>

    @if (session()->has('role') && session('role')->slug != 'clinician')
    <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $active_clinicians }}</dt>
                    <dd class="text-muted mb-0">Active Clinicians</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-user font-size-h3 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $clinical_sessions }}</dt>
                    <dd class="text-muted mb-0">Clinical sessions</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-calendar-alt font-size-h3 text-primary"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $supervision }}</dt>
                    <dd class="text-muted mb-0">Supervision</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-clipboard font-size-h3 text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $corporate_sessions }}</dt>
                    <dd class="text-muted mb-0">Corporate Sessions</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-calendar-check font-size-h3 text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('role') && session('role')->slug == 'clinician')
    <div class="col-sm-6 col-xl-3">
        <div class="block block-rounded d-flex flex-column">
            <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                <dl class="mb-0">
                    <dt class="font-size-h2 font-w700">{{ $total_planned_hours }}</dt>
                    <dd class="text-muted mb-0">Total planned hours</dd>
                </dl>
                <div class="item item-rounded bg-body">
                    <i class="fa fa-clock font-size-h3 text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


@endsection


@section('styles')
<!-- DevExtreme theme -->
{{-- <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/21.1.3/css/dx.light.css"> --}}
<link rel="stylesheet" href="{{ asset('theme/js/plugins/dev-extreme-21-1/dx.light.css') }}">

<style>
.dx-scheduler-header .dx-widget {
    visibility: hidden
}
.dx-scheduler-navigator-previous {
    visibility: hidden
}
.dx-scheduler-navigator-next {
    visibility: hidden
}
</style>

@endsection

@section('scripts')
<!-- DevExtreme library -->
{{-- <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.1.3/js/dx.all.js"></script> --}}
<script type="text/javascript" src="{{ asset('theme/js/plugins/dev-extreme-21-1/dx.all.js') }}"></script>

<script src="{{ asset('theme/js/plugins/luxon.min.js') }}"></script>

<script>

    $(document).ready(function (){
        var today = luxon.DateTime.now().toISODate();
        $('#today').val(today);
        $('#curr_date_val').html(today);

        // getCalendarData();
    })

    function nextClick() {
        var curr_date = $('#today').val();
        var date = luxon.DateTime.fromISO(curr_date);
        var new_date = date.plus({ days: 1 }).toISODate();
        $('#today').val(new_date);
        $('#curr_date_val').html(new_date);
        getCalendarData();
    }

    function previousClick() {
        var curr_date = $('#today').val();
        var date = luxon.DateTime.fromISO(curr_date);
        var new_date = date.minus({ days: 1 }).toISODate();
        $('#today').val(new_date);
        $('#curr_date_val').html(new_date);
        getCalendarData();
    }

    function getCalendarData() {
        //
    }

    function makeDailyCalenderView (data) {
        //
    }

    function getDataById(events, id) {
        return DevExpress.data.query(events)
                .filter("id", id)
                .toArray()[0];
    }


</script>

@endsection
