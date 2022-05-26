<?php

namespace App\Models;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Enums;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'description',
        'phone',
        'dob',
        'gender',
    ];
    protected $enumGenders = [
        'Female', 'Male', 'Other'
    ];

}
