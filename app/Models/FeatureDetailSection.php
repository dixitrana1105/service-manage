<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureDetailSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'feature_id',
        'title',
        'description',
        'description_type',
        'image',
        'image_position',
    ];
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
