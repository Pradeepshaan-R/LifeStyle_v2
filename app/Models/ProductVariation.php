<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Read this
 * https://laravel.com/docs/8.x/eloquent-relationships#retrieving-intermediate-table-columns
 */
class ProductVariation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'variation_id'
    ];

    /**
     * Get a list of products for a given variation id
     */
    public function products($variation_id)
    {
        //return $this->belongsToMany('App\Models\ProductVariation');
    }

    /**
     * Get a list of variation ids for a given product id, as array
     */
    public static function getVariations($product_id)
    {
        //return $this->belongsTo('App\Models\VariationType');
        return ProductVariation::where('product_id', $product_id)->pluck('variation_id')->toArray();
    }
}
