<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'url',
        'parameters',
        'ip_address',
        'user_agent',
    ];
}
