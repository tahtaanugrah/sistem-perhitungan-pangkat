<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_golongan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('master_jf', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('master_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $golongan = DB::table('pegawai')->select('gol')->whereNotNull('gol')->where('gol', '!=', '')->distinct()->pluck('gol');
        foreach ($golongan as $item) {
            DB::table('master_golongan')->insert([
                'nama' => $item,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $jf = DB::table('pegawai')->select('jf')->whereNotNull('jf')->where('jf', '!=', '')->distinct()->pluck('jf');
        foreach ($jf as $item) {
            DB::table('master_jf')->insert([
                'nama' => $item,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $uk = DB::table('pegawai')->select('uk')->whereNotNull('uk')->where('uk', '!=', '')->distinct()->pluck('uk');
        foreach ($uk as $item) {
            DB::table('master_unit_kerja')->insert([
                'nama' => $item,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('master_unit_kerja');
        Schema::dropIfExists('master_jf');
        Schema::dropIfExists('master_golongan');
    }
};
