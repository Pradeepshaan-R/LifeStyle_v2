<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Enums;

class Brand extends Model
{
    use HasFactory, Enums;
    public $timestamps = false;

    protected $fillable = [
        'title',
        'status',
    ];

    protected $enumStatuses = [
        'Available', 'Not Available'
    ];

    public static $rules = [
        'title' => 'required',
    ];
}
