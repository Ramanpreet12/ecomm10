{{-- <div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div> --}}

<div class="form-group col-6">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}">
        <option value="">select</option>
        @foreach ($collection as $item)
            <option value="{{ $item }}" @if (old($name) === $item) selected @endif>
                {{ $item }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="text-danger"> {{ $message }}</span>
    @enderror
</div>


