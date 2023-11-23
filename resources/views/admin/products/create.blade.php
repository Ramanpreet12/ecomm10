@extends('admin.layout.layout')
@section('content')
{{-- @php
    ini_set('max_execution_time', 500 ) ;
@endphp --}}

    <div class="content-wrapper">
        @include('admin.includes.page_header', [
            'page_name' => 'Products',
            'breadcrumb_link' => route('admin.dashboard'),
            'breadcrumb_item' => 'products',
        ])

        @include('admin.includes.page_main_content', [
            'card_title' => 'Add Product',
            'back_link' => route('admin.products.index'),
        ])
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="row">
                    <x-forms.text-input label="Product Name" type="text" name="product_name"
                        placeholder="Enter product name" />
                    <div class="form-group col-6">
                        <label for="category_id">Select Category Level</label>
                        <select class="form-control" name="category_id" style="width: 100%;">
                            <option value=""><b>Select</b></option>
                            {{-- <option value=""><b>Main Category</b></option>
                                                <br>
                                                <br>
                                                <br> --}}
                            {{-- Categories  foreach loop starts --}}
                            @if (!empty($getCategories))
                                @foreach ($getCategories as $categories)
                                    <option value="{{ $categories->id }}" @if (old('category_id' == $categories->id)) selected @endif>
                                        &nbsp;&nbsp;&#8226;&nbsp;&nbsp;{{ $categories->category_name }}
                                    </option>

                                    {{-- subCategories  foreach loop starts --}}
                                    @if (!empty($categories->subcategories))
                                        @foreach ($categories->subcategories as $sub_categories)
                                            <option value="{{ $sub_categories->id }}">
                                                &nbsp;&nbsp; &nbsp;&nbsp;
                                                &nbsp;&nbsp;&#8658;&nbsp;&nbsp;{{ $sub_categories->category_name }}
                                            </option>

                                            {{-- sub subCategories  foreach loop starts --}}
                                            @if (!empty($sub_categories->subcategories))
                                                @foreach ($sub_categories->subcategories as $sub_sub_categories)
                                                    <option value="{{ $sub_sub_categories->id }}"
                                                        @if (old('category_id') === $categories->id ||
                                                                old('category_id') === $sub_categories->id ||
                                                                old('category_id') === $sub_sub_categories->id) selected @endif>
                                                        &nbsp;&nbsp; &nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                                        &nbsp;&nbsp;&#9702;&nbsp;&nbsp;
                                                        {{ $sub_sub_categories->category_name }}
                                                    </option>
                                                @endforeach{{-- subsubCategories  foreach loop ends --}}
                                            @endif
                                        @endforeach{{-- subCategories  foreach loop ends --}}
                                    @endif
                                @endforeach {{-- Categories  foreach loop ends --}}
                            @endif
                            @error('category_id')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="row">
                    <x-forms.text-input label="Brand" type="number" name="brand_id" placeholder="Enter brand name" />
                    <x-forms.text-input label="Product Code" type="text" name="product_code"
                        placeholder="Enter product code" />
                </div>
                <div class="row">
                    <x-forms.text-input label="Product Price" type="number" name="product_price"
                        placeholder="Enter product price" />
                    <x-forms.text-input label="Product Discount" type="number" name="product_discount"
                        placeholder="Enter product discount" />
                </div>
                <div class="row">
                    <x-forms.textarea-component label="Product Description" name="product_description"
                        placeholder="Enter description" />
                        <x-forms.text-input label="Group Code" type="text" name="group_code"
                        placeholder="Enter group code" />
                </div>

                <div class="row">
                    {{-- <x-forms.text-input label="Product Weight" type="text" name="product_weight"
                        placeholder="Enter product weight" /> --}}
                    {{-- <x-forms.text-input label="Product Color" type="text" name="product_color"
                        placeholder="Enter product color" /> --}}
                </div>
                <div class="row">
                    {{-- <div class="form-group col-6">
                        <label for="family_color">Product Family Color</label>
                        <select class="form-control" name="family_color" style="width: 100%;">

                            <option value="0"><b>select</b></option>
                            @foreach ($family_colors as $family_color)
                                <option value="{{ $family_color->color_name }}"
                                    @if (old('family_color') === $family_color->color_name) selected @endif>
                                    <b>{{ $family_color->color_name }}</b>
                                </option>
                            @endforeach
                        </select>
                        @error('family_color')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div> --}}
                    {{-- <x-forms.text-input label="Group Code" type="text" name="group_code"
                        placeholder="Enter group code" /> --}}
                        {{-- <div class="form-group col-6">
                            <label for="is_featured">Is Featured</label>
                            <div class="form-check">
                                <input type="checkbox" value="Yes" class="form-check-input" id="exampleCheck1"
                                    name="is_featured" @if (old('is_featured')) checked @endif>
                            </div>
                            @error('is_featured')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div> --}}
                </div>

                {{-- <div class="row">

                    <x-forms.text-input label="Wash Care" type="text" name="wash_care" placeholder="Enter wash care" />
                    <x-forms.text-input label="Search Keyword" type="text" name="search_keywords"
                        placeholder="Enter product search keywords" />
                </div> --}}

                {{-- <div class="row">
                    @include('admin.includes.form-select', [
                        'label' => 'Fabric',
                        'name' => 'fabric',
                        'collection' => $productFilters['fabrics'],
                    ])
                    @include('admin.includes.form-select', [
                        'label' => 'Pattern',
                        'name' => 'pattern',
                        'collection' => $productFilters['patterns'],
                    ])
                </div> --}}

                {{-- <div class="row">
                    @include('admin.includes.form-select', [
                        'label' => 'Sleeve',
                        'name' => 'sleeve',
                        'collection' => $productFilters['sleeves'],
                    ])
                    @include('admin.includes.form-select', [
                        'label' => 'Fit',
                        'name' => 'fit',
                        'collection' => $productFilters['fits'],
                    ])
                </div> --}}
                <div class="row">
                    {{-- @include('admin.includes.form-select', [
                        'label' => 'Occassion',
                        'name' => 'occassion',
                        'collection' => $productFilters['occassions'],
                    ]) --}}
                    {{-- <div class="form-group col-6">
                        <label for="is_featured">Is Featured</label>
                        <div class="form-check">
                            <input type="checkbox" value="Yes" class="form-check-input" id="exampleCheck1"
                                name="is_featured" @if (old('is_featured')) checked @endif>
                        </div>
                        @error('is_featured')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div> --}}
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_images">Product Images</label>
                        <input type="file" class="form-control" id="product_images" name="product_images[]" multiple>
                        @error('product_images')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="is_featured">Is Featured</label>
                        <div class="form-check">
                            <input type="checkbox" value="Yes" class="form-check-input" id="exampleCheck1"
                                name="is_featured" @if (old('is_featured')) checked @endif>
                        </div>
                        @error('is_featured')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <x-forms.file-component label="Product Video" name="product_video" /> --}}
                </div>

                {{-- <div class="row">
                    <div class="field_wrapper">
                        <div class="form-group col-12">
                            <label for="product_images">Product Attributes</label>
                            <div class="d-flex">
                                <input type="text" class="form-control mr-2" name="size[]" placeholder="Enter size"
                                    id="size" style="width: 120px" value="" />
                                <input type="text" class="form-control mr-2" name="sku[]" placeholder="Enter SKU"
                                    id="sku" style="width: 120px" value="" />
                                <input type="text" class="form-control mr-2" name="price[]" placeholder="Enter price"
                                    id="price" style="width: 120px" value="" />
                                <input type="text" class="form-control mr-2" name="stock[]" placeholder="Enter stock"
                                    id="stock" style="width: 120px" value="" />
                                <a href="javascript:void(0);" class="add_button mt-2" title="Add field">
                                    <span class="text-primary"><i class="fa-solid fa-circle-plus"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <hr>
                <div class="row mt-4">
                    <x-forms.text-input label="Meta title" type="text" name="meta_title"
                        placeholder="Enter meta title" />
                    <x-forms.text-input label="Meta Keyword" type="text" name="meta_keyword"
                        placeholder="Enter meta keyword" />
                </div>
                <div class="row">
                    <x-forms.textarea-component label="Meta Description" name="meta_description"
                        placeholder="Enter meta description" />
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    </section>
    </div>
@endsection
