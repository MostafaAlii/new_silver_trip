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
        Schema::table('captains', function (Blueprint $table) {
            $table->foreignId('states_id')->default('3223')->constrained('states')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('captains', function (Blueprint $table) {
            $table->dropConstrainedForeignId('states_id');
        });
    }
};
