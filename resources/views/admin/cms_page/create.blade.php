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
                    <div class="form-group col-6">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title"
                            value="{{ old('title') }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="ex:about-page"
                            value="{{ old('url') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Enter Description"
                            value="{{ old('description') }}"></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            placeholder="Enter Meta title" value="{{ old('meta_title') }}">
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-6">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                            placeholder="Enter Meta keyword" value="{{ old('meta_keyword') }}">
                    </div>
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
