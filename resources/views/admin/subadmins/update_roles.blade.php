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
                        @include('alert_messages')
                        <div class="card card-primary">

                            <div class="card-header">

                                <h3 class="card-title">Update Role</h3>
                                <a class="float-right" href="{{ route('admin.subadmins.index') }}">
                                    <button class="btn btn-primary">Back</button>
                                </a>
                            </div>
                            <form class="form-horizontal"
                                action="{{ route('admin.subadmins.update.roles', $subadmin->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="subadmin_id" value="{{ $subadmin->id }}">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Email" name="email"
                                                value="{{ old('email', $subadmin->email) }}" readonly disabled
                                                style="background: #858282">
                                        </div>
                                    </div>


                                    {{-- <div class="form-group row mt-3">
                                      <table class="table">
                                        <thead>
                                            <th>Permissions To</th>
                                            <th>View Access</th>
                                            <th>Full Access</th>
                                            <th>Edit Access</th>
                                        </thead>
                                        <tr>
                                            <td>Cms Page</td>
                                            <td>
                                                <input type="checkbox" name="" id="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" id="">
                                            </td>
                                            <td>
                                                <input type="checkbox" name="" id="">
                                            </td>
                                        </tr>
                                      </table>
                                    </div> --}}

                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Permissions</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Permissions</th>
                                                        <th>View Access</th>
                                                        <th>Edit Access</th>
                                                        <th>Full Access</th>
                                                        {{-- <th style="width: 40px">Label</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($get_admin_roles as $admin_role)
                                                        @if ($admin_role->module == 'cms_page')
                                                        @php
                                                            if ($admin_role->view_access == 1) {
                                                                $viewCmsPage = "checked";
                                                            }
                                                            else{
                                                                $viewCmsPage = "";
                                                            }
                                                            if ($admin_role->edit_access == 1) {
                                                                $editCmsPage = "checked";
                                                            }
                                                            else{
                                                                $editCmsPage = "";
                                                            }
                                                            if ($admin_role->full_access == 1) {
                                                                $fullCmsPage = "checked";
                                                            }
                                                            else{
                                                                $fullCmsPage = "";
                                                            }

                                                        @endphp

                                                        @endif

                                                    @endforeach

                                                    <tr class="text-center">
                                                        <td>1</td>
                                                        <td>CMS Page</td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox text-center">
                                                                <input class="custom-control-input" type="checkbox"
                                                                    id="customCheckbox1" value="1"
                                                                    name="cms_page[view]" @if (isset($viewCmsPage)) {{ $viewCmsPage }} @endif>
                                                                <label for="customCheckbox1"
                                                                    class="custom-control-label"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox text-center">
                                                                <input class="custom-control-input" type="checkbox"
                                                                    id="customCheckbox2" value="1"
                                                                    name="cms_page[edit]" @if (isset($editCmsPage)) {{ $editCmsPage }} @endif>
                                                                <label for="customCheckbox2"
                                                                    class="custom-control-label"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-checkbox text-center">
                                                                <input class="custom-control-input" type="checkbox"
                                                                    id="customCheckbox3" value="1"
                                                                    name="cms_page[full]" @if (isset($fullCmsPage)) {{ $fullCmsPage }} @endif>
                                                                <label for="customCheckbox3"
                                                                    class="custom-control-label"></label>
                                                            </div>
                                                        </td>
                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        {{-- <div class="card-footer clearfix">
                                          <ul class="pagination pagination-sm m-0 float-right">
                                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                          </ul>
                                        </div> --}}
                                    </div>


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
