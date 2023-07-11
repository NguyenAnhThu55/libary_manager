<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'admin_admin_id','	role_id_roles',
    ];
    protected $primaryKey = 'id_admin_roles';
    protected  $table = 'admin_role';

    
}
