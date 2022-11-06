<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     *  One To Many RelationShisp
     */
    public function admin_user()
    {
        return $this->hasMany(Admin::class,'role_id','id');
    }
}
