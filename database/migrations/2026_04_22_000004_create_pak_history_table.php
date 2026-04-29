<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pak_history', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->index();
            $table->string('no_pak');
            $table->decimal('ak_baru', 10, 2);
            $table->decimal('ak_dasar_kp', 10, 2);
            $table->decimal('ak_dasar_jenjang', 10, 2);
            $table->decimal('jumlah_ak', 10, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('nip')->references('nip')->on('pegawai')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pak_history');
    }
};
