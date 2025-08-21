<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id_pekerjaan();
            $table->string('judul_pekerjaan');
            $table->string('lokasi_pekerjaan');
            $table->string('gaji_pekerjaan');
            $table->string('kategori_pekerjaan');
            $table->text('deskripsi_pekerjaan')->nullable();
            $table->date('batas_waktu_pekerjaan')->nullable();
            $table->enum('status', ['draft', 'aktif', 'tutup'])->default('draft');
            $table->dateTime('tanggal_dibuat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaan');
    }
};
