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
            $table->string('pasal')->nullable()->after('crime');
            $table->string('sub_pasal')->nullable()->after('pasal');
            $table->string('jenis_tindak_pidana')->nullable()->after('sub_pasal');
            $table->integer('sentence_hours')->nullable()->after('sentence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pasal', 'sub_pasal', 'jenis_tindak_pidana', 'sentence_hours']);
        });
    }
};
