<?php

namespace App\Models;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Enums;
    public $timestamps = false;

    protected $fillable = [
        'title',
        'price',
        'category_id',
        'description',
        'status',
        'filename',
    ];

    protected $enumStatuses = [
        'Available', 'Not Available'
    ];
}
