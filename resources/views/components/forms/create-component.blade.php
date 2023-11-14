{{-- <div>
    <!-- Be present above all else. - Naval Ravikant -->
</div> --}}

<div class="form-group col-6">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ old($name) }}">
</div>

