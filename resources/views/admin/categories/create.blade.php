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
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <x-forms.text-input label="Category Name" type="text" name="category_name" placeholder="Enter category name" />
                    <div class="form-group col-6">
                        <label for="category_name">Select Category Level</label>
                        <select class="form-control" name="parent_id" style="width: 100%;">
                            <option value="0"><b>Main Category</b></option>
                            <br> <br>
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
                    @error('parent_id')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                </div>
                <div class="row">
                    <x-forms.text-input label="Url" type="text" name="url" placeholder="Enter url ex:about-page" />
                    <x-forms.text-input label="Category Discount" type="number" name="category_discount" placeholder="Enter category discount" />
                </div>
                <div class="row">
                    <x-forms.file-component label="Category Image" name="category_image" />
                    <x-forms.textarea-component label="Description" name="description" placeholder="Enter description" />
                </div>
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
