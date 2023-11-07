@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        @include('admin.includes.page_header' , ['page_name' => 'Family Colors' ,
        'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'family-colors' ])
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('alert_messages')
                        <div class="card">

                            {{-- @if ($pagesModule['edit_access']==1 ||  $pagesModule['full_access']==1) --}}
                            <div class="card-header">
                                <a class="card-title float-right" href="{{ route('admin.family-colors.create') }}">
                                    <button class="btn btn-primary"> Add Family Color</button>
                                </a>
                            </div>
                            {{-- @endif --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="cms_page_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.no.</th>
                                            <th>Color Name</th>
                                            <th>Color Code</th>
                                            {{-- @if ($pagesModule['edit_access']==1 || $pagesModule['full_access']==1) --}}
                                            <th>Status</th>
                                            {{-- @endif --}}
                                            <th>Created At </th>
                                            <th>Updated At </th>
                                            {{-- @if ($pagesModule['edit_access']==1 || $pagesModule['full_access']==1) --}}
                                            <th>Action</th>
                                            {{-- @endif --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($family_colors as $family_color)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $family_color->color_name }}</td>
                                                <td>{{ $family_color->color_code }}</td>
                                                 {{-- restrict this feature is subadmin has no permissions --}}
                                                 {{-- @if ($pagesModule['edit_access']==1 || $pagesModule['full_access']==1) --}}
                                                <td>

                                                    @if ($family_color->status == 1)
                                                        <a href="javascript:void(0)" class="updateFamilyColorStatus"
                                                            style="color:none; !important" id="family_colors-{{ $family_color->id }}"
                                                            family_colors_id={{ $family_color->id }} status="Active">
                                                            <i class="fa-solid fa-toggle-on status" data-toggle="tooltip"
                                                                title="Active" family_colors_status="Active"></i>
                                                        </a>
                                                    @elseif($family_color->status == 0)
                                                        <a href="javascript:void(0)" class="updateFamilyColorStatus"
                                                            style="color: grey;  !important" id="family_colors-{{ $family_color->id }}"
                                                            family_colors_id={{ $family_color->id }} status="Inactive">
                                                            <i class="fa-solid fa-toggle-off status" data-toggle="tooltip"
                                                                title="Inactive" family_colors_status="Inactive"></i>
                                                        </a>

                                                    @endif
                                                </td>
                                                {{-- @endif --}}
                                                <td> {{ date_time_format($family_color->created_at) }}
                                                </td>
                                                <td>  {{ date_time_format($family_color->updated_at) }}
                                                </td>
                                                {{-- @if ($pagesModule['edit_access']==1 ||  $pagesModule['full_access']==1) --}}
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        {{-- @if ($pagesModule['edit_access']==1 ||  $pagesModule['full_access']==1 ) --}}
                                                        <a href="{{ route('admin.family-colors.edit', $family_color->id) }}"
                                                            data-toggle="tooltip" title="Edit">
                                                            <button class="btn btn-primary"><i
                                                                    class="fa-solid fa-pen"></i></button>
                                                        </a>
                                                        {{-- @endif --}}
                                                        {{-- @if ($pagesModule['full_access']==1) --}}

                                                        <a
                                                         {{-- href="{{ url('admin/family-colors/delete/' . $family_color->id) }}" --}}
                                                            data-toggle="tooltip" title="Delete">
                                                            <button class="btn btn-danger ml-2 confirmDelete"
                                                                data-toggle="tooltip" title="Delete" module="family-colors"
                                                                module_id={{ $family_color->id }}><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                        </a>
                                                        {{-- @endif --}}
                                                    </div>
                                                </td>
                                                {{-- @endif --}}
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
            //   $("#cms_page_table").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#cms_page_table_wrapper .col-md-6:eq(0)');
            $('#cms_page_table').DataTable({
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
