<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PoliklinikController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\User\QueueController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- FITUR PROFILE (Bawaan Breeze) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- GROUP ROUTE ADMIN (Hanya Role Admin) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Kelola Master Data
    Route::resource('polikliniks', PoliklinikController::class);
    Route::resource('doctors', DoctorController::class);
    
    // Kelola Antrian Klinik (Admin Side)
    Route::get('/queues', [QueueController::class, 'indexAdmin'])->name('queues.index');
    // TAMBAHKAN BARIS INI: Untuk memproses perubahan status antrian
    Route::patch('/queues/{queue}/status', [QueueController::class, 'updateStatus'])->name('queues.updateStatus');
});

// --- GROUP ROUTE USER (Hanya Role User) ---
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/queues', [QueueController::class, 'index'])->name('queues.index');
    Route::get('/queues/create', [QueueController::class, 'create'])->name('queues.create');
    Route::post('/queues', [QueueController::class, 'store'])->name('queues.store');
    Route::post('/queues/{queue}/cancel', [QueueController::class, 'cancel'])->name('queues.cancel');
});

require __DIR__.'/auth.php';