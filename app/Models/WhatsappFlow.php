<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappFlow extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'subtitle', 'features'];

    protected $casts = [
        'features' => 'array',
    ];
}
