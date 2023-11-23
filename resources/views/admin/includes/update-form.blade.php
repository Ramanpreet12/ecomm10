<form action="{{ route('admin.family-colors.update', $family_color->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="color_name">Color Name</label>
                        <input type="text" class="form-control" id="color_name" name="color_name"
                            placeholder="Enter color name" value="{{ old('color_name', $family_color->color_name) }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="color_code">Color Code</label>
                        <input type="text" class="form-control" id="color_code" name="color_code" placeholder="#000000"
                            value="{{ old('color_code', $family_color->color_code) }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
