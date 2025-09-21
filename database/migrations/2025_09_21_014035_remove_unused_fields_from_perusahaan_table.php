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
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->dropColumn(['tahun_berdiri', 'lokasi_kantor', 'bidang_usaha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perusahaan', function (Blueprint $table) {
            $table->string('tahun_berdiri', 4)->nullable()->after('alamat_perusahaan');
            $table->string('lokasi_kantor')->nullable()->after('tahun_berdiri');
            $table->string('bidang_usaha')->nullable()->after('lokasi_kantor');
        });
    }
};
