<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'books_name','authors_id','books_quantity','books_category_id'
        ,'books_slug','books_price','books_image','books_status',
    ];
    protected $primaryKey = 'books_id';
    protected  $table = 'tbl_books';
}
