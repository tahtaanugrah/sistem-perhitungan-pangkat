<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PakHistory extends Model
{
    use HasFactory;

    protected $table = 'pak_history';

    protected $fillable = [
        'nip',
        'periode_tahun',
        'tanggal_pak',
        'input_status',
        'nama_saat_pak',
        'jf_saat_pak',
        'gol_saat_pak',
        'uk_saat_pak',
        'no_pak',
        'ak_baru',
        'ak_dasar_kp',
        'ak_dasar_jenjang',
        'jumlah_ak',
        'keterangan',
    ];

    protected $appends = [
        'selisih_kp',
        'selisih_jenjang',
        'status_evaluasi',
    ];

    protected function casts(): array
    {
        return [
            'periode_tahun' => 'integer',
            'tanggal_pak' => 'date',
            'input_status' => 'string',
            'ak_baru' => 'float',
            'ak_dasar_kp' => 'float',
            'ak_dasar_jenjang' => 'float',
            'jumlah_ak' => 'float',
        ];
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }

    public function getSelisihKpAttribute(): float
    {
        return round((float) $this->ak_baru - (float) $this->ak_dasar_kp, 2);
    }

    public function getSelisihJenjangAttribute(): float
    {
        return round((float) $this->jumlah_ak - (float) $this->ak_dasar_jenjang, 2);
    }

    public function getStatusEvaluasiAttribute(): string
    {
        return $this->selisih_kp >= 0 && $this->selisih_jenjang >= 0 ? 'Terpenuhi' : 'Belum Terpenuhi';
    }
}
