{{-- <div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div> --}}


{{-- <tr>
    <td>fdf</td>
    <td>{{ $cms['title'] }}</td>
<td>{{ $cms['title'] }}</td>
<td>{{ $cms_page['url'] }}</td>
<td>{{ $cms_page['description'] }}</td>
<td>{{ $cms_page['meta_title'] }}</td>
<td>{{ $cms_page['meta_keyword'] }}</td>

</tr> --}}


{{-- <tr>
    <td>{{ $loop->iteration }}</td>
    <td>1</td>
    <td>{{ $cms['title'] }}</td>
     @if ($pagesmodule['edit_access']==1 || $pagesmodule['full_access']==1)
    <td>

        @if ($cms['status'] == 1)
            <a href="javascript:void(0)" class="updateCmsPageStatus"
                style="color:none; !important" id="page-{{ $cms['id'] }}"
                page_id={{ $cms['id'] }} status="Active">
                <i class="fa-solid fa-toggle-on status" data-toggle="tooltip"
                    title="Active" page_status="Active"></i>
            </a>
        @elseif($cms['status'] == 0)
            <a href="javascript:void(0)" class="updateCmsPageStatus"
                style="color: grey;  !important" id="page-{{ $cms['id'] }}"
                page_id={{ $cms['id'] }} status="Inactive">
                <i class="fa-solid fa-toggle-off status" data-toggle="tooltip"
                    title="Inactive" page_status="Inactive"></i>
            </a>

        @endif
    </td>
    @endif
    <td> {{ \Carbon\Carbon::parse($cms['created_at'])->format('j F , Y') }}
    </td>
    <td> {{ \Carbon\Carbon::parse($cms['updated_at'])->format('j F , Y') }}
    </td>
    @if ($pagesmodule['edit_access']==1 ||  $pagesmodule['full_access']==1)
    <td>
        <div class="d-flex justify-content-center align-items-center">
            @if ($pagesmodule['edit_access']==1 ||  $pagesmodule['full_access']==1 )
            <a href="{{ route('admin.cms-page.edit', $cms['id']) }}"
                data-toggle="tooltip" title="Edit">
                <button class="btn btn-primary"><i
                        class="fa-solid fa-pen"></i></button>
            </a>
            @endif
            @if ($pagesmodule['full_access']==1)

            <a
                data-toggle="tooltip" title="Delete">
                <button class="btn btn-danger ml-2 confirmDelete"
                    data-toggle="tooltip" title="Delete" module="cms-page"
                    module_id={{ $cms['id'] }}><i
                        class="fa-solid fa-trash-can"></i></button>
            </a>
            @endif
        </div>
    </td>
    @endif
</tr> --}}


<tr>
    {{-- <td>{{ $loop->iteration }}</td> --}}
    <td>1</td>
    <td>{{ $cms['title'] }}</td>
     @if ($pagesmodule['edit_access']==1 || $pagesmodule['full_access']==1)
    <td>

        @if ($cms['status'] == 1)
            <a href="javascript:void(0)" class="updateCmsPageStatus"
                style="color:none; !important" id="page-{{ $cms['id'] }}"
                page_id={{ $cms['id'] }} status="Active">
                <i class="fa-solid fa-toggle-on status" data-toggle="tooltip"
                    title="Active" page_status="Active"></i>
            </a>
        @elseif($cms['status'] == 0)
            <a href="javascript:void(0)" class="updateCmsPageStatus"
                style="color: grey;  !important" id="page-{{ $cms['id'] }}"
                page_id={{ $cms['id'] }} status="Inactive">
                <i class="fa-solid fa-toggle-off status" data-toggle="tooltip"
                    title="Inactive" page_status="Inactive"></i>
            </a>

        @endif
    </td>
    @endif
    <td> {{ \Carbon\Carbon::parse($cms['created_at'])->format('j F , Y') }}
    </td>
    <td> {{ \Carbon\Carbon::parse($cms['updated_at'])->format('j F , Y') }}
    </td>
    @if ($pagesmodule['edit_access']==1 ||  $pagesmodule['full_access']==1)
    <td>
        <div class="d-flex justify-content-center align-items-center">
            @if ($pagesmodule['edit_access']==1 ||  $pagesmodule['full_access']==1 )
            <a href="{{ route('admin.cms-page.edit', $cms['id']) }}"
                data-toggle="tooltip" title="Edit">
                <button class="btn btn-primary"><i
                        class="fa-solid fa-pen"></i></button>
            </a>
            @endif
            @if ($pagesmodule['full_access']==1)

            <a
                data-toggle="tooltip" title="Delete">
                <button class="btn btn-danger ml-2 confirmDelete"
                    data-toggle="tooltip" title="Delete" module="cms-page"
                    module_id={{ $cms['id'] }}><i
                        class="fa-solid fa-trash-can"></i></button>
            </a>
            @endif
        </div>
    </td>
    @endif
</tr>
