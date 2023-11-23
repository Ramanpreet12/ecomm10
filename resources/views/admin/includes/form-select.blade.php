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
