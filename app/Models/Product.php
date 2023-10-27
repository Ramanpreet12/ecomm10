<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
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
}
