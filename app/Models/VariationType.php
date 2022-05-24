<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VariationType extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'title',

    ];
    public static $rules = [
        'title' => 'required',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    /**
     * Get a list of variations for a given variation_type_id
     */
    public static function getVariations($variation_type_id)
    {
        return Variation::where('variation_type_id', $variation_type_id)->get();
    }
}
