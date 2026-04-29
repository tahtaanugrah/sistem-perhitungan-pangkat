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
            $table->string('input_status', 20)->default('final')->after('tanggal_pak');
            $table->index('input_status');
        });

        DB::table('pak_history')->update([
            'input_status' => 'final',
        ]);
    }

    public function down(): void
    {
        Schema::table('pak_history', function (Blueprint $table) {
            $table->dropIndex('pak_history_input_status_index');
            $table->dropColumn('input_status');
        });
    }
};
