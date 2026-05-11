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
            $table->string('nationality')->nullable()->after('religion');
            $table->enum('marital_status', ['belum_menikah', 'menikah', 'cerai'])->nullable()->after('nationality');
            $table->unsignedInteger('dependents_count')->default(0)->after('marital_status');
            $table->string('spouse_name')->nullable()->after('dependents_count');
            $table->unsignedInteger('children_count')->default(0)->after('spouse_name');
            $table->text('ktp_address')->nullable()->after('address');
            $table->string('phone_number')->nullable()->after('ktp_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nationality',
                'marital_status',
                'dependents_count',
                'spouse_name',
                'children_count',
                'ktp_address',
                'phone_number',
            ]);
        });
    }
};
