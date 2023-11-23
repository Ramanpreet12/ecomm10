{{-- <div>
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div> --}}

<div class="form-group col-6">
    <label for="{{ $name }}">{{ $label }}</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="{{ $name }}" name="{{ $name }}">
            <label class="custom-file-label" for="{{ $name }}">Choose
                file</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text">Upload</span>
        </div>
    </div>
</div>
