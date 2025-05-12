<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'message', 'channel', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
