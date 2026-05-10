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
            $table->string('pks02_prosecutor_name')->nullable();
            $table->string('pks02_case_number')->nullable();
            $table->text('pks02_opinion_analysis')->nullable();
            $table->text('pks02_opinion_recommendation')->nullable();
            $table->text('pks02_opinion_conclusion')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'pks02_prosecutor_name',
                'pks02_case_number',
                'pks02_opinion_analysis',
                'pks02_opinion_recommendation',
                'pks02_opinion_conclusion',
            ]);
        });
    }
};
