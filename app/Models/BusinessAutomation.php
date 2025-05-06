<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAutomation extends Model
{
    use HasFactory;
    protected $table = 'business_automation';

    protected $fillable = ['title', 'description', 'image', 'benefits'];

    protected $casts = [
        'benefits' => 'array',
    ];
}
