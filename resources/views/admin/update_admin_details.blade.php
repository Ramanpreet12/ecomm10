@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        @include('admin.includes.page_header' , ['page_name' => 'Admin Details' , 'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'Admin Details' ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    @if (!empty(Auth::guard('admin')->user()->image))
                                    <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('storage/images/admin_image/' . Auth::guard('admin')->user()->image) }}"
                                    alt="User profile picture">
                                    @else
                                    <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('admin/img/dummy_image.webp') }}" alt="User profile picture">
                                    @endif





                                </div>

                                <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>

                                <p class="text-muted text-center">{{ Auth::guard('admin')->user()->type }}</p>


                                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-info">
                            @include('alert_messages')
                            <div class="card-header p-3">
                                <h3 class="card-title">Admin Details</h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                {{-- <div class="tab-content"> --}}
                                {{-- <div class="tab-pane" id="settings"> --}}
                                <form id="adminDetailsForm" class="form-horizontal" action="{{ route('admin.admin-details') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail"
                                                value="{{ Auth::guard('admin')->user()->email }}" placeholder="Email"
                                                readonly style="background:#ccc">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="name"
                                                value="{{ Auth::guard('admin')->user()->name }}" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2" name="mobile"
                                                value="{{ Auth::guard('admin')->user()->mobile }}" placeholder="Mobile">

                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="inputName2" name="image">

                                        </div>
                                    </div> --}}

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


                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                {{-- </div> --}}

                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
