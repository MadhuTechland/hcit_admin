<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    protected $table = 'media_library';

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'size',
        'alt_text',
        'caption',
        'category',
    ];

    protected $casts = [
        'size' => 'integer',
    ];
}
