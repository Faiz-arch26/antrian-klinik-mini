<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // 1. Buat Akun Admin [cite: 79]
    \App\Models\User::create([
        'name' => 'Admin Klinik',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // 2. Buat Akun User [cite: 80]
    \App\Models\User::create([
        'name' => 'User Pasien',
        'email' => 'user@test.com',
        'password' => bcrypt('password'),
        'role' => 'user',
    ]);

    // 3. Buat Data Poliklinik Awal [cite: 49]
    $umum = \App\Models\Poliklinik::create(['name' => 'Poli Umum']);
    $gigi = \App\Models\Poliklinik::create(['name' => 'Poli Gigi']);

    // 4. Buat Data Dokter Awal [cite: 50]
    \App\Models\Doctor::create([
        'name' => 'dr. Andi',
        'poliklinik_id' => $umum->id,
        'schedule_day' => 'Senin - Jumat',
        'start_time' => '08:00',
        'end_time' => '12:00',
    ]);
}

    // 5. Tambahkan data seeder lainnya jika diperlukan
}