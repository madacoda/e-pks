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
        Schema::table('users', function (Blueprint $table) {
            $table->json('pks02_background')->nullable();
            $table->json('pks02_family_profile')->nullable();
            $table->json('pks02_environment')->nullable();
            $table->json('pks02_daily_life')->nullable();
            $table->json('pks02_work_capability')->nullable();
            $table->json('pks02_profiling_meta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'pks02_background',
                'pks02_family_profile',
                'pks02_environment',
                'pks02_daily_life',
                'pks02_work_capability',
                'pks02_profiling_meta',
            ]);
        });
    }
};
