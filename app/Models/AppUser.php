<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AppUser extends Authenticatable
{
    use Notifiable, HasRoles;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'app_users';

    // Tentukan primary key jika menggunakan UUID
    protected $keyType = 'string';
    public $incrementing = false;

    // Kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'kode_ao', 'branch_id', 'division_id', 'username', 'name', 'email', 'password', 'phone', 'status'
    ];

    // Kolom yang disembunyikan dari JSON
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Casting kolom tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}