<?php

namespace Database\Seeders;

use App\Models\PakHistory;
use App\Models\Pegawai;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PakSampleSeeder extends Seeder
{
    /**
     * Seed sample PAK data for dashboard testing.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $samples = [
                [
                    'pegawai' => [
                        'nip' => '198801012010011001',
                        'nama' => 'Siti Rahmawati',
                        'jf' => 'Analis Kepegawaian Ahli Muda',
                        'gol' => 'III/c',
                        'uk' => 'BDL',
                    ],
                    'pak' => [
                        'periode_tahun' => 2022,
                        'tanggal_pak' => '2022-03-15',
                        'no_pak' => 'PAK/BDL/001/2026',
                        'ak_baru' => 125.50,
                        'ak_dasar_kp' => 120.00,
                        'ak_dasar_jenjang' => 118.00,
                        'jumlah_ak' => 126.75,
                        'keterangan' => 'Layak kenaikan pangkat',
                    ],
                ],
                [
                    'pegawai' => [
                        'nip' => '198705152011011002',
                        'nama' => 'Ahmad Fadli',
                        'jf' => 'Pranata Komputer Ahli Pertama',
                        'gol' => 'III/b',
                        'uk' => 'BHKK',
                    ],
                    'pak' => [
                        'periode_tahun' => 2020,
                        'tanggal_pak' => '2020-06-10',
                        'no_pak' => 'PAK/BHKK/002/2026',
                        'ak_baru' => 98.00,
                        'ak_dasar_kp' => 100.00,
                        'ak_dasar_jenjang' => 95.00,
                        'jumlah_ak' => 97.50,
                        'keterangan' => 'Perlu tambahan angka kredit',
                    ],
                ],
                [
                    'pegawai' => [
                        'nip' => '199003032012012003',
                        'nama' => 'Nadia Putri',
                        'jf' => 'Analis Humas',
                        'gol' => 'III/d',
                        'uk' => 'BDL',
                    ],
                    'pak' => [
                        'periode_tahun' => 2024,
                        'tanggal_pak' => '2024-11-20',
                        'no_pak' => 'PAK/BDL/003/2026',
                        'ak_baru' => 150.00,
                        'ak_dasar_kp' => 147.50,
                        'ak_dasar_jenjang' => 140.00,
                        'jumlah_ak' => 150.00,
                        'keterangan' => 'Lengkap untuk evaluasi',
                    ],
                ],
            ];

            foreach ($samples as $sample) {
                $pegawai = Pegawai::updateOrCreate(
                    ['nip' => $sample['pegawai']['nip']],
                    $sample['pegawai']
                );

                PakHistory::updateOrCreate(
                    [
                        'nip' => $pegawai->nip,
                        'no_pak' => $sample['pak']['no_pak'],
                    ],
                    [
                        'nip' => $pegawai->nip,
                        'periode_tahun' => $sample['pak']['periode_tahun'],
                        'tanggal_pak' => $sample['pak']['tanggal_pak'],
                        'input_status' => 'final',
                        'nama_saat_pak' => $sample['pegawai']['nama'],
                        'jf_saat_pak' => $sample['pegawai']['jf'],
                        'gol_saat_pak' => $sample['pegawai']['gol'],
                        'uk_saat_pak' => $sample['pegawai']['uk'],
                        'no_pak' => $sample['pak']['no_pak'],
                        'ak_baru' => $sample['pak']['ak_baru'],
                        'ak_dasar_kp' => $sample['pak']['ak_dasar_kp'],
                        'ak_dasar_jenjang' => $sample['pak']['ak_dasar_jenjang'],
                        'jumlah_ak' => $sample['pak']['jumlah_ak'],
                        'keterangan' => $sample['pak']['keterangan'],
                    ]
                );
            }
        });
    }
}
