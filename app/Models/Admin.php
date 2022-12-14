<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    /**
     *  One To Many RelationShisp
     */
    public function admin_role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }
}
