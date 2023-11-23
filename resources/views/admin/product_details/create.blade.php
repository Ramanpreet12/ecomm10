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
        <div class="px-3">
            @include('alert_messages')
        </div>

        @include('admin.includes.page_main_content', [
            'card_title' => 'Add Product Details',
            'back_link' => route('admin.products.index'),
        ])

        <form action="{{ route('admin.add-products-details' , $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="Enter product name" value="{{ $product->product_name }}" disabled >
                    </div>
                    <div class="form-group col-6">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code"
                            placeholder="Enter product code" value="{{ $product->product_code }}" disabled>
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-6">


                    @if (!empty($product->images))
                        <div class="d-flex product_image_container">
                            @foreach ($product->images as $product_image)
                                <div class="product_image mr-3">
                                    <div class="product_image_box">
                                        <a href="{{ asset('storage/front/images/product/small/' . $product_image->image_name) }}"
                                            target="_blank">
                                            <img src="{{ asset('storage/front/images/product/small/' . $product_image->image_name) }}"
                                                alt="" srcset="" height="100px" width="100px">
                                        </a>
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
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_name">Product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color"
                            placeholder="Enter product color"
                            @if(!empty($product->product_color) ) value="{{ old('product_color' ,$product->product_color ) }}" @else
                              value="{{ old('product_color' )  }}" @endif >
                    </div>



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

                </div>


                <div class="row">
                    <div class="form-group col-6">
                        <label for="product_weight">Product Weight</label>
                        <input type="text" class="form-control" id="product_weight" name="product_weight"
                            placeholder="Enter product weight"
                            @if(!empty($product->product_weight) ) value="{{ old('product_weight' ,$product->product_weight ) }}" @else
                              value="{{ old('product_weight' )  }}" @endif >
                    </div>



                    {{-- <div class="form-group col-6">
                        <label for="product_weight">Product Weight</label>
                        <input type="text" class="form-control" id="product_weight" name="product_weight"
                            placeholder="Enter product weight"
                            @if(!empty($product->product_weight) ) value="{{ old('product_weight' ,$product->product_weight ) }}" @else
                              value="{{ old('product_weight' )  }}" @endif >
                    </div> --}}

                </div>
                {{-- <div class="row">
                    <x-forms.text-input label="Product Price" type="number" name="product_price"
                        placeholder="Enter product price" />
                    <x-forms.text-input label="Product Discount" type="number" name="product_discount"
                        placeholder="Enter product discount" />
                </div> --}}
                {{-- <div class="row">
                    <x-forms.textarea-component label="Product Description" name="product_description"
                        placeholder="Enter description" />
                </div> --}}



                <div class="row">

                    <div class="form-group col-6">
                        <label for="wash_care">Wash Care</label>
                        <input type="text" class="form-control" id="wash_care" name="wash_care"
                            placeholder="Enter wash care"
                            @if(!empty($product->wash_care) ) value="{{ old('wash_care' ,$product->wash_care ) }}" @else
                              value="{{ old('wash_care' )  }}" @endif >
                    </div>
                    <div class="form-group col-6">
                        <label for="search_keywords">Search Keyword</label>
                        <input type="text" class="form-control" id="search_keywords" name="search_keywords"
                            placeholder="Enter wash care"
                            @if(!empty($product->search_keywords) ) value="{{ old('search_keywords' ,$product->search_keywords ) }}" @else
                              value="{{ old('search_keywords' )  }}" @endif >
                    </div>
                </div>

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
                </div>

                <div class="row">
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

                    </div>

                    <div class="form-group col-6">
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

                <div class="row">
                    <div class="field_wrapper">
                        <div class="form-group col-12">
                            <label for="product_images">Product Attributes</label>
                            <div class="d-flex">
                                <input type="text" class="form-control mr-2" name="size[]" placeholder="Enter size"
                                    id="size" style="width: 120px" value="{{ old('size.0') }}"  />
                                <input type="text" class="form-control mr-2" name="sku[]" placeholder="Enter SKU"
                                    id="sku" style="width: 120px" value="{{ old('sku.0') }}" />
                                <input type="text" class="form-control mr-2" name="price[]" placeholder="Enter price"
                                    id="price" style="width: 120px" value="{{ old('price.0') }}" />
                                <input type="text" class="form-control mr-2" name="stock[]" placeholder="Enter stock"
                                    id="stock" style="width: 120px" value="{{ old('stock.0') }}" />
                                <a href="javascript:void(0);" class="add_button mt-2" title="Add field">
                                    <span class="text-primary"><i class="fa-solid fa-circle-plus"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- <div class="row mt-4">
                    <x-forms.text-input label="Meta title" type="text" name="meta_title"
                        placeholder="Enter meta title" />
                    <x-forms.text-input label="Meta Keyword" type="text" name="meta_keyword"
                        placeholder="Enter meta keyword" />
                </div>
                <div class="row">
                    <x-forms.textarea-component label="Meta Description" name="meta_description"
                        placeholder="Enter meta description" />
                </div> --}}
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
