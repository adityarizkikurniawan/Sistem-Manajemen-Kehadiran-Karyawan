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
        Schema::table('presensi', function (Blueprint $table) {

            $table->unsignedBigInteger('divisi_id')->nullable()->after('user_id');

            $table->time('jam_masuk_seharusnya')->nullable()->after('jam_masuk');

            $table->time('jam_pulang_seharusnya')->nullable()->after('jam_pulang');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presensi', function (Blueprint $table) {

            $table->dropColumn([
                'divisi_id',
                'jam_masuk_seharusnya',
                'jam_pulang_seharusnya'
            ]);

        });
    }
};
