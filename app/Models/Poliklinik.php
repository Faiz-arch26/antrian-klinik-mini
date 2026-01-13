<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar nama kolom bisa diisi (Mass Assignment)
    protected $fillable = ['name'];

    // Relasi: Satu Poli memiliki banyak Dokter 
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'poliklinik_id');
    }
}