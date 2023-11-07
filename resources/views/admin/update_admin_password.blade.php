@extends('admin.layout.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->
    @include('admin.includes.page_header' , ['page_name' => 'Admin Setting' , 'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'Admin Password' ])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-9 m-auto">
              <!-- /.card -->
              <!-- Horizontal Form -->
              <div class="card card-info">
                @include('alert_messages')
                <div class="card-header">
                  <h3 class="card-title">Reset Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.password') }}" method="POST">
                  @csrf
                  <div class="card-body">
                    <div class ="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email"
                         value="{{ Auth::guard('admin')->user()->email }}" style="background:#ccc">
                      </div>
                    </div>
                    <div class ="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Current Password</label>
                      <div class="col-sm-8">
                        <input type="password" name="current_pwd" class="form-control" id="current_pwd" placeholder="Enter current password">
                        <span id="verifyCurrentPassword"></span>
                      </div>
                    </div>

                    <div class ="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">New Password</label>
                      <div class="col-sm-8">
                        <input type="password" name="new_password" class="form-control" id="inputEmail3" placeholder="Enter new password">
                      </div>
                    </div>

                    <div class ="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Confirm Password</label>
                      <div class="col-sm-8">
                        <input type="password" name="password_confirmation" class="form-control" id="inputEmail3" placeholder="Re-enter password">
                      </div>
                    </div>

                    {{-- <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck2">
                          <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-info">Update</button>
                    <button type="reset" class="btn btn-default ml-2">Cancel</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->

            </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
@endsection
