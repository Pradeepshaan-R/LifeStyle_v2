<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Enums;

class Book extends Model
{
    use HasFactory, Enums;

    protected $fillable = [
        'qty',
        'status',
        'isbn',
        'title',
        'photo',
        'author_id',
        'user_id',
    ];

    public static $rules = [
        'title' => 'required',
        'author_id' => 'required',
        'isbn' => 'required',
    ];

    protected $enumStatuses = [
        'Available', 'Lended', 'Damaged'
    ];

    //author_id is present in this table
    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
}
