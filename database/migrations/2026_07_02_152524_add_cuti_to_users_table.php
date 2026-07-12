<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->integer('jatah_cuti')
                ->default(12)
                ->after('status_pernikahan');

            $table->integer('sisa_cuti')
                ->default(12)
                ->after('jatah_cuti');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'jatah_cuti',
                'sisa_cuti'
            ]);

        });
    }
};