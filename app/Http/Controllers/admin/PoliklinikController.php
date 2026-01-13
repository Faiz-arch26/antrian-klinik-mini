<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    public function index()
    {
        $polis = Poliklinik::all();
        return view('admin.poliklinik.index', compact('polis'));
    }

    public function store(Request $request)
    {
        // Form Request Validation 
        $request->validate([
            'name' => 'required|min:3|unique:polikliniks,name',
        ]);

        Poliklinik::create($request->all());

        // Flash Message Feedback [cite: 95, 100]
        return redirect()->back()->with('success', 'Poliklinik berhasil ditambahkan!');
    }

    public function destroy(Poliklinik $poliklinik)
    {
        $poliklinik->delete();
        return redirect()->back()->with('success', 'Poliklinik berhasil dihapus!');
    }
}