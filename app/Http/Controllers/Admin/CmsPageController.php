<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use App\Http\Requests\CmsPageRequest;
use Auth;
use App\Models\AdminRole;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cms_pages = CmsPage::latest('id')->get();

        //set admins / subadmins permissions
        $cmsPageModuleCount = AdminRole::where(['subadmin_id' => Auth::guard('admin')->user()->id , 'module' => 'cms_page'])->count();
        // dd($cmsPageModuleCount);

        $pagesModule = [];
        // if logged in user is superadmin , then he can access all the pages
        if (Auth::guard('admin')->user()->type == 'admin') {
           $pagesModule['view_access'] = 1;
           $pagesModule['edit_access'] = 1;
           $pagesModule['full_access'] = 1;
        } elseif($cmsPageModuleCount == 0) {
           return redirect()->route('admin.dashboard')->with('error' , "This feature is restricted to you.");
        }
        else{
            $pagesModule = AdminRole::where(['subadmin_id' => Auth::guard('admin')->user()->id , 'module' => 'cms_page'])->first();
        }

       return view('admin.cms_page.index')->with(compact('cms_pages' , 'pagesModule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cms_page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CmsPageRequest $request)
    {
        CmsPage::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' =>1,
        ]);
        return redirect()->route('admin.cms-page.index')->with('success' , 'Cms Page created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cms_page = CmsPage::find($id);
        return view('admin.cms_page.edit')->with(compact('cms_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CmsPageRequest $request, string $id)
    {
        CmsPage::whereId($id)->update([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
        ]);

    return redirect()->route('admin.cms-page.index')->with('success' , 'Cms Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    //     dd($id);
    //    CmsPage::whereId($id)->delete();
    //    return redirect()->route('admin.cms-page.index')->with('success' , 'Cms Page deleted successfully');

    }

    public function delete($id)
    {
        CmsPage::whereId($id)->delete();
         return redirect()->route('admin.cms-page.index')->with('success' , 'Cms Page deleted successfully');
    }

    public function updateCmsPageStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status=='Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id' , $request->page_id)->update(['status' => $status]);
            return response()->json(['status' => $status , 'page_id' => $request->page_id]);


        }
    }


}
