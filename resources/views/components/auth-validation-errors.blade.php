@props(['errors'])

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" {{ $attributes }}>
        <strong>{{ __('Whoops! Something went wrong.') }}</strong> <br>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
