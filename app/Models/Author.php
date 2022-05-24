<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website',
        'phone',
        'user_id',
    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required',
    ];

    //book_id is NOT present in this table
    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    /**
     * getAuthors
     *
     * only the id and name returned 
     */
    public static function getAuthors()
    {
        return Author::select('id', 'name')->get();
    }
}
