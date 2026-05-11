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
        Schema::create('pks03_support_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('assessed_by');
            $table->date('assessed_at');
            $table->boolean('bapas_available')->default(false);
            $table->string('bapas_institution_name')->nullable();
            $table->boolean('guidance_program_available')->default(false);
            $table->enum('conclusion', ['tersedia_memadai', 'tersedia_terbatas', 'tidak_tersedia']);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pks03_support_assessments');
    }
};
