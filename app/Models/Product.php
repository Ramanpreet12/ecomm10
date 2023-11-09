<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    // const STATUS = 1;

    public function category(){
        return $this->belongsTo(Category::class , 'category_id' , 'id')->with('parentCategory');

    }

    public static function productFilters(){
        $productFilters['fabrics'] = array('Cotton' , 'Polyester' , 'Wool' , 'Georgette' , 'Linen', 'Silk' , 'Velvet',
        'Chiffon', 'Organza' , 'Denim');
        $productFilters['patterns'] = array('Check' , 'Plaid' , 'Plain' , 'Floral' , 'Strips', 'Animal patterns');
        $productFilters['sleeves'] = array('Full Sleeves' , 'Half Sleeve' , 'Sleevless' , 'Short Sleeves');
        $productFilters['fits'] = array('Regular' , 'Slim' , 'Straight');
        $productFilters['occassions'] = array('Casual' , 'Formal events' ,'Wedding');

        return $productFilters;

    }

    public static function calculate_actual_price($product_discount  , $product_price  ,$category_id){

        if (!empty($product_discount) && ($product_discount > 0) ) {
            $product_discount_type = 'product';

            // calculate discount
            $final_price = $product_price - ($product_price *  $product_discount)/100;

        }
        else{
            // check category discount
            $get_category_discount = Category::select('category_discount')->where('id' , $category_id)->first();
            if ( $get_category_discount->category_discount == 0) {
                $product_discount_type = "";
                $final_price =  $product_price;
            }
        }

        return array('final_price' =>$final_price , 'product_discount_type' => $product_discount_type)  ;

    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

}





// if (!empty($request->product_discount) && ($request->product_discount > 0) ) {
//     $product_discount_type = 'product';

//     // calculate discount
//     $final_price = $request->product_price - ($request->product_price *  $request->product_discount)/100;

// }else{
//     // check category discount
//     $get_category_discount = Category::select('category_discount')->where('id' , $request->category_id)->first();

//     if ( $get_category_discount->category_discount == 0) {
//         $product_discount_type = '';
//         $final_price = $request->product_price;
//     }

// }
