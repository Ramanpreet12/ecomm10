@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cms Pages</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">cms-pages</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('alert_messages')
                        <div class="card">

                            @if ($pagesModule['edit_access']==1 ||  $pagesModule['full_access']==1)
                            <div class="card-header">
                                <a class="card-title float-right" href="{{ route('admin.cms-page.create') }}">
                                    <button class="btn btn-primary"> Add Cms Page</button>
                                </a>
                            </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="cms_page_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.no.</th>
                                            <th>Title</th>
                                            @if ($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                                            <th>Status</th>
                                            @endif
                                            <th>Created At </th>
                                            <th>Updated At </th>
                                            @if ($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                                            <th>Action</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cms_pages as $cms_page)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cms_page->title }}</td>
                                                 {{-- restrict this feature is subadmin has no permissions --}}
                                                 @if ($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                                                <td>

                                                    @if ($cms_page->status == 1)
                                                        <a href="javascript:void(0)" class="updateCmsPageStatus"
                                                            style="color:none; !important" id="page-{{ $cms_page->id }}"
                                                            page_id={{ $cms_page->id }} status="Active">
                                                            <i class="fa-solid fa-toggle-on status" data-toggle="tooltip"
                                                                title="Active" page_status="Active"></i>
                                                        </a>
                                                    @elseif($cms_page->status == 0)
                                                        <a href="javascript:void(0)" class="updateCmsPageStatus"
                                                            style="color: grey;  !important" id="page-{{ $cms_page->id }}"
                                                            page_id={{ $cms_page->id }} status="Inactive">
                                                            <i class="fa-solid fa-toggle-off status" data-toggle="tooltip"
                                                                title="Inactive" page_status="Inactive"></i>
                                                        </a>

                                                    @endif
                                                </td>
                                                @endif
                                                <td> {{ \Carbon\Carbon::parse($cms_page->created_at)->format('j F , Y') }}
                                                </td>
                                                <td> {{ \Carbon\Carbon::parse($cms_page->updated_at)->format('j F , Y') }}
                                                </td>
                                                @if ($pagesModule['edit_access']==1 ||  $pagesModule['full_access']==1)
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        @if ($pagesModule['edit_access']==1 ||  $pagesModule['full_access']==1 )
                                                        <a href="{{ route('admin.cms-page.edit', $cms_page->id) }}"
                                                            data-toggle="tooltip" title="Edit">
                                                            <button class="btn btn-primary"><i
                                                                    class="fa-solid fa-pen"></i></button>
                                                        </a>
                                                        @endif
                                                        @if ($pagesModule['full_access']==1)

                                                        <a
                                                         {{-- href="{{ url('admin/cms-page/delete/' . $cms_page->id) }}" --}}
                                                            data-toggle="tooltip" title="Delete">
                                                            <button class="btn btn-danger ml-2 confirmDelete"
                                                                data-toggle="tooltip" title="Delete" module="cms-page"
                                                                module_id={{ $cms_page->id }}><i
                                                                    class="fa-solid fa-trash-can"></i></button>
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                                @endif
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
