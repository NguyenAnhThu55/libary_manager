<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBooks extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id','borrow_books_status','pay_day',
    ];
    protected $primaryKey = 'borrow_books_id';
    protected  $table = 'tbl_borrow_books';
}
