@props([
    'placeholder' => 'Search...',
    'btn' => 'btn-outline-base btn--sm',
    'dateSearch' => 'no',
    'keySearch' => 'yes',
])


<form  method="GET" class="d-flex flex-wrap gap-2 justify-content-end">
    @if ($keySearch == 'yes')
        <x-search-key-field placeholder="{{ $placeholder }}" btn="{{ $btn }}" />
    @endif
    @if ($dateSearch == 'yes')
        <x-search-date-field />
    @endif

</form>
