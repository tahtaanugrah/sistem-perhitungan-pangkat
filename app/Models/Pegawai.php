<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nama',
        'jf',
        'gol',
        'uk',
    ];

    public function pakHistories(): HasMany
    {
        return $this->hasMany(PakHistory::class, 'nip', 'nip');
    }

    public function latestPakHistory(): HasOne
    {
        return $this->hasOne(PakHistory::class, 'nip', 'nip')->ofMany([
            'periode_tahun' => 'max',
            'id' => 'max',
        ]);
    }
}
