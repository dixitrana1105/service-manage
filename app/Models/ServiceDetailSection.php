<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetailSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id', 'title', 'description', 'image', 'image_position','description_type'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
