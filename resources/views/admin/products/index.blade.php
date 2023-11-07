@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        @include('admin.includes.page_header' , ['page_name' => 'Products' ,
        'breadcrumb_link' =>  route('admin.dashboard')  , 'breadcrumb_item' =>'products' ])

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('alert_messages')
                        <div class="card">
                            <div class="card-header">
                                {{-- @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1) --}}
                                    <a class="card-title float-right" href="{{ route('admin.products.create') }}">
                                        <button class="btn btn-primary"> Add Product</button>
                                    </a>
                                {{-- @endif --}}
                            </div>
                            <div class="card-body">
                                <table id="products_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.no.</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Parent Category</th>

                                            {{-- @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1) --}}
                                                <th>Status</th>
                                            {{-- @endif --}}
                                            <th>Created At </th>
                                            <th>Updated At </th>
                                            {{-- @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1) --}}
                                                <th>Action</th>
                                            {{-- @endif --}}

                                        </tr>
                                    </thead>
                                    {{-- {{ Dd($products) }} --}}
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->category->category_name }}
                                                    {{-- @if (isset($product->category->category_name ))
                                                    {{ $product->category->category_name }}
                                                @endif --}}
                                            </td>

                                                <td>
                                                    @if (isset($product->category->parentCategory->category_name ))
                                                        {{ $product->category->parentCategory->category_name }}
                                                    @endif
                                                </td>

                                                {{-- restrict this feature is subadmin has no permissions --}}
                                                {{-- @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1) --}}
                                                    <td>
                                                        @if ($product->status == 1)
                                                            <a href="javascript:void(0)" class="updateProductStatus"
                                                                style="color:none; !important"
                                                                id="product-{{ $product->id }}"
                                                                product_id={{ $product->id }} status="Active">
                                                                <i class="fa-solid fa-toggle-on status"
                                                                    data-toggle="tooltip" title="Active"
                                                                    product_status="Active"></i>
                                                            </a>
                                                        @elseif($product->status == 0)
                                                            <a href="javascript:void(0)" class="updateProductStatus"
                                                                style="color: grey;  !important"
                                                                id="product-{{ $product->id }}"
                                                                product_id={{ $product->id }} status="Inactive">
                                                                <i class="fa-solid fa-toggle-off status"
                                                                    data-toggle="tooltip" title="Inactive"
                                                                    product_status="Inactive"></i>
                                                            </a>

                                                        @endif

                                                </td>
                                        {{-- @endif --}}
                                        <td>{{ date_time_format($product->created_at) }}
                                        </td>
                                        <td> {{ date_time_format($product->updated_at) }}
                                        </td>
                                        {{-- @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1) --}}
                                            <td>

                                                <div class="d-flex justify-content-center align-items-center">
                                                    {{-- @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1) --}}
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            data-toggle="tooltip" title="Edit">
                                                            <button class="btn btn-primary"><i
                                                                    class="fa-solid fa-pen"></i></button>
                                                        </a>
                                                    {{-- @endif --}}
                                                    {{-- @if ($categoriesModule['full_access'] == 1) --}}
                                                        <a data-toggle="tooltip" title="Delete">
                                                            <button class="btn btn-danger ml-2 confirmDelete"
                                                                data-toggle="tooltip" title="Delete" module="product"
                                                                module_id={{ $product->id }}><i
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
            //   $("#products_table").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#products_table_wrapper .col-md-6:eq(0)');
            $('#products_table').DataTable({
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
