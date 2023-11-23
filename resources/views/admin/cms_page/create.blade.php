@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.includes.page_header', [
            'page_name' => 'Cms Pages',
            'breadcrumb_link' => route('admin.dashboard'),
            'breadcrumb_item' => 'cms-pages',
        ])

        @include('admin.includes.page_main_content', [
            'card_title' => 'Add Cms Page',
            'back_link' => route('admin.cms-page.index'),
        ])

        <form action="{{ route('admin.cms-page.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <x-forms.text-input label="Title" type="text" name="title" placeholder="Enter title" />
                    <x-forms.text-input label="Url" type="text" name="url" placeholder="Enter url" />
                </div>

                <div class="row">
                    <x-forms.textarea-component label="Description" name="description" placeholder="Enter description" />
                    <x-forms.text-input label="Meta title" type="text" name="meta_title"
                        placeholder="Enter meta title" />
                </div>
                <div class="row">
                    <x-forms.textarea-component label="Meta Description" name="meta_description"
                        placeholder="Enter meta description" />
                    <x-forms.text-input label="Meta Keyword" type="text" name="meta_keyword"
                        placeholder="Enter meta keyword" />
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
