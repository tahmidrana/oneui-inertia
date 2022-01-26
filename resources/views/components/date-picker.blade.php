@props([
    'for',
    'name',
    'type' => 'text',
])

<input type="{{ $type }}" name="" id="{{ $for }}" {{ $attributes->merge(['class' => 'form-control']) }} />


@push('scripts')
<script src="{{ asset('theme/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
$('#{{ $for }}').datepicker({
    format: "dd-mm-yyyy",
});
</script>
@endpush