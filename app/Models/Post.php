<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     *  Many To Many Relationship With Tag Model
     */
    public function tags()
    {
      return $this->belongsToMany(Teg::class);
    }
}
