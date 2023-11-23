<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\FamilyColor;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $product_video_path = 'public/front/videos/products/';

     public function productDetails($id)
     {
         $product = Product::with('images')->where('id' ,$id)->first();
         $productFilters = Product::productFilters();
         $family_colors = FamilyColor::get();

        return view('admin.product_details.create' , compact('product' ,  'productFilters' , 'family_colors'));
     }

    public function addProductDetails(Request $request , $id){



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

        Product::where('id' , $id)->update([
            'product_color'  => $request->product_color,
            'family_color'  => $request->family_color,
            'product_weight' => $request->product_weight,
            'wash_care'  => $request->wash_care,
            'search_keywords'  => $request->search_keywords,
            'fabric'  => $request->fabric,
            'pattern'  => $request->pattern,
            'sleeve'  => $request->sleeve,
            'fit'  => $request->fit,
            'occassion'  => $request->occassion,
            'sleeve'  => $request->sleeve,
            'product_video' => $video_name,
        ]);


        // add product attributes in proudctattribute table

        foreach ($request['sku'] as $key => $value) {
           if (!empty($value)) {

            // check sku is already exist
            $countSKU = ProductAttribute::where('sku' , $value)->count();
            if ($countSKU>0) {
               return redirect()->back()->with('error' , 'SKU already exists');
            }

            // check of size is already exists or not
            $countSize = ProductAttribute::where(['product_id' => $id , 'size' => $request['size'][$key]])->count();
            if ($countSize>0) {
                return redirect()->back()->with('error' , 'Size already exists');
             }

             $product_attribute = new ProductAttribute;
             $product_attribute->product_id = $id;
             $product_attribute->sku = $value;
             $product_attribute->size = $request['size'][$key];
             $product_attribute->price = $request['price'][$key];
             $product_attribute->stock = $request['stock'][$key];
             $product_attribute->status =1;
             $product_attribute->save();

           }
        }

        return redirect()->route('admin.products.index')->with('success' , 'Product details added successfully');

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
