<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Mass assignment agar kolom bisa diisi [cite: 50]
    protected $fillable = [
        'name', 
        'poliklinik_id', 
        'schedule_day', 
        'start_time', 
        'end_time'
    ];

    // Relasi: Satu Dokter dimiliki oleh satu Poliklinik 
    public function poliklinik()
    {
        return $this->belongsTo(Poliklinik::class);
    }

    // Relasi: Satu Dokter memiliki banyak Antrian [cite: 91]
    public function queues()
    {
        return $this->hasMany(Queue::class);
    }
}