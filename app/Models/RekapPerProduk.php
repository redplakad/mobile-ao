<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RekapPerProduk extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'rekap_perproduk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'CAB',
        'datadate',
        'KET_KD_PRD',
        'total_count',
        'total_sum',
        'total_npl',
        'npl_persentase'
    ];
}
