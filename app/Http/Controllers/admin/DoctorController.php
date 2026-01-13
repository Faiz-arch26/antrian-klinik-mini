<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        // Mengambil data dokter beserta polikliniknya (Eloquent Relationship) [cite: 13, 91]
        $doctors = Doctor::with('poliklinik')->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function create()
    {
        // Mengambil semua poli untuk pilihan dropdown di form 
        $polikliniks = Poliklinik::all();
        return view('admin.doctor.create', compact('polikliniks'));
    }

    public function store(Request $request)
    {
        // Validasi data (Bobot 10 poin) [cite: 11, 94]
        $request->validate([
            'name' => 'required|min:3',
            'poliklinik_id' => 'required|exists:polikliniks,id',
            'schedule_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Doctor::create($request->all());

        return redirect()->route('admin.doctors.index')->with('success', 'Dokter berhasil ditambahkan!');
    }
}