<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class majors extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'majors_name',
    ];
    protected $primaryKey = 'majors_id  ';
    protected  $table = 'tbl_majors';

}