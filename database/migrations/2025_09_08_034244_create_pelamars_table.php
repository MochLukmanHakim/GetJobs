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
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->string('cv_path')->nullable();
            $table->unsignedBigInteger('pekerjaan_id');
            $table->enum('status', ['review', 'accepted', 'rejected'])->default('review');
            $table->enum('pengumuman_status', ['none', 'interview', 'test', 'document', 'phone', 'completed', 'pending'])->default('none');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_melamar')->useCurrent();
            $table->timestamps();
            
            $table->foreign('pekerjaan_id')->references('id_pekerjaan')->on('pekerjaan')->onDelete('cascade');
            $table->index(['status', 'pekerjaan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamars');
    }
};
