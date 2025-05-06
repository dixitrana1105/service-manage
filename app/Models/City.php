<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city'; // Specify the table name if it's different from the model name
    protected $fillable = ['name', 'code']; // Specify the fillable attributes
}
