@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
@include('admin.includes.page_header' , ['page_name' => 'Sub Admins' , 'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'sub-admins' ])
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('alert_messages')
                        <div class="card">

                            <div class="card-header">
                                <a class="card-title float-right" href="{{ route('admin.subadmins.create') }}">
                                    <button class="btn btn-primary"> Add Subadmin</button>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="subadmin_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.no.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created At </th>
                                            <th>Updated At </th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subadmins as $subadmin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subadmin->name }}</td>
                                                <td>{{ $subadmin->email }}</td>
                                                <td>{{ucfirst( $subadmin->type) }}</td>
                                                <td>
                                                    @if ($subadmin->status == 1)
                                                        <a href="javascript:void(0)" class="updateSubadminStatus"
                                                            style="color:none; !important" id="subadmin-{{ $subadmin->id }}"
                                                            subadmin_id={{ $subadmin->id }}>
                                                            <i class="fa-solid fa-toggle-on status" data-toggle="tooltip"
                                                                title="Active" subadmin_status="Active"></i>
                                                        </a>
                                                    @elseif($subadmin->status == 0)
                                                        <a href="javascript:void(0)" class="updateSubadminStatus"
                                                            style="color: grey;  !important" id="subadmin-{{ $subadmin->id }}"
                                                            subadmin_id={{ $subadmin->id }}>
                                                            <i class="fa-solid fa-toggle-off status" data-toggle="tooltip"
                                                                title="Inactive" subadmin_status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td> {{ date_time_format($subadmin->created_at) }}
                                                </td>
                                                <td>{{ date_time_format($subadmin->updated_at) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('admin.subadmins.edit', $subadmin->id) }}"
                                                            data-toggle="tooltip" title="Edit">
                                                            <button class="btn btn-primary"><i
                                                                    class="fa-solid fa-pen"></i></button>
                                                        </a>
                                                        <a
                                                         {{-- href="{{ url('admin/cms-page/delete/' . $subadmin->id) }}" --}}
                                                            data-toggle="tooltip" title="Delete">
                                                            <button class="btn btn-danger ml-2 confirmDelete"
                                                                data-toggle="tooltip" title="Delete" module="subadmin"
                                                                module_id={{ $subadmin->id }}><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                        </a>


                                                        <a
                                                         href="{{ route('admin.subadmins.roles',$subadmin->id) }}"
                                                            data-toggle="tooltip" title="Roles">
                                                            <button class="btn btn-primary ml-2"
                                                                data-toggle="tooltip" title="Roles">
                                                                <i class="fa-solid fa-user-lock"></i>
                                                                </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            //   $("#subadmin_table").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#subadmin_table_wrapper .col-md-6:eq(0)');
            $('#subadmin_table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                // "autoWidth": true,
                // "responsive": true,
            });
        });
    </script>
@endpush
