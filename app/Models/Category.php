<?php

namespace App\Models;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Enums;
    public $timestamps = false;

    protected $fillable = [
        'title',
        'status',
        'filename',
    ];

     protected $enumStatuses = [
        'Active','Disabled'
    ];
}
