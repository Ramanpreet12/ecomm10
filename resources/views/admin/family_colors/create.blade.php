@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.includes.page_header' , ['page_name' => 'Family Colors' ,
        'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'family-colors' ])
                            @include('admin.includes.page_main_content', [
                                'card_title' => 'Add Family Color',
                                'back_link' => route('admin.family-colors.index'),
                            ])


                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.family-colors.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="color_name">Color Name</label>
                                            <input type="text" class="form-control" id="color_name" name="color_name"
                                                placeholder="Enter color name" value="{{ old('color_name') }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="color_code">Color Code</label>
                                            <input type="text" class="form-control" id="color_code" name="color_code"
                                                placeholder="#000000" value="{{ old('color_code') }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            {{-- <label for="status">Status</label> --}}
                                            <input type="hidden" class="form-control" id="status" name="status"
                                                placeholder="Enter color name" value="1">
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
