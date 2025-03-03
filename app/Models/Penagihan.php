<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Penagihan extends Model
    {
        use HasFactory;

        protected $table = 'penagihan';

        protected $fillable = [
            'lat',
            'lng',
            'nomor_kredit',
            'nama_debitur',
            'no_telepon',
            'address',
            'hasil_kunjungan',
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
    }
