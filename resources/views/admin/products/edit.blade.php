@extends('admin.layout.layout')
@push('styles')
    <style>
        .dark-mode .close,
        .dark-mode .mailbox-attachment-close {
            color: #fff;
            text-shadow: 0 1px 0 #495057fc;
        }

        .product_image_container {
            display: flex;
            flex-wrap: wrap;
            /* border: 1px solid; */
        }

        .product_image {
            border: 1px solid #6C757D;
            position: relative;
            margin: 20px;
        }


        .product_delete_button_link {
            position: absolute;
            background: #f2321e;
            border-radius: 21px;
            padding: 15px 9px;
            width: 31px;
            height: 31px;
            top: -16px;
            right: -16px;
            z-index: 100;
            padding-left: 9px;
            padding-top: 3px;
        }

        .product_image_box {
            padding: 10px;
        }

        .product_video_box {
            padding: 10px;
            padding-top: 20px;
            text-align: center;
        }

        input.image_card_input {
            width: 100px;
            height: 30px;
            text-align: center;
            margin: auto;
            margin-bottom: 10px;
        }
    </style>
@endpush
@section('content')

    <div class="content-wrapper">
        @include('admin.includes.page_header', [
            'page_name' => 'Products',
            'breadcrumb_link' => route('admin.dashboard'),
            'breadcrumb_item' => 'products',
        ])
        @include('admin.includes.page_main_content', [
            'card_title' => 'Edit Product',
            'back_link' => route('admin.products.index'),
        ])

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="Enter product name" value="{{ old('product_name', $product->product_name) }}">
                        @error('product_name')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="category_id">Select Category Level</label>
                        <select class="form-control" name="category_id" style="width: 100%;">
                            <option value=""><b>Select</b></option>

                            {{-- Categories  foreach loop starts --}}
                            @if (!empty($getCategories))
                                @foreach ($getCategories as $categories)
                                    <option value="{{ $categories->id }}" @if ($categories->id == $product->category_id) selected @endif>
                                        &nbsp;&nbsp;&#8226;&nbsp;&nbsp;{{ $categories->category_name }}</option>

                                    {{-- subCategories  foreach loop starts --}}
                                    @if (!empty($categories->subcategories))
                                        @foreach ($categories->subcategories as $sub_categories)
                                            <option value="{{ $sub_categories->id }}"
                                                @if ($sub_categories->id == $product->category_id) selected @endif>
                                                &nbsp;&nbsp; &nbsp;&nbsp;
                                                &nbsp;&nbsp;&#8658;&nbsp;&nbsp;{{ $sub_categories->category_name }}</option>

                                            {{-- sub subCategories  foreach loop starts --}}
                                            @if (!empty($sub_categories->subcategories))
                                                @foreach ($sub_categories->subcategories as $sub_sub_categories)
                                                    <option value="{{ $sub_sub_categories->id }}"
                                                        @if ($sub_sub_categories->id == $product->category_id) selected @endif>
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
                        <label for="brand_id">Brand</label>
                        <input type="text" class="form-control" id="brand_id" name="brand_id"
                            placeholder="Enter brand name" value="{{ old('brand_id', $product->brand_id) }}">
                        @error('brand_id')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code"
                            placeholder="Enter product code" value="{{ old('product_code', $product->product_code) }}">
                        @error('product_code')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_price">Product Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price"
                            placeholder="Enter product price" value="{{ old('product_price', $product->product_price) }}">
                        @error('product_price')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="product_discount">Product Discount</label>
                        <input type="text" class="form-control" id="product_discount" name="product_discount"
                            placeholder="Enter product discount"
                            value="{{ old('product_discount', $product->product_discount) }}">
                        @error('product_discount')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_description">Product Description</label>
                        <textarea class="form-control" id="" cols="2" rows="2" name="product_description"
                            placeholder="Enter product description">{{ old('product_description', $product->product_description) }}</textarea>
                        @error('product_description')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="row">

                                        <div class="form-group col-6">
                                        </div>
                                        <div class="form-group col-6">

                                            @if (!empty($product->product_video))
                                            <div class="img-wrap">
                                                <a href="javascript:void(0);" class="confirmDelete" data-toggle="tooltip"
                                                    title="Delete Image" module="product-video"
                                                    module_id={{ $product->id }}>
                                                    <span class="close">&times;</span>
                                                </a>
                                                <a href="{{ asset('storage/front/videos/products/' . $product->product_video) }}"
                                                    target="_blank">
                                                        <video width="300" controls>
                                                            <source src="{{ asset('storage/front/videos/products/' . $product->product_video) }}" type="video/mp4">
                                                            Your browser does not support HTML video.
                                                          </video>
                                                </a>
                                            </div>
                                            @else
                                            <div class="img-wrap">
                                                    <img src="{{ asset('admin/img/no-image.png') }}"
                                                        alt="" srcset="" height="130px" width="150px">
                                            </div>
                                            @endif
                                        </div>
                                    </div> --}}

                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_weight">Product Weight</label>
                        <input type="text" class="form-control" id="product_weight" name="product_weight"
                            placeholder="Enter product weight"
                            value="{{ old('product_weight', $product->product_weight) }}">

                        @error('product_weight')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="product_color">Product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color"
                            placeholder="Enter product color" value="{{ old('product_color', $product->product_color) }}">
                        @error('product_color')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="family_color">Product Family Color</label>
                        <select class="form-control" name="family_color" style="width: 100%;">

                            <option value="0"><b>select</b></option>
                            @foreach ($family_colors as $family_color)
                                <option value="{{ $family_color->color_name }}"
                                    @if ($product->family_color === $family_color->color_name) selected @endif>
                                    <b>{{ $family_color->color_name }}</b>
                                </option>
                            @endforeach
                        </select>

                        @error('family_color')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="group_code">Group Code</label>
                        <input type="text" class="form-control" id="group_code" name="group_code"
                            placeholder="Enter group code" value="{{ old('group_code', $product->group_code) }}">
                        @error('group_code')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="wash_care">Wash Care</label>
                        <input type="text" class="form-control" id="wash_care" name="wash_care"
                            placeholder="Enter wash care " value="{{ old('wash_care', $product->wash_care) }}">

                        @error('wash_care')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="search_keywords">Keyword</label>
                        <input type="text" class="form-control" id="search_keywords" name="search_keywords"
                            placeholder="Enter product search keywords"
                            value="{{ old('search_keywords', $product->search_keywords) }}">
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
                                <option value="{{ $fabric }}" @if (old('fabric', $product->fabric) === $fabric) selected @endif>
                                    {{ $fabric }}</option>
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
                                <option value="{{ $pattern }}" @if (old('pattern', $product->pattern) === $pattern) selected @endif>
                                    {{ $pattern }}</option>
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
                                <option value="{{ $sleeve }}" @if (old('sleeve', $product->sleeve) === $sleeve) selected @endif>
                                    {{ $sleeve }}</option>
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
                                <option value="{{ $fit }}" @if (old('fit', $product->fit) === $fit) selected @endif>
                                    {{ $fit }}</option>
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
                                <option value="{{ $occassion }}" @if (old('occassion', $product->occassion) === $occassion) selected @endif>
                                    {{ $occassion }}</option>
                            @endforeach
                        </select>
                        @error('occassion')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="is_featured">Is Featured</label>
                        <div class="form-check">
                            <input type="checkbox" value="Yes" class="form-check-input" id="exampleCheck1"
                                name="is_featured" @if (old('is_featured', $product->is_featured == 'Yes' ? 'checked' : '')) checked @endif>
                        </div>
                        @error('is_featured')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
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
                        <label for="product_video">Product Video</label>
                        <input type="file" class="form-control" id="product_video" name="product_video"
                            placeholder="Enter product Video"
                            value="{{ old('product_video', $product->product_video) }}">
                        @error('product_video')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">

                        @if (!empty($product->images))
                            <div class="product_image_container">
                                @foreach ($product->images as $product_image)
                                    <div class="product_image">
                                        <div class="product_delete_button_link">
                                            <a href="javascript:void(0);" class="confirmDelete" data-toggle="tooltip"
                                                title="Delete Image" module="product-image"
                                                module_id={{ $product_image->id }}>
                                                <span class="close">&times;</span>
                                            </a>
                                        </div>
                                        <div class="product_image_box">
                                            <a href="{{ asset('storage/front/images/product/small/' . $product_image->image_name) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/front/images/product/small/' . $product_image->image_name) }}"
                                                    alt="" srcset="" height="100px" width="100px">
                                            </a>

                                        </div>
                                        <div>
                                            <input type="hidden" class="form-control image_card_input" id="image" name="images[]"
                                            value="{{ old('image',  $product_image->image_name) }}">

                                            <input type="number" class="form-control image_card_input" id="image_sort" name="image_sort[]"
                                                placeholder="Enter sort values"
                                                value="{{ old('image_sort', $product_image->image_sort) }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="img-wrap">
                                <img src="{{ asset('admin/img/no-image.png') }}" alt="" srcset=""
                                    height="130px" width="150px">
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        {{-- <label for="category_discount"></label> --}}

                        @if (!empty($product->product_video))
                            <div class="product_image">
                                <div class="product_delete_button_link">
                                    <a href="javascript:void(0);" class="confirmDelete" data-toggle="tooltip"
                                        title="Delete Video" module="product-video" module_id={{ $product->id }}>
                                        <span class="close">&times;</span>
                                    </a>
                                </div>
                                <div class="product_video_box">
                                    <a href="{{ asset('storage/front/videos/products/' . $product->product_video) }}"
                                        target="_blank">
                                        <video width="440" height="200" controls>
                                            <source
                                                src="{{ asset('storage/front/videos/products/' . $product->product_video) }}"
                                                type="video/mp4">
                                            {{-- <source src="mov_bbb.ogg" type="video/ogg"> --}}
                                            Your browser does not support HTML video.
                                        </video>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="img-wrap">
                                <img src="{{ asset('admin/img/no-image.png') }}" alt="" srcset=""
                                    height="130px" width="150px">
                            </div>
                        @endif
                    </div>
                </div>

                <hr>
                <div class="row mt-4">
                    <div class="form-group col-6">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            placeholder="Enter meta title" value="{{ old('meta_title', $product->meta_title) }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                            placeholder="Enter meta keyword" value="{{ old('meta_keyword', $product->meta_keyword) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter meta description">{{ old('meta_description', $product->meta_description) }}</textarea>
                    </div>
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
