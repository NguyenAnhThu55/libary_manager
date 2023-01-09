<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'authors_name',
    ];
    protected $primaryKey = 'authors_id  ';
    protected  $table = 'tbl_authors';
}
