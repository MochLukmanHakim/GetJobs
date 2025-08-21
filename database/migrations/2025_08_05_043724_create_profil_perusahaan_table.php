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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('id_perusahaan');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->text('deskripsi_perusahaan')->nullable();
            $table->string('no_telp_perusahaan')->nullable();
            $table->string('bidang_industri')->nullable();
            $table->text('alamat_perusahaan');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};
