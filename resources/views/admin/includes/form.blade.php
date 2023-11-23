<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="card-body">
        <div class="row">

            {{-- @if (!isset($family_color->id)) --}}

            <x-forms.create-component label="Color Name" type="text" name="color_name" placeholder="Enter color name" />
            <x-forms.create-component label="Color Code" type="text" name="color_code" placeholder="Enter color code ex: #000000" />

            {{-- @else --}}


            {{-- <x-forms.update-component label="Color Name" type="text" name="color_name" placeholder="Enter color name" :value= "$family_color->color_name"/>
            <x-forms.update-component label="Color Code" type="text" name="color_code" placeholder="Enter color code ex: #000000" :value= "$family_color->color_code"/>

            @endif --}}
        </div>
        <div class="row">
            <div class="form-group col-6">
                <input type="hidden" class="form-control" id="status" name="status" value="1">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">{{ $button_name }}</button>
        </div>
</form>
