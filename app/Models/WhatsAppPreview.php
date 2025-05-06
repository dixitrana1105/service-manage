<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppPreview extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_previews';
    protected $fillable = ['title', 'header_text', 'icon_image', 'chat_messages', 'video'];
    protected $casts = ['chat_messages' => 'array'];
}
