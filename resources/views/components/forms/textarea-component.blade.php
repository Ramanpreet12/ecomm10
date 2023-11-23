{{-- <div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
</div> --}}

<div class="form-group col-6">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea class="form-control" name="{{ $name }}" rows="3" placeholder="{{ $placeholder }}"
        value="{{ old($name) }}"></textarea>
</div>
