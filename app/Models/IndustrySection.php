<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustrySection extends Model
{
    protected $fillable = [
        'industry_id',
        'section_type',
        'title',
        'subtitle',
        'description',
        'content',
        'image',
        'background_image',
        'additional_data',
        'order',
        'is_active',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationship with Industry
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
