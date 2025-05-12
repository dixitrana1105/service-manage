<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_name',
        'email',
        'phone',
        'message',
        'appointment_date',
        'doctor_name',
        'doctor_designation',
        'doctor_schedule',
        'doctor_visit_days',
        'doctor_holidays',
        'doctor_image',
        'status',
    ];
}
