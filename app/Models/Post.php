<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Tags\HasTags;

class Post extends Model implements Sortable
{
    use HasFactory;
    use HasTags;
    use SortableTrait;

    protected $casts = [
      'content' => 'array',
      'related_posts' => 'array'
    ];

    protected $guarded = [];

    /**
     * Each Post can have many categories.
     *
     */
    public function categories()
    {
        return $this->belongsToMany(PostCategory::class);
    }

    /**
     * Each Post can have many categories.
     *
     */
    public function author()
    {
        // return $this->belongsToMany('PostCategory::class');
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(PostProject::class);
    }

    public function series() {
        return $this->belongsTo(PostSeries::class);
    }

    function posts(){
        return $this->belongsTo(Post::class);
    }

    function post(){
        // return $this->belongsToMany(Post::class);
        return $this->belongsTo(Post::class, 'id');
    }

    function related(){
        // return $this->belongsToMany(Post::class);
        return $this->belongsTo(Post::class, 'related_id');
    }

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

}
