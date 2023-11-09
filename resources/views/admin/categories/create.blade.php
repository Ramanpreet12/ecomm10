@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        @include('admin.includes.page_header', [
            'page_name' => 'Categories',
            'breadcrumb_link' => route('admin.dashboard'),
            'breadcrumb_item' => 'categories',
        ])
        @include('admin.includes.page_main_content', [
            'card_title' => 'Add Category',
            'back_link' => route('admin.categories.index'),
        ])

        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            placeholder="Enter category name" value="{{ old('category_name') }}">
                        @error('category_name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="category_name">Select Category Level</label>
                        <select class="form-control" name="parent_id" style="width: 100%;">

                            <option value="0"><b>Main Category</b></option>
                            <br>
                            <br>
                            <br>
                            {{-- Categories  foreach loop starts --}}
                            @if (!empty($getCategories))
                                @foreach ($getCategories as $categories)
                                    <option value="{{ $categories->id }}">
                                        &nbsp;&nbsp;&#8226;&nbsp;&nbsp;{{ $categories->category_name }}</option>

                                    {{-- subCategories  foreach loop starts --}}
                                    @if (!empty($categories->subcategories))
                                        @foreach ($categories->subcategories as $sub_categories)
                                            <option value="{{ $sub_categories->id }}">
                                                &nbsp;&nbsp; &nbsp;&nbsp;
                                                &nbsp;&nbsp;&#8658;&nbsp;&nbsp;{{ $sub_categories->category_name }}</option>

                                            {{-- sub subCategories  foreach loop starts --}}
                                            @if (!empty($sub_categories->subcategories))
                                                @foreach ($sub_categories->subcategories as $sub_sub_categories)
                                                    <option value="{{ $sub_sub_categories->id }}">
                                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                                        &nbsp;&nbsp;&#9702;&nbsp;&nbsp;
                                                        {{ $sub_sub_categories->category_name }}
                                                    </option>
                                                @endforeach{{-- subsubCategories  foreach loop ends --}}
                                            @endif
                                        @endforeach{{-- subCategories  foreach loop ends --}}
                                    @endif
                                @endforeach {{-- Categories  foreach loop ends --}}
                            @endif

                        </select>

                    </div>



                </div>

                <div class="row">

                    <div class="form-group col-6">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="ex:about-page"
                            value="{{ old('url') }}">
                        @error('url')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="category_discount">Category Discount</label>
                        <input type="text" class="form-control" id="category_discount" name="category_discount"
                            placeholder="Enter category discount" value="{{ old('category_discount') }}">
                        @error('category_discount')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-6">
                        <label for="category_image">Category Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                <label class="custom-file-label" for="category_image">Choose
                                    file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter Description"
                            value="{{ old('description') }}"></textarea>
                    </div>

                </div>


                <hr>
                <div class="row mt-4">

                    <div class="form-group col-6">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            placeholder="Enter Meta keyword" value="{{ old('meta_title') }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                            placeholder="Enter Meta keyword" value="{{ old('meta_keyword') }}">
                    </div>

                </div>

                <div class="row">


                    <div class="form-group col-6">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter Meta Description"
                            value="{{ old('meta_description') }}"></textarea>
                    </div>


                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>
    <!-- /.card -->


    </div>
    <!--/.col (left) -->
    <!-- right column -->

    <!--/.col (right) -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
