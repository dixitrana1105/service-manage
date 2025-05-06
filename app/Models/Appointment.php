<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments'; // Specify the table name if it's different from the model name
    protected $fillable = [
        'customer_name',
        'customer_email',
        'appointment_date',
        'appointment_time',
        'message',
    ];
    /**
     * Get the appointment date in a formatted way.
     *
     * @return string
     */
}
