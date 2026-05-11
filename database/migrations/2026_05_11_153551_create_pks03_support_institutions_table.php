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
        Schema::create('pks03_support_institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained('pks03_support_assessments')->onDelete('cascade');
            $table->string('institution_name');
            $table->enum('service_type', ['rumah_sakit', 'panti_asuhan', 'panti_lansia', 'sekolah', 'lembaga_sosial_lain']);
            $table->string('address_contact')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pks03_support_institutions');
    }
};
