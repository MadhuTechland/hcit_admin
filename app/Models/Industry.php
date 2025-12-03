<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Industry extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'subtitle',
        'detail_title',
        'detail_description',
        'image',
        'detail_image',
        'shape_image',
        'tags',
        'content',
        'breadcrumb_title',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($industry) {
            if (empty($industry->slug)) {
                $industry->slug = Str::slug($industry->title);
            }
        });

        static::updating(function ($industry) {
            if ($industry->isDirty('title') && empty($industry->slug)) {
                $industry->slug = Str::slug($industry->title);
            }
        });
    }

    public function getTagsArrayAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : [];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    // Relationship with IndustrySections
    public function sections()
    {
        return $this->hasMany(IndustrySection::class)->where('is_active', true)->orderBy('order');
    }
}
