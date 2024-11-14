<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'status',
    ];

    // Relasi ke model Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi ke model Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
