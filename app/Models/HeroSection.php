<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'page',
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_link',
        'background_image',
        'status',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeForPage($query, $page)
    {
        return $query->where('page', $page);
    }
}
