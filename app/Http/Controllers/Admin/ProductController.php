<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\FamilyColor;
use App\Http\Requests\ProductRequest;
use Image;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $product_small_images_path ='app/public/front/images/product/small/';
     public $product_medium_images_path ='app/public/front/images/product/medium/';
     public $product_large_images_path ='app/public/front/images/product/large/';

     public $product_video_path = 'public/front/videos/products/';

    public function index()
    {
        $products = Product::with('category')->get();
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
    public function create()
    {
        $getCategories = Category::getCategories();
        $productFilters = Product::productFilters();
        $family_colors = FamilyColor::get();
        return view('admin.products.create' , compact('getCategories' , 'productFilters' , 'family_colors'));
    }

    public function store(ProductRequest $request)
    {
        $calculate_actual_price =Product::calculate_actual_price($request->product_discount ,$request->product_price , $request->category_id);
        // uploading video
        if ($request->hasFile('product_video')) {
            $product_video = $request->file('product_video');
           if ($product_video) {
            $video_name = 'product-'.rand(1111, 9999).'-'.$product_video->getClientOriginalName();
            //  $video_path = 'public/front/videos/products/';
            $product_video->storeAs($this->product_video_path.$video_name);
            // $product_video->storeAs($this->product_video_path.$video_name);
           }
        }
        else{
            $video_name ='';
        }

       $product =  Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_code' => $request->product_code,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'discount_type' =>$calculate_actual_price['product_discount_type'],
            'final_price' => $calculate_actual_price['final_price'],
            'product_description' => $request->product_description,
            'product_video' => $video_name,
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
            'is_featured' => $request->is_featured ==  'Yes' ? 'Yes' :  'No' ,
            // 'status' => Product::STATUS,
            'status' => config('app.status'),
        ]);

        if ($request->hasFile('product_images')) {
            $product_images = $request->file('product_images');

            foreach ($product_images as $key => $product_image) {
            //   $img_tmp = Image::make($product_image);
              $image_name = 'product-'.rand(1111, 9999).'-'.$product_image->getClientOriginalName();

            make_storage_dir($this->product_small_images_path);
            make_storage_dir($this->product_medium_images_path);
            make_storage_dir($this->product_large_images_path);

            //   Image paths for small , Medium and large images
            $smallSizeImages = storage_path($this->product_small_images_path.$image_name);
            $mediumSizeImages = storage_path($this->product_medium_images_path.$image_name);
            $largeSizeImages = storage_path($this->product_large_images_path.$image_name);

            // upload all sized images
            Image::make($product_image)->resize(260 , 300)->save($smallSizeImages);
            Image::make($product_image)->resize(520 , 600)->save($mediumSizeImages);
            Image::make($product_image)->resize(1040 , 1200)->save($largeSizeImages);

                // Insert images in product images table
              $create_product_image=  ProductImage::create([
                    'product_id' => $product->id,
                    'image_name' => $image_name,
                    'status' => config('app.status')
                ]);
            }
        }
        if ($create_product_image->id > 0  ) {
            return redirect()->route('admin.products.index')->with('success' , 'Product added successfully');
        } else {
            return redirect()->back()->with('error' , 'Something went wrong !');
        }
    }

    public function edit(string $id)
    {
        $getCategories = Category::getCategories();
        $product = Product::with('images')->find($id);
        $productFilters = Product::productFilters();
        $family_colors = FamilyColor::get();

        return view('admin.products.edit' , compact('getCategories' , 'product', 'productFilters' , 'family_colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(ProductRequest $request, string $id)
    public function update(Request $request, string $id)
    {
        // dd($request);
        $data= [];
        $calculate_actual_price =Product::calculate_actual_price($request->product_discount ,$request->product_price , $request->category_id);

      // dd($request);
    //   if ($request->is_featured ==  'Yes') {
    //     $data['is_featured'] = 'Yes';
    // } else {
    //     $data['is_featured']= 'No';
    // }

    // if (!empty($request->product_discount) && ($request->product_discount > 0) ) {
    //     $data['discount_type']  = 'product';

    //     // calculate discount
    //     $data['final_price']  = $request->product_price - ($request->product_price *  $request->product_discount)/100;

    // }else{
    //     // check category discount
    //     $data['get_category_discount']   = Category::select('category_discount')->where('id' , $request->category_id)->first();

    //     if (  $data['get_category_discount']->category_discount == 0) {
    //         $data['discount_type']  = '';
    //         $data['final_price']  = $request->product_price;
    //     }

    // }

    // uploading video


    if ($request->hasFile('product_video')) {
        $product_video = $request->file('product_video');
       if ($product_video) {
        $video_name = 'product-'.rand(1111, 9999).'-'.$product_video->getClientOriginalName();
        $product_video->storeAs($this->product_video_path.$video_name);
        $data['product_video'] =$video_name;
       }
    }

    $data['product_name'] =  $request->product_name;
    $data['category_id'] =  $request->category_id;
    $data['brand_id'] =  $request->brand_id;
    $data['product_code'] =  $request->product_code;
    $data['product_price'] =  $request->product_price;
    $data['product_discount'] =  $request->product_discount;
    $data['discount_type'] =    $calculate_actual_price['product_discount_type'];
    $data['final_price'] = $calculate_actual_price['final_price'];
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
    $data['is_featured'] =  $request->is_featured ==  'Yes' ? 'Yes' :  'No' ;
    // $data['status'] =$request->status;


    Product::whereId($id)->update($data);

    if ($request->hasFile('product_images')) {
        $product_images = $request->file('product_images');

        foreach ($product_images as $key => $product_image) {
        //   $img_tmp = Image::make($product_image);
          $image_name = 'product-'.rand(1111, 9999).'-'.$product_image->getClientOriginalName();
          $storage_path = 'app/public/front/images/product/';
        //   make_storage_dir($storage_path.'large/');
        //   make_storage_dir($storage_path.'medium/');
        //   make_storage_dir($storage_path.'small/');

        // //   Image paths for small , Medium and large images
        // $largeSizeImages = storage_path($storage_path.'large/'.$image_name);
        // $mediumSizeImages = storage_path($storage_path.'medium/'.$image_name);
        // $smallSizeImages = storage_path($storage_path.'small/'.$image_name);

        // // upload all sized images
        // Image::make($product_image)->resize(1040 , 1200)->save($largeSizeImages);
        // Image::make($product_image)->resize(520 , 600)->save($mediumSizeImages);
        // Image::make($product_image)->resize(260 , 300)->save($smallSizeImages);

        make_storage_dir($this->product_small_images_path);
        make_storage_dir($this->product_medium_images_path);
        make_storage_dir($this->product_large_images_path);

        //   Image paths for small , Medium and large images
        $smallSizeImages = storage_path($this->product_small_images_path.$image_name);
        $mediumSizeImages = storage_path($this->product_medium_images_path.$image_name);
        $largeSizeImages = storage_path($this->product_large_images_path.$image_name);

        // upload all sized images
        Image::make($product_image)->resize(260 , 300)->save($smallSizeImages);
        Image::make($product_image)->resize(520 , 600)->save($mediumSizeImages);
        Image::make($product_image)->resize(1040 , 1200)->save($largeSizeImages);

            // Insert images in product images table
            ProductImage::create([
                'product_id' => $id,
                'image_name' => $image_name,
                // 'status' => config('app.status')
            ]);
        }
    }

    // update image sort
    if (isset($request->images)) {
       foreach ($request->images as $key => $image) {
        ProductImage::where(['product_id' => $id , 'image_name' => $image])
        ->update(['image_sort' => $request->image_sort[$key]] );
       }
       }

    return redirect()->route('admin.products.index')->with('success' , 'Product updated successfully');
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
        unlink_image_video_from_db($video_path , $get_video->product_video);
        // delete from db
        Product::whereId($id)->update(['product_video'=> '']);
        return redirect()->back()->with('success' , 'Product video deleted successfully');
    }

     // deleting deleteImage from db and folder
     public function deleteImage($id){

        //get Image
        $product_image = ProductImage::whereId($id)->first();

        //get image paths
          $smallSizeImages_path = storage_path($this->product_small_images_path);
        $mediumSizeImages_path = storage_path($this->product_medium_images_path);
        $largeSizeImages_path = storage_path($this->product_large_images_path);

        // delete from small folder
        unlink_image_video_from_db($smallSizeImages_path , $product_image->image_name);

         // delete from medium folder
         unlink_image_video_from_db($mediumSizeImages_path , $product_image->image_name);

          // delete from large folder
        unlink_image_video_from_db($largeSizeImages_path , $product_image->image_name);

         // delete from db
         ProductImage::whereId($id)->delete();
         return redirect()->back()->with('success' , 'Product Image deleted successfully');

    }



}
