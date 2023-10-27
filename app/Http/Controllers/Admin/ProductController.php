<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        // dd($products);
        return view('admin.products.index' , compact('products') );
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status=='Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id' , $request->product_id)->update(['status' => $status]);
            return response()->json(['status' => $status , 'product_id' => $request->product_id]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getCategories = Category::getCategories();
        $productFilters = Product::productFilters();

        return view('admin.products.create' , compact('getCategories' , 'productFilters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd($request);
        if ($request->is_featured ==  'Yes') {
            $is_featured = 'Yes';
        } else {
            $is_featured = 'No';
        }

        if (!empty($request->product_discount) && ($request->product_discount > 0) ) {
            $product_discount_type = 'product';

            // calculate discount
            $final_price = $request->product_price - ($request->product_price *  $request->product_discount)/100;

        }else{
            // check category discount
            $get_category_discount = Category::select('category_discount')->where('id' , $request->category_id)->first();

            if ( $get_category_discount->category_discount == 0) {
                $product_discount_type = '';
                $final_price = $request->product_price;
            }

        }

        // uploading video
        if ($request->hasFile('product_video')) {
            $product_video = $request->file('product_video');
           if ($product_video) {
            $video_name = $product_video->getClientOriginalName();
            $video_path = 'public/front/videos/products/';
            if (!is_dir(storage_path($video_path))) {
                mkdir(storage_path($video_path), 0775, true);
            }

            $product_video->storeAs($video_path.$video_name);
           }
        }
        else{
            $video_name ='';
        }

        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_code' => $request->product_code,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'discount_type' => $product_discount_type,
            'final_price' => $final_price,
            'product_description' => $request->product_description,
            'product_weight' => $request->product_weight,
            'product_color' => $request->product_color,
            'family_color' => $request->family_color,
            'group_code' => $request->group_code,
            'wash_care' => $request->wash_care,
            'search_keywords' => $request->search_keywords,
            'fabric' => $request->fabric,
            'pattern' => $request->pattern,
            'sleeve' => $request->sleeve,
            'fit' => $request->fit,
            'occassion' => $request->occassion,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'is_featured' => $is_featured,
            'product_video' => $video_name,
            'status' => 1,
        ]);
        return redirect()->route('admin.products.index')->with('success' , 'Product added successfully');

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
        $getCategories = Category::getCategories();
        $product = Product::find($id);
        $productFilters = Product::productFilters();

        return view('admin.products.edit' , compact('getCategories' , 'product', 'productFilters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data= [];
      // dd($request);
      if ($request->is_featured ==  'Yes') {
        $data['is_featured'] = 'Yes';
    } else {
        $data['is_featured']= 'No';
    }

    if (!empty($request->product_discount) && ($request->product_discount > 0) ) {
        $data['discount_type']  = 'product';

        // calculate discount
        $data['final_price']  = $request->product_price - ($request->product_price *  $request->product_discount)/100;

    }else{
        // check category discount
        $data['get_category_discount']   = Category::select('category_discount')->where('id' , $request->category_id)->first();

        if (  $data['get_category_discount']->category_discount == 0) {
            $data['discount_type']  = '';
            $data['final_price']  = $request->product_price;
        }

    }

    // uploading video
    if ($request->hasFile('product_video')) {
        $product_video = $request->file('product_video');
       if ($product_video) {
        $video_name = $product_video->getClientOriginalName();
        $video_path = 'public/front/videos/products/';
        if (!is_dir(storage_path($video_path))) {
            mkdir(storage_path($video_path), 0775, true);
        }

        $product_video->storeAs($video_path.$video_name);
        $data['product_video'] =$video_name;
       }
    }
    $data['product_name'] =  $request->product_name;
    $data['category_id'] =  $request->category_id;
    $data['brand_id'] =  $request->brand_id;
    $data['product_code'] =  $request->product_code;
    $data['product_price'] =  $request->product_price;
    $data['product_discount'] =  $request->product_discount;
    $data['discount_type'] =   $data['discount_type'] ;
    $data['final_price'] =  $data['final_price'] ;
    $data['product_description'] =  $request->product_description;
    $data['product_weight'] =  $request->product_weight;
    $data['product_color'] =  $request->product_color;
    $data['family_color'] = $request->family_color;
    $data['group_code'] =  $request->group_code;
    $data['wash_care'] =  $request->wash_care;
    $data['search_keywords'] =  $request->search_keywords;
    $data['fabric'] =  $request->fabric;
    $data['pattern'] =  $request->pattern;
    $data['sleeve'] =  $request->sleeve;
    $data['fit'] =  $request->fit;
    $data['occassion'] =  $request->occassion;
    $data['meta_title'] =  $request->meta_title;
    $data['meta_keyword'] =  $request->meta_keyword;
    $data['meta_description'] =  $request->meta_description;
    $data['is_featured'] =  $data['is_featured'];
    $data['status'] =1;


    Product::whereId($id)->update($data);
    return redirect()->route('admin.products.index')->with('success' , 'Product updated successfully');

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
        Product::whereId($id)->delete();
         return redirect()->route('admin.products.index')->with('success' , 'Product deleted successfully');
    }


    // deleting video from db and folder
    public function deleteVideo($id){

        // get video path
        $video_path = storage_path("app/public/front/videos/products/");

        //get video from table
        $get_video =  Product::whereId($id)->select('product_video')->first();
        $video =  $video_path.$get_video->product_video ;
        if (file_exists( $video )) {
            unlink( $video);
        }

        // delete from db
        Product::whereId($id)->update(['product_video'=> '']);
        return redirect()->back()->with('success' , 'Product video deleted successfully');
    }


}
