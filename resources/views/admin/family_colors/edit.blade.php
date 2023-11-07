@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Family Colors</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">family color</li>
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
                                <h3 class="card-title">Edit Family Color</h3>
                                <a class="float-right" href="{{ route('admin.family-colors.index') }}">
                                    <button class="btn btn-primary">Back</button>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.family-colors.update', $family_color->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="color_name">Color Name</label>
                                            <input type="text" class="form-control" id="color_name" name="color_name"
                                                placeholder="Enter color name" value="{{ old('color_name' , $family_color->color_name) }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="color_code">Color Code</label>
                                            <input type="text" class="form-control" id="color_code" name="color_code"
                                                placeholder="#000000" value="{{ old('color_code', $family_color->color_code) }}">
                                        </div>
                                    </div>

                                    {{-- <div class="row">
                                        <div class="form-group col-6">
                                            <label for="status">Status</label>
                                            <input type="hidden" class="form-control" id="status" name="status"
                                                placeholder="Enter color name" value="{{ $family_color->status }}">
                                        </div>
                                    </div> --}}


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
