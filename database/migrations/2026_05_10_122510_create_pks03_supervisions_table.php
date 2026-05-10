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
        Schema::create('pks03_supervisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('supervision_date');
            $table->string('supervision_type')->default('Reguler');
            $table->text('notes')->nullable();
            $table->string('behavior_status')->nullable(); // e.g., Baik, Cukup, Kurang
            $table->string('compliance_status')->nullable(); // e.g., Patuh, Melanggar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pks03_supervisions');
    }
};
