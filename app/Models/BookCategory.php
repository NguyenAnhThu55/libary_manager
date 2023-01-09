<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'books_category_name','books_category_status',
    ];
    protected $primaryKey = 'books_category_id   ';
    protected  $table = 'tbl_books_category';
}
