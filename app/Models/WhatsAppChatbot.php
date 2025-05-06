<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppChatbot extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_chatbots'; 

    protected $fillable = [
        'title',
        'description',
        'image',
        'feature_titles',
        'feature_icons',
        'feature_descriptions'
    ];
    
    protected $casts = [
        'feature_titles' => 'array',
        'feature_icons' => 'array',
        'feature_descriptions' => 'array',
    ];
}
