<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pak_history', function (Blueprint $table) {
            $table->string('nama_saat_pak')->nullable()->after('tanggal_pak');
            $table->string('jf_saat_pak')->nullable()->after('nama_saat_pak');
            $table->string('gol_saat_pak', 50)->nullable()->after('jf_saat_pak');
            $table->string('uk_saat_pak', 100)->nullable()->after('gol_saat_pak');
        });

        $rows = DB::table('pak_history')->select('id', 'nip')->get();

        foreach ($rows as $row) {
            $pegawai = DB::table('pegawai')->where('nip', $row->nip)->first();

            if (! $pegawai) {
                continue;
            }

            DB::table('pak_history')
                ->where('id', $row->id)
                ->update([
                    'nama_saat_pak' => $pegawai->nama,
                    'jf_saat_pak' => $pegawai->jf,
                    'gol_saat_pak' => $pegawai->gol,
                    'uk_saat_pak' => $pegawai->uk,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('pak_history', function (Blueprint $table) {
            $table->dropColumn([
                'nama_saat_pak',
                'jf_saat_pak',
                'gol_saat_pak',
                'uk_saat_pak',
            ]);
        });
    }
};
