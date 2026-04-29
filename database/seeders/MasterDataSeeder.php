<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    /**
     * Seed default master data for dropdown options.
     */
    public function run(): void
    {
        $now = now();

        $golongan = [
            'III/a',
            'III/b',
            'III/c',
            'III/d',
            'IV/a',
            'IV/b',
        ];

        $jf = [
            'Analis Kepegawaian Ahli Pertama',
            'Analis Kepegawaian Ahli Muda',
            'Pranata Komputer Ahli Pertama',
            'Pranata Komputer Ahli Muda',
            'Analis Humas',
        ];

        $unitKerja = [
            'BDL',
            'BHKK',
            'Sekretariat',
        ];

        foreach ($golongan as $nama) {
            DB::table('master_golongan')->updateOrInsert(
                ['nama' => $nama],
                ['is_active' => true, 'updated_at' => $now, 'created_at' => $now]
            );
        }

        foreach ($jf as $nama) {
            DB::table('master_jf')->updateOrInsert(
                ['nama' => $nama],
                ['is_active' => true, 'updated_at' => $now, 'created_at' => $now]
            );
        }

        foreach ($unitKerja as $nama) {
            DB::table('master_unit_kerja')->updateOrInsert(
                ['nama' => $nama],
                ['is_active' => true, 'updated_at' => $now, 'created_at' => $now]
            );
        }
    }
}
