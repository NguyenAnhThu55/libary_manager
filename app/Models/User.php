<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_name','user_position','user_code','user_email','user_phone'
        ,'user_ majors',
    ];
    protected $primaryKey = 'user_id ';
    protected  $table = 'tbl_users';
}
