<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
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

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('title') && empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    public function sections()
    {
        return $this->hasMany(ServiceSection::class)->where('is_active', true)->orderBy('order');
    }

    public function getRouteKeyName()
    {
        // For Admin panel, search by ID (e.g., /admin/services/18/sections)
        if (request()->is('admin/*')) {
            return 'id';
        }

        // For Frontend, search by Slug
        return 'slug';
    }  

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
