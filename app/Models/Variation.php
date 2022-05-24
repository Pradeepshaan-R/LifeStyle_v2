<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'title',
        'variation_type_id'

    ];

    public static $rules = [
        'title' => 'required',
        'variation_type_id' => 'required',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\ProductVariation');
    }

    public function variationType()
    {
        return $this->belongsTo('App\Models\VariationType');
    }
}
