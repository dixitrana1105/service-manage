<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    protected $table = 'states'; // Specify the table name if it's not the plural of the model name
    protected $fillable = ['name', 'code']; // Specify the fillable attributes
}
