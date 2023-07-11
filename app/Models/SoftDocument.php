<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftDocument extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'soft_document_name','soft_document_desc','soft_document_status','soft_document_category',
    ];
    protected $primaryKey = 'soft_document_id';
    protected  $table = 'tbl_soft_document';
}
