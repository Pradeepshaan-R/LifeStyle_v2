<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'roof_area',
        'roof_unit',
        'ceiling_area',
        'ceiling_unit',
        'products'

    ];

    public static $rules = [
        'name' => 'required',
        'phone' => 'required',
    ];

    public static $updateRules = [
        'name' => 'required',
        'phone' => 'required',
   
    ];
}
