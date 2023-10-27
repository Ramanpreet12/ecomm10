@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Product</h3>
                                <a class="float-right" href="{{ route('admin.products.index') }}">
                                    <button class="btn btn-primary">Back</button>
                                </a>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name"
                                                placeholder="Enter product name" value="{{ old('product_name') }}">
                                            @error('product_name')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>

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
                                                        <option value="{{ $categories->id }}" @if(old('category_id' ==$categories->id  ))selected  @endif>
                                                            &nbsp;&nbsp;&#8226;&nbsp;&nbsp;{{ $categories->category_name }}
                                                        </option>

                                                        {{-- subCategories  foreach loop starts --}}
                                                        @if (!empty($categories->subcategories))
                                                            @foreach ($categories->subcategories as $sub_categories)
                                                                <option value="{{ $sub_categories->id }}" >
                                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                                    &nbsp;&nbsp;&#8658;&nbsp;&nbsp;{{ $sub_categories->category_name }}
                                                                </option>

                                                                {{-- sub subCategories  foreach loop starts --}}
                                                                @if (!empty($sub_categories->subcategories))
                                                                    @foreach ($sub_categories->subcategories as $sub_sub_categories)
                                                                        <option value="{{ $sub_sub_categories->id }}" @if (old('category_id') ===$categories->id || old('category_id') ===$sub_categories->id || old('category_id') ===$sub_sub_categories->id ) selected @endif>
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
                                        <div class="form-group col-6">
                                            <label for="brand_id">Brand</label>
                                            <input type="text" class="form-control" id="brand_id" name="brand_id"
                                                placeholder="Enter brand name" value="{{ old('brand_id') }}">
                                            @error('brand_id')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="product_code">Product Code</label>
                                            <input type="text" class="form-control" id="product_code" name="product_code"
                                                placeholder="Enter product code" value="{{ old('product_code') }}">
                                            @error('product_code')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="product_price">Product Price</label>
                                            <input type="text" class="form-control" id="product_price"
                                                name="product_price" placeholder="Enter product price"
                                                value="{{ old('product_price') }}">
                                            @error('product_price')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="product_discount">Product Discount</label>
                                            <input type="text" class="form-control" id="product_discount"
                                                name="product_discount" placeholder="Enter product discount"
                                                value="{{ old('product_discount') }}">
                                            @error('product_discount')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- will be added during post the data not here --}}
                                    {{-- <div class="row">
                                        <div class="form-group col-6">
                                            <label for="discount_type">Discount Type</label>
                                            <input type="text" class="form-control" id="discount_type" name="discount_type"
                                                placeholder="Enter discount type" value="{{ old('discount_type') }}">
                                            @error('discount_type')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="final_price">Final Price</label>
                                            <input type="text" class="form-control" id="final_price"
                                                name="final_price" placeholder="Enter final price"
                                                value="{{ old('final_price') }}">
                                                @error('final_price')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="product_description">Product Description</label>
                                            <textarea class="form-control" id="" cols="2" rows="2" name="product_description"
                                                placeholder="Enter product description">{{ old('product_description') }}</textarea>
                                            @error('product_description')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="product_video">Product Video</label>
                                            <input type="file" class="form-control" id="product_video"
                                                name="product_video" placeholder="Enter product Video"
                                                value="{{ old('product_video') }}">
                                            @error('product_video')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="product_weight">Product Weight</label>
                                            <input type="text" class="form-control" id="product_weight"
                                                name="product_weight" placeholder="Enter product weight"
                                                value="{{ old('product_weight') }}">

                                            @error('product_weight')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="product_color">Product Color</label>
                                            <input type="text" class="form-control" id="product_color"
                                                name="product_color" placeholder="Enter product color"
                                                value="{{ old('product_color') }}">
                                            @error('product_color')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="family_color">Product Family Color</label>
                                            {{-- <input type="text" class="form-control" id="family_color"
                                            name="family_color" placeholder="Enter product family color"
                                            value="{{ old('family_color') }}"> --}}

                                            <select class="form-control" name="family_color" style="width: 100%;">

                                                <option value="0"><b>select</b></option>
                                                <option value="Red"  @if (old('family_color') === 'Red') selected @endif><b>Red</b></option>
                                                <option value="Blue" @if (old('family_color') === 'Blue') selected @endif><b>Blue</b></option>
                                                <option value="Green" @if (old('family_color') === 'Green') selected @endif><b>Green</b></option>
                                                <option value="Yellow" @if (old('family_color') === 'Yellow') selected @endif><b>Yellow</b></option>
                                                <option value="Black" @if (old('family_color') === 'Black') selected @endif><b>Black</b></option>
                                                <option value="Brown" @if (old('family_color') === 'Brown') selected @endif><b>Brown</b></option>
                                                <option value="White" @if (old('family_color') === 'White') selected @endif><b>White</b></option>
                                                <option value="Pink" @if (old('family_color') === 'Pink') selected @endif><b>Pink</b></option>
                                                <option value="Grey" @if (old('family_color') === 'Grey') selected @endif><b>Grey</b></option>
                                                <option value="Golden" @if (old('family_color') === 'Golden') selected @endif><b>Golden</b></option>
                                                <option value="Silver" @if (old('family_color') === 'Silver') selected @endif><b>Silver</b></option>
                                                <option value="Orange" @if (old('family_color') === 'Orange') selected @endif><b>Orange</b></option>
                                            </select>


                                            @error('family_color')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="group_code">Group Code</label>
                                            <input type="text" class="form-control" id="group_code" name="group_code"
                                                placeholder="Enter group code" value="{{ old('group_code') }}">
                                            @error('group_code')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="wash_care">Wash Care</label>
                                            <input type="text" class="form-control" id="wash_care" name="wash_care"
                                                placeholder="Enter wash care " value="{{ old('wash_care') }}">

                                            @error('wash_care')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="search_keywords">Search Keyword</label>
                                            <input type="text" class="form-control" id="search_keywords"
                                                name="search_keywords" placeholder="Enter product search keywords"
                                                value="{{ old('search_keywords') }}">
                                            @error('search_keywords')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="fabric">Fabric</label>
                                            <select class="form-control" id="fabric" name="fabric">
                                                <option value="">select</option>
                                                @foreach ($productFilters['fabrics'] as $fabric)
                                                    <option value="{{ $fabric }}" @if (old('fabric') === $fabric) selected @endif>{{ $fabric }}</option>
                                                @endforeach
                                            </select>
                                            @error('fabric')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="pattern">Pattern</label>
                                            <select class="form-control" id="pattern" name="pattern">
                                                <option value="">select</option>
                                                @foreach ($productFilters['patterns'] as $pattern)
                                                    <option value="{{ $pattern }}"  @if (old('pattern') === $pattern) selected @endif>{{ $pattern }}</option>
                                                @endforeach
                                            </select>

                                            @error('pattern')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="sleeve">Sleeve</label>
                                                <select class="form-control" id="sleeve" name="sleeve">
                                                    <option value="">select</option>
                                                    @foreach ($productFilters['sleeves'] as $sleeve)
                                                        <option value="{{ $sleeve }}"  @if (old('sleeve') === $sleeve) selected @endif>{{ $sleeve }}</option>
                                                    @endforeach
                                                </select>


                                            @error('sleeve')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="fit">Fit</label>


                                                <select class="form-control" id="fit" name="fit">
                                                    <option value="">select</option>
                                                    @foreach ($productFilters['fits'] as $fit)
                                                        <option value="{{ $fit }}"  @if (old('fit') === $fit) selected @endif>{{ $fit }}</option>
                                                    @endforeach
                                                </select>

                                            @error('fit')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="occassion">Occassion</label>
                                                <select class="form-control" id="occassion" name="occassion">
                                                    <option value="">select</option>
                                                    @foreach ($productFilters['occassions'] as $occassion)
                                                        <option value="{{ $occassion }}"  @if (old('occassion') === $occassion) selected @endif>{{ $occassion }}</option>
                                                    @endforeach
                                                </select>
                                            @error('occassion')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="is_featured">Is Featured</label>
                                            <div class="form-check">
                                                <input  type="checkbox" value="Yes" class="form-check-input"
                                                     id="exampleCheck1" name="is_featured" @if(old('is_featured')) checked @endif>
                                            </div>
                                            @error('is_featured')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="form-group col-6">
                                            <label for="category_image">Category Image</label>
                                            <div     class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="category_image"
                                                        name="category_image">
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

                                    </div> --}}

                                    <hr>
                                    <div class="row mt-4">

                                        <div class="form-group col-6">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                                placeholder="Enter meta title" value="{{ old('meta_title') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="meta_keyword">Meta Keyword</label>
                                            <input type="text" class="form-control" id="meta_keyword"
                                                name="meta_keyword" placeholder="Enter meta keyword"
                                                value="{{ old('meta_keyword') }}">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter meta description"
                                               >{{ old('meta_description') }}</textarea>
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
