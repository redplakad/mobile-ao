<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Str;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Penagihan extends Model
    {
        use HasFactory, SoftDeletes;

        protected $table = 'penagihan';

        protected $fillable = [
            'uudi',
            'lat',
            'lng',
            'nomor_kredit',
            'nama_debitur',
            'no_telepon',
            'address',
            'hasil_kunjungan',
            'janji_bayar',
            'uraian_kunjungan',
            'image',
            'image1',
            'image2',
            'image3',
            'by_user',
        ];

        public function user()
        {
            return $this->belongsTo(AppUser::class, 'by_user');
        }

        protected static function boot()
        {
            parent::boot();

            static::creating(function ($penagihan) {
                $penagihan->uuid = (string) Str::uuid();
            });
        }

        protected $dates = ['deleted_at'];

    }
