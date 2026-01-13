<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    // Mass assignment agar kolom bisa diisi saat pendaftaran [cite: 11]
    protected $fillable = [
        'user_id', 
        'doctor_id', 
        'visit_date', 
        'complaint', 
        'queue_number', 
        'status'
    ];

    // Relasi: Antrian ini dimiliki oleh satu User (Pasien) [cite: 52, 91]
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Antrian ini ditujukan untuk satu Dokter [cite: 53, 91]
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}