<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class PostCategory extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $guarded = [];

    /**
     * Each Category can have many posts.
     *
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimeStamps();
    }

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

}
