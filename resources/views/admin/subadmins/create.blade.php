@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">subadmins</li>
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
          <div class="col-md-12 m-auto">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Subadmin</h3>
                <a class="float-right" href="{{ route('admin.subadmins.index') }}">
                    <button class="btn btn-primary">Back</button>
                </a>
              </div>
                <form class="form-horizontal" action="{{ route('admin.subadmins.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"></label>
                        {{-- <div class="col-sm-10"> --}}
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        {{-- </div> --}}
                    </div>



                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label"></label>
                    {{-- <div class="col-sm-10"> --}}
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    {{-- </div> --}}
                </div>

                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label"></label>
                    {{-- <div class="col-sm-10"> --}}
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    {{-- </div> --}}
                </div>


                  <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mobile" placeholder="Enter mobile"  name="mobile" value="{{ old('mobile') }}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label"></label>
                    {{-- <div class="col-sm-10"> --}}
                        @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                    {{-- </div> --}}
                </div>

                  <div class="form-group row">
                    <label for="type" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="type" placeholder="Enter type"  name="type" value="{{ old('type') }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label"></label>
                    {{-- <div class="col-sm-10"> --}}
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    {{-- </div> --}}
                </div>


                  <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="input-group col-sm-10">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
