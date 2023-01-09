<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBooks_Detail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'borrow_book_id','book_id','book_name','book_price','book_image','user_id','user_name','user_phone','user_email',
    ];
    protected $primaryKey = 'borrow_detail_id';
    protected  $table = 'tbl_borrow_detail';

    public function books(){
        return $this->belongsTo('App\Models\Books','books_id');
    }
}