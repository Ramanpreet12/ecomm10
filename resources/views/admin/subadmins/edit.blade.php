@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        @include('admin.includes.page_header' , ['page_name' => 'Sub Admins' , 'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'sub-admins' ])
        @include('admin.includes.page_main_content', [
            'card_title' => 'Edit Subadmin',
            'back_link' => route('admin.subadmins.index'),
        ])
                            <form class="form-horizontal" action="{{ route('admin.subadmins.update', $subadmin->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Email" name="email"
                                                value="{{ old('email', $subadmin->email) }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter name" name="name"
                                                value="{{ old('name', $subadmin->name) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label"></label>
                                        {{-- <div class="col-sm-10"> --}}
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- </div> --}}
                                    </div>



                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label"></label>
                                        {{-- <div class="col-sm-10"> --}}
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- </div> --}}
                                    </div>

                                    {{-- <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="password" placeholder="Enter Password" name="password" value="{{ old('password', $subadmin->password) }}">
                    </div>
                  </div> --}}

                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="mobile"
                                                placeholder="Enter mobile" name="mobile"
                                                value="{{ old('mobile', $subadmin->mobile) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-2 col-form-label"></label>
                                        {{-- <div class="col-sm-10"> --}}
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- </div> --}}
                                    </div>


                                    <div class="form-group row">
                                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="type"
                                                placeholder="Enter type" name="type"
                                                value="{{ old('type', $subadmin->type) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="type" class="col-sm-2 col-form-label"></label>
                                        {{-- <div class="col-sm-10"> --}}
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- </div> --}}
                                    </div>


                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                                        <div class="input-group col-sm-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image"
                                                    name="image">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>

                                        </div>

                                    </div>



                                    @if (!empty($subadmin->image))
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label"></label>
                                        <div class="input-group col-sm-10">
                                            {{-- <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div> --}}
                                            {{-- <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> --}}
                                            <img src="{{ asset('storage/images/admin_image/' . $subadmin->image) }}"
                                                alt="" srcset="" height="200px" width="200px">
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label"></label>
                                        <div class="input-group col-sm-10">
                                            <img src="{{ asset('admin/img/dummy_image.webp') }}"
                                                al  t="" srcset="" height="140px" width="150px">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
