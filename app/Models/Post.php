<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Each Post can have many categories.
     *
     */
    public function categories()
    {
        // return $this->belongsToMany('PostCategory::class');
        return $this->belongsToMany(PostCategory::class);
    }

}
