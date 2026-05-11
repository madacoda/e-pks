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
        Schema::create('jaksa_pidana', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jaksa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pidana_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();

            $table->unique(['jaksa_id', 'pidana_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaksa_pidana');
    }
};
