<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teg extends Model
{
    use HasFactory;
    protected $guarded = [];
      /**
     *  Many To Many Relationship With Post Model
     */
    public function posts()
    {
      return $this->belongsToMany(Post::class);
    }
}
