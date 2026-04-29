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
            $table->unsignedSmallInteger('periode_tahun')->nullable()->after('nip');
            $table->date('tanggal_pak')->nullable()->after('periode_tahun');
            $table->index(['nip', 'periode_tahun']);
        });

        $rows = DB::table('pak_history')->select('id', 'created_at')->get();

        foreach ($rows as $row) {
            $fallbackDate = $row->created_at ? substr((string) $row->created_at, 0, 10) : date('Y-m-d');
            $fallbackYear = (int) date('Y', strtotime($fallbackDate));

            DB::table('pak_history')
                ->where('id', $row->id)
                ->update([
                    'tanggal_pak' => $fallbackDate,
                    'periode_tahun' => $fallbackYear,
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('pak_history', function (Blueprint $table) {
            $table->dropIndex('pak_history_nip_periode_tahun_index');
            $table->dropColumn(['periode_tahun', 'tanggal_pak']);
        });
    }
};
