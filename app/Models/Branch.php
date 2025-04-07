<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// app/Models/Branch.php

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'branch_code','branch_name','branch_address','branch_phone'
    ];
    // Tambahan jika kamu ingin bisa dipanggil relasi balik
    public function users()
    {
        return $this->hasMany(AppUser::class, 'branch_id');
    }
}
