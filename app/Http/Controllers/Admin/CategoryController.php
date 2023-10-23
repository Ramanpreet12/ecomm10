<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use App\Http\Requests\CategoryRequest;
use App\Models\AdminRole;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::with('parentCategory')->get();

          //set admins / subadmins permissions
          $cmsPageModuleCount = AdminRole::where(['subadmin_id' => Auth::guard('admin')->user()->id , 'module' => 'categories'])->count();
          // dd($cmsPageModuleCount);

          $categoriesModule = [];
          // if logged in user is superadmin , then he can access all the categories
          if (Auth::guard('admin')->user()->type == 'admin') {
             $categoriesModule['view_access'] = 1;
             $categoriesModule['edit_access'] = 1;
             $categoriesModule['full_access'] = 1;
          } elseif($cmsPageModuleCount == 0) {
             return redirect()->route('admin.dashboard')->with('error' , "This feature is restricted to you.");
          }
          else{
              $categoriesModule = AdminRole::where(['subadmin_id' => Auth::guard('admin')->user()->id , 'module' => 'categories'])->first();
          }

        return view('admin.categories.index')->with(compact('categories' , 'categoriesModule'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status=='Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id' , $request->category_id)->update(['status' => $status]);
            return response()->json(['status' => $status , 'category_id' => $request->category_id]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getCategories = Category::getCategories();
        // dd($getCategories);
        return view('admin.categories.create' , compact('getCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $data = [];
        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $image_name = $image->getClientOriginalName();
            if (!is_dir(storage_path("app/public/front/images/category"))) {
                mkdir(storage_path("app/public/front/images/category"), 0775, true);
            }
            Image::make($image)->save(storage_path("app/public/front/images/category/".$image_name));
            $data['category_image']= $image_name;
        }


        $data['category_name'] = $request->category_name;
        $data['parent_id'] = $request->parent_id;
        $data['url'] = $request->url;
        $data['description'] = $request->description;
        if(isset($request->category_discount)){
            $data['category_discount'] = $request->category_discount;
        }
        else{
            $data['category_discount']=0;
        }
        $data['meta_title'] = $request->meta_title;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['meta_description'] = $request->meta_description;
        $data['status'] =1;

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success' , 'Category created successfully');
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
        $category = Category::find($id);
        $getCategories = Category::getCategories();
        return view('admin.categories.edit')->with(compact('category' , 'getCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = [];
        if($request->hasFile('category_image')){
            $image = $request->file('category_image');
            $image_name = $image->getClientOriginalName();
            if (!is_dir(storage_path("app/public/front/images/category"))) {
                mkdir(storage_path("app/public/front/images/category"), 0775, true);
            }
            Image::make($image)->save(storage_path("app/public/front/images/category/".$image_name));
            $data['category_image']= $image_name;
        }

        $data['category_name'] = $request->category_name;
        $data['parent_id'] = $request->parent_id;
        $data['url'] = $request->url;
        $data['description'] = $request->description;
        if(isset($request->category_discount)){
            $data['category_discount'] = $request->category_discount;
        }
        else{
            $data['category_discount']=0;
        }
        $data['meta_title'] = $request->meta_title;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['meta_description'] = $request->meta_description;
        $data['status'] =1;

        Category::whereId($id)->update($data);
        return redirect()->route('admin.categories.index')->with('success' , 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete($id)
    {
        Category::whereId($id)->delete();
         return redirect()->route('admin.categories.index')->with('success' , 'Category deleted successfully');
    }

    // deleting image from db and folder
    public function deleteImage($id){
        // get image path
        $image_path = storage_path("app/public/front/images/category/");

        //get image from table
        $get_image =  Category::whereId($id)->select('category_image')->first();
        $image =  $image_path.$get_image->category_image ;

        if (file_exists( $image )) {
            unlink( $image);
        }

        // delete from db
        Category::whereId($id)->update(['category_image'=> '']);
        return redirect()->back()->with('success' , 'Category Image deleted successfully');
    }

}
