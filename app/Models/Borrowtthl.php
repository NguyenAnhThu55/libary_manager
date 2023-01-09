<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowtthl extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_name','ma_sv','book_name','authors_name','borrow_day','borrow_tthl_status',
    ];
    protected $primaryKey = 'borrow_tthl_id';
    protected  $table = 'tbl_borrow_tthl';
}
