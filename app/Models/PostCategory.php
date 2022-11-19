<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Each Category can have many posts.
     *
     */
    public function posts()
    {
        return $this->belongsToMany('Post')->withTimeStamps();
    }

}
