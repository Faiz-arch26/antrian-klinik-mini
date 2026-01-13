<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi (Mass Assignable).
     * Pastikan 'role' ditambahkan di sini.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Penting untuk menyimpan role admin/user [cite: 7]
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Helper untuk mengecek Admin.
     * Digunakan di Blade: @if(Auth::user()->isAdmin())
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Helper untuk mengecek User.
     * Digunakan di Blade: @if(Auth::user()->isUser())
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}