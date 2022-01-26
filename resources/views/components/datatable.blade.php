<div>
<table class="{{ $class ? $class : 'table table-bordered table-striped table-vcenter' }}" id="{{ $id }}" style="width: 100%;">
    <thead>
        <tr>
            @foreach ($columns as $td)
                <th {{ isset($td['visible']) && $td['visible'] == false ? 'hidden="true"' : '' }}>{{ isset($td['th']) ? $td['th'] : $td['data'] }}</th>
            @endforeach
        </tr>
    </thead>
</table>


@section('datatable_styles')
<link rel="stylesheet" href="{{ asset('theme/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('theme/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

@endsection

@section('datatable_scripts')
    <script src="{{ asset('theme/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    @if ($buttons)
    <!-- Button scripts -->
    <script src="{{ asset('theme/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    {{-- <script src="{{ asset('theme/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('theme/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script> --}}

    <script src="{{ asset('theme/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/datatables/jszip.min.js') }}"></script>
    {{-- PDF export scripts
    <script src="{{ asset('theme/js/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/datatables/vfs_fonts.js') }}"></script> --}}
    <!-- Button scripts -->
    @endif

    <!-- Page JS Code -->
    {{-- <script src="{{ asset('theme/js/pages/be_tables_datatables.min.js') }}"></script> --}}
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var columns = @json($columns);
            var buttonsShow = '{{ $buttons == true ? "true" : "false" }}';
            var searching = '{{ $searching == true ? "true" : "false" }}';
            var paging = '{{ $paging == true ? "true" : "false" }}';
            var noDataInit = '{{ $noDataInit == true ? "true" : "false" }}';

            var dtTableInitializeObjectValues = {
                responsive: true,
                processing: true,
                serverSide: true,
                searchDelay: 1000,
                ajax: '{{ $url }}',
                columns: columns,
                async: true,
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {
                        "targets": [ -1 ],
                        "searchable": false,
                        "sortable": false,
                        className: 'text-right'
                    }
                ]
            };

            if (buttonsShow == 'true') {
                // 'pdfHtml5'
                dtTableInitializeObjectValues.dom = "Bfrtip";
                dtTableInitializeObjectValues.buttons = [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                    // 'excelHtml5',
                    // 'csvHtml5'
                ];
            }

            if (searching == 'false') {
                dtTableInitializeObjectValues.searching = false;
            }

            if (paging == 'false') {
                dtTableInitializeObjectValues.paging = false;
                dtTableInitializeObjectValues.info = false;
            }

            if (noDataInit == 'true') {
                dtTableInitializeObjectValues.deferLoading = 0;
            }


            var dtable = $('#{!! $id !!}').DataTable(dtTableInitializeObjectValues);

            $('#{!! $id !!}_filter input')
            .unbind() // Unbind previous default bindings
            .bind("input", function(e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if(this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    dtable.search(this.value).draw();
                }
                // Ensure we clear the search if they backspace far enough
                if(this.value == "") {
                    dtable.search("").draw();
                }
                return;
            });

            /* Works fine
            dtable.on('init.dt', function() {
                console.log('Datatable processing');
            }) */
        })
    </script>

@endpush
</div>
