<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author_name',
        'author_image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_blog_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Use ID for Admin routes, but Slug for Frontend routes.
     */
    public function getRouteKeyName()
    {
        // If the URL starts with 'admin/', look for the ID
        if (request()->is('admin/*')) {
            return 'id';
        }

        // Otherwise, look for the Slug
        return 'slug';
    }  

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
