<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('email');
        });

        // Set logo for Indo Group
        DB::table('users')
            ->where('name', 'Indo Group')
            ->where('email', 'indo@gmail.com')
            ->update([
                'logo' => 'indogroup.png',
                'updated_at' => now()
            ]);

        echo "✅ Successfully added logo column to users table\n";
        echo "   - Added logo column after phone\n";
        echo "   - Set Indo Group logo to 'indogroup.png'\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('logo');
        });

        echo "✅ Successfully removed logo column from users table\n";
    }
};
